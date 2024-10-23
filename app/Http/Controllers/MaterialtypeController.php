<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaterialTypeRequest;
use App\Http\Resources\MaterialtypeResource;
use App\Models\Color;
use App\Models\Materialtype;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MaterialtypeController extends Controller
{
    public function index()
    {
        $data = Materialtype::orderBy('id', 'desc')->get();

        return MaterialtypeResource::collection($data);
    }

    public function store(StoreMaterialTypeRequest $request)
    {
        Materialtype::create([
            'name' => $request->name,
            'code' => $request->code,
            'measure' => $request->measure,
            'status' => 1,
            'materialcategory_id' => $request->materialcategory_id,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.types', $request->materialcategory_id);
    }

    public function show($id)
    {
        $data = Materialtype::find($id);

        return MaterialtypeResource::make($data);
    }

    public function storeInColorMaterialtype(Request $request)
    {
        /**$num = 1;
        $type = Materialtype::find($request->materialtype_id);
        $color = Color::find($request->color_id);

        foreach ($type->colors as $item) {
            //$slice =  Str::contains($item->pivot->code, $type->code);
            $padded = Str::padLeft($num++, 3, '0');
            $code = $type->code.$color->name[0].$padded;

            $type->colors()->attach($request->color_id, [
                'code' => $code,
                'entry_date' => Carbon::now(),
                'departure_date' => $request->departure_date,
                'use_date' => $request->use_date,
                'expiration_date' => $request->expiration_date,
            ]);
        } */
    }
}
