<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeValueRequest;
use App\Models\AttributeValue;
use App\Models\Project;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    public function storeAttributeValue(AttributeValueRequest $request, $id)
    {

        $project = Project::findorFail($id);

        $project_attributes = collect($request->input('attributes'))->map(function ($attribute) use ($project) {
            return [
                'project_id' => $project->id,
                'attribute_id' => $attribute['attribute_id'],
                'value' => $attribute['value'] ?? '',
                // 'options' => $attribute['options'] ?? '',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        AttributeValue::insert($project_attributes);

        return response()->json(['message' => 'Data saved successfully']);
    }

    public function filterAttributes(Request $request)
    {
        $query_data = Project::query();

        if ($request->has('attribute_id') && $request->has('value')) {
            $query_data->whereHas('attributes', function ($q) use ($request) {
                $q->where('attribute_id', $request->attribute_id)
                    ->where('value', $request->value);
            });
        }

        return response()->json($query_data->get());
    }
}
