<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaterialCategoryRequest;
use App\Http\Resources\MaterialcategoryResource;
use App\Models\Materialcategory;

class MaterialcategoryController extends Controller
{
    public function index()
    {
        $data = Materialcategory::orderBy('id', 'desc')->get();

        return MaterialcategoryResource::collection($data);
    }

    public function store(StoreMaterialCategoryRequest $request)
    {
        $image = new ImageController;
        $data = Materialcategory::create([
            'name' => $request->name,
            'status' => 1,
            'description' => $request->description,
        ]);
        $img = $image->store($request->image, Materialcategory::class, $data->id);
        $data->image()->save($img);

        return redirect()->route('categories');
    }
}
