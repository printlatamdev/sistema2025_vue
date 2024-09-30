<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $data = Brand::orderBy('id', 'desc')->get();
        return BrandResource::collection($data);
    }

    public function store(Request $request){
        $data = Brand::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
        ]);
        return new BrandResource($data);
    }
}
