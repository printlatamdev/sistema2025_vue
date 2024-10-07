<?php

namespace App\Http\Controllers;

use App\Enums\OrderEnum;
use App\Enums\PaymentConditionEnum;
use App\Http\Resources\PurchaseorderResource;
use App\Models\Material;
use App\Models\Provider;
use App\Models\Purchaseorder;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PurchaseorderController extends Controller
{
    public function index()
    {
        $data = Purchaseorder::orderBy('id', 'desc')->get();

        return Inertia::render('Purchaseorder/Index', [
            'purchaseorders' => PurchaseorderResource::collection($data),
            'materials' => Material::get(),
            'requestedBy' => User::whereHas('roles', function (Builder $query) {
                $query->where('id', 2);
            })->orderBy('id', 'desc')->get(),
            'approvedBy' => User::whereHas('roles', function (Builder $query) {
                $query->where('id', 1);
            })->orderBy('id', 'desc')->get(),
            'providers' => Provider::get(),
            'orderTypes' => OrderEnum::cases(),
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
        $data->users()->attach($request->users, []);

        return new PurchaseorderResource($data);
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
