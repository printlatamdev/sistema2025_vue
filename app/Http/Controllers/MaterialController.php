<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Http\Resources\MaterialcategoryResource;
use App\Http\Resources\MaterialResource;
use App\Http\Resources\MaterialtypeResource;
use App\Models\Brand;
use App\Models\Material;
use App\Models\Materialcategory;
use App\Models\Materialtype;
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

    public function getCategories()
    {
        $data = Materialcategory::orderBy('id', 'desc')->get();

        return Inertia::render('Material/Category', [
            'categories' => MaterialcategoryResource::collection($data),
        ]);
    }

    public function getTypeFromCategories($id)
    {
        $cat = Materialcategory::find($id);
        $data = Materialtype::where('materialcategory_id', $cat->id)->orderBy('id', 'desc')->get();

        return Inertia::render('Material/Index', [
            'types' => MaterialtypeResource::collection($data),
            'categories' => MaterialcategoryResource::make($cat),
            'brands' => BrandResource::collection(Brand::get()),
        ]);
    }

    public function getMaterialFromType($id)
    {
        $type = Materialtype::find($id);
        $data = Material::where('materialtype_id', $type->id)->orderBy('id', 'desc')->get();

        return MaterialResource::collection($data);
    }
}
