<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $data = Brand::orderBy('id', 'desc')->get();

        return BrandResource::collection($data);
    }

    public function store(StoreBrandRequest $request)
    {
        $data = Brand::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
        ]);

    }
}
