<?php

namespace App\Http\Controllers;

use App\Enums\PaymentConditionEnum;
use App\Http\Resources\ProviderResource;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $data = Provider::orderBy('id', 'desc')->get();

        return ProviderResource::collection($data);
    }

    public function store(Request $request)
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
