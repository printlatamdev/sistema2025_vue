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
        $data = Materialtype::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('materials');
    }
}
