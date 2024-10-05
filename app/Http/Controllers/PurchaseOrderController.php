<?php

namespace App\Http\Controllers;

use App\Http\Resources\PurchaseorderResource;
use App\Models\Purchaseorder;
use Illuminate\Http\Request;
use App\Enums\PaymentConditionEnum;
use App\Models\Material;
use App\Models\Provider;
use App\Models\User;
use Inertia\Inertia;

class PurchaseorderController extends Controller
{
    public function index()
    {
        $data = Purchaseorder::orderBy('id', 'desc')->get();

        return Inertia::render('Purchaseorder/Index', [
            'purchaseorders' => PurchaseorderResource::collection($data),
            'materials' => Material::get(),
            'users' => User::get(),
            'providers' => Provider::get(),
            'payment_conditions' => PaymentConditionEnum::cases(),
        ]);
    }

    public function store(Request $request)
    {
        $data = Purchaseorder::create([
            'provider_id' => $request->provider_id,
            'details' => $request->details,
            'ordertype' => $request->ordertype,
        ]);
        $data->users()->attach($request->user_id, []);

        return redirect()->route('purchaseorders');
    }

    public function update(Request $request, Purchaseorder $purchaseorder)
    {
        $purchaseorder->update([
            'provider_id' => $request->provider_id,
            'details' => $request->details,
            'ordertype' => $request->ordertype,
        ]);

        return redirect()->route('purchaseorders');
    }

    public function destroy(Purchaseorder $purchaseorder)
    {
        $purchaseorder->delete();

        return redirect()->route('purchaseorders');
    }
}
