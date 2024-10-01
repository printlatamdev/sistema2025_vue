<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaterialTypeRequest;
use App\Http\Resources\MaterialtypeResource;
use App\Models\Materialtype;

class MaterialtypeController extends Controller
{
    public function index()
    {
        $data = Materialtype::orderBy('id', 'desc')->get();

        return MaterialtypeResource::collection($data);
    }

    public function store(StoreMaterialTypeRequest $request)
    {
        Materialtype::create([
            'name' => $request->name,
            'status' => 1,
            'materialcategory_id' => $request->materialcategory_id,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.types', $request->materialcategory_id);
    }

    public function show($id)
    {
        $data = Materialtype::find($id);

        return MaterialtypeResource::make($data);
    }
}
