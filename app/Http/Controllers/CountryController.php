<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        $data = Country::orderBy('id', 'desc')->get();

        return CountryResource::collection($data);
    }

    public function store(StoreCountryRequest $request)
    {
        $image = new ImageController;
        $data = Country::create([
            'name' => $request->name,
            'acronym' => $request->acronym,
        ]);
        $img = $image->store($request->image, Country::class, $data->id);
        $data->image()->save($img);

        return redirect()->route('login');
    }
}
