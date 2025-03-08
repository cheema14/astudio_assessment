<?php

namespace App\Http\Requests;

use App\Models\Attribute;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AttributeValueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        return true;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 500));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'attributes' => ['required'],
            'attributes.*.attribute_id' => [
                'required',
                'exists:attributes,id',
            ],
            'attributes.*.value' => [function ($attribute, $value, $fail) {
                $this->validateAttributeValue($attribute, $value, $fail);
            }],
            'attributes.*.options' => ['array'],
            'attributes.*.options.*' => ['string'],
        ];
    }

    private function validateAttributeValue($attribute, $value, $fail)
    {
        // Finding the index, as attributes can be an array
        $index_key = explode('.', $attribute)[1];

        // Getting the id of attribute to find the type to apply the proper validation check
        $attribute_id = request()->input("attributes.$index_key.attribute_id");

        if (! $attribute_id) {
            return;
        }

        $attribute_model_type = Attribute::find($attribute_id);
        if (! $attribute_model_type) {
            return;
        }

        // Added the $value so that proper highlighted error value is sent
        $rules_for_validation = [
            'text' => fn ($v) => is_string($v) ?: $fail($value.' The attribute value(type) must be a string'),
            'date' => fn ($v) => strtotime($v) !== false ?: $fail($value.' The attribute value(type) must be a valid date'),
            'number' => fn ($v) => is_numeric($v) ?: $fail($value.' The attribute value(type) must be a number'),
            'select' => fn ($v) => is_array($v) ?: $fail($value.' The attribute value(type) must be an array'),

        ];

        if (isset($rules_for_validation[$attribute_model_type->type])) {
            $rules_for_validation[$attribute_model_type->type]($value);
        }

    }
}
