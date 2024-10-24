<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::orderBy('id', 'desc')->get();

        return ProductResource::collection($data);
    }

    public function store(StoreProductRequest $request)
    {
        $data = Product::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('quotations');
    }
}
