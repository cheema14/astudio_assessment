<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user');

        // dd($userId, $this->route('user'));

        return [
            'email' => [
                'required', 'email', 'string', Rule::unique('users', 'email')->ignore($userId, 'id'),
            ],
            'password' => [
                'required', 'regex:/^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{8,}$/',
                'confirmed',
            ],
            'password_confirmation' => [
                'required',
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 500));
    }

    public function messages()
    {
        return [
            'password.regex' => 'Password must have at least 1 number, 1 special character, 1 Capital letter and minimum of 8 characters long.',
        ];
    }
}
