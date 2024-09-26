<?php

namespace App\Http\Controllers;

use App\Http\Resources\MaterialcategoryResource;
use App\Models\Materialcategory;
use Illuminate\Http\Request;

class MaterialcategoryController extends Controller
{
    public function index()
    {
        $data = Materialcategory::orderBy('id', 'desc')->get();

        return MaterialcategoryResource::collection($data);
    }

    public function store(Request $request)
    {
        Materialcategory::create([
            'name' => $request->name,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('materials');
    }
}
