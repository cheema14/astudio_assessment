<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function storeAttribute(AttributeRequest $request)
    {

        $attribute = Attribute::create($request->all());

        return response()->json(['message' => 'Attribute created successfully.', 'attribute' => $attribute], 200);
    }

    public function getAllAttributes()
    {
        return response()->json(Attribute::all());
    }
}
