<?php

namespace App\Http\Controllers;

use App\Enums\PaymentConditionEnum;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Resources\ProviderResource;
use App\Models\Provider;

class ProviderController extends Controller
{
    public function index()
    {
        $data = Provider::orderBy('id', 'desc')->get();

        return ProviderResource::collection($data);
    }

    public function store(StoreProviderRequest $request)
    {
        Provider::create([
            'name' => $request->name,
            'payment_condition' => $request->payment_condition,
        ]);

        //return redirect()->route('providers');
    }

    public function getEnumData()
    {
        $data = PaymentConditionEnum::cases();

        return response()->json([
            'payment_condition' => $data,
        ]);
    }
}
