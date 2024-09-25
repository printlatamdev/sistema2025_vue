<?php

namespace App\Http\Controllers;

use App\Http\Resources\MaterialResource;
use App\Models\Material;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MaterialController extends Controller
{
    public function index()
    {
        $data = Material::orderBy('id', 'desc')->get();

        return Inertia::render('Material/Index', [
            'materials' => MaterialResource::collection($data),
        ]);
    }

    public function store(Request $request)
    {
        Material::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'serie' => $request->serie,
            'ounce' => $request->ounce,
            'thickness' => $request->thickness,
            'width' => $request->width,
            'lenght' => $request->lenght,
            'color' => $request->color,
            'finish' => $request->finish,
            'density' => $request->density,
            'size' => $request->size,
            'gum' => $request->gum,
            'print' => $request->print,
            'category_id' => $request->category_id,
            'type_id' => $request->type_id,
        ]);

        return redirect()->route('materials');
    }

    public function update(Request $request, Material $material)
    {
        $material->update([
            'name' => $request->name,
            'brand' => $request->brand,
            'serie' => $request->serie,
            'ounce' => $request->ounce,
            'thickness' => $request->thickness,
            'width' => $request->width,
            'lenght' => $request->lenght,
            'color' => $request->color,
            'finish' => $request->finish,
            'density' => $request->density,
            'size' => $request->size,
            'gum' => $request->gum,
            'print' => $request->print,
            'category_id' => $request->category_id,
            'type_id' => $request->type_id,
        ]);

        return redirect()->route('materials');
    }

    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->route('materials');
    }
}
