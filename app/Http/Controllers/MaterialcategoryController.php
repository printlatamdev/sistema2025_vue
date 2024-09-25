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
        $data = Materialcategory::create([
            'name' => $request->name,
            'type' => $request->type,
            'status' => $request->status,
        ]);

        return redirect()->route('materials');
    }
}
