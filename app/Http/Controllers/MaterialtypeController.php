<?php

namespace App\Http\Controllers;

use App\Http\Resources\MaterialtypeResource;
use App\Models\Materialtype;
use Illuminate\Http\Request;

class MaterialtypeController extends Controller
{
    public function index()
    {
        $data = Materialtype::orderBy('id', 'desc')->get();

        return MaterialtypeResource::collection($data);
    }

    public function store(Request $request)
    {
       Materialtype::create([
            'name' => $request->name,
            'status' => $request->status,
            'materialcategory_id' => $request->materialcategory_id,
            'description' => $request->description,
        ]);

        return redirect()->route('materials');
    }
}
