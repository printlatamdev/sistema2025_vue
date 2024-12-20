<?php

namespace App\Http\Controllers;

use App\Enums\OrderEnum;
use App\Enums\PaymentConditionEnum;
use App\Http\Requests\StorePurchaseorderRequest;
use App\Http\Resources\PurchaseorderdetailResource;
use App\Http\Resources\PurchaseorderResource;
use App\Mail\SendPurchaseorder;
use App\Models\Material;
use App\Models\Provider;
use App\Models\Purchaseorder;
use App\Models\PurchaseorderDetail;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class PurchaseorderController extends Controller
{
    public function index()
    {
        $data = Purchaseorder::orderBy('id', 'desc')->get();
        $pod = PurchaseorderDetail::orderBy('id', 'desc')->get();

        return Inertia::render('Purchaseorder/Index', [
            'purchaseorders' => PurchaseorderResource::collection($data),
            'materials' => Material::get(),
            'purchaseorderdetails' => PurchaseorderdetailResource::collection($pod),
            'requestedBy' => User::whereHas('roles', function (Builder $query) {
                $query->where('id', 2);
            })->orderBy('id', 'desc')->get(),
            'approvedBy' => User::whereHas('roles', function (Builder $query) {
                $query->where('id', 1);
            })->orderBy('id', 'desc')->get(),
            'providers' => Provider::get(),
            'users' => User::get(),
            'orderTypes' => OrderEnum::cases(),
            'payment_conditions' => PaymentConditionEnum::cases(),
        ]);
    }

    public function store(StorePurchaseorderRequest $request)
    {
        $data = Purchaseorder::create([
            'provider_id' => $request->provider_id,
            'details' => $request->details,
            'ordertype' => $request->ordertype,
            'approvedBy' => $request->approvedBy,
            'requestedBy' => $request->requestedBy,
        ]);
        /** $status = User::whereIn('id', $request->users)->whereHas('roles', function ($query) {
            return $query->groupBy('id')->orderBy('id', 'desc');
        })->get();
        $data->users()->attach($request->users, [
            'approvedBy' => $status[0]->name,
            'requestedBy' => $status[1]->name,
        ]); */
        PurchaseorderDetail::create(['purchaseorder_id' => $data->id, 'total_materials' => 0, 'iva' => 0, 'total' => 0]);

        return new PurchaseorderResource($data);
    }

    public function update(Request $request, Purchaseorder $purchaseorder)
    {
        $purchaseorder->update([
            'provider_id' => $request->provider_id,
            'details' => $request->details,
            'ordertype' => $request->ordertype,
            'approvedBy' => $request->approvedBy,
            'requestedBy' => $request->requestedBy,
        ]);

        return redirect()->route('purchaseorders');
    }

    public function destroy(Purchaseorder $purchaseorder)
    {
        $purchaseorder->delete();

        return redirect()->route('purchaseorders');
    }

    public function getPODetail(Purchaseorder $purchaseorder)
    {
        $data = PurchaseorderDetail::where('purchaseorder_id', $purchaseorder->id)->orderBy('id', 'desc')->get();

        return PurchaseorderdetailResource::collection($data);
    }

    public function storeInPivot(Request $request)
    {
        $iva = $request->iva / 100;
        $order = Purchaseorder::find($request->purchaseorder_id);
        $subtotal = $request->price * $request->quantity;
        //store in pivot table
        $order->materials()->attach($request->material_id, [
            'price' => $request->price,
            'quantity' => $request->quantity,
            'subtotal' => $subtotal,
            'details' => $request->details,
        ]);
        //store in detail table
        $getData = $order->materials->pluck('pivot');
        $totalSum = $getData->sum('subtotal');
        $detail = PurchaseorderDetail::where('purchaseorder_id', $request->purchaseorder_id)->get();

        $total = $totalSum + ($totalSum * $iva);
        foreach ($detail as $item) {
            $item->update([
                'total_materials' => $totalSum,
                'iva' => $totalSum * $iva,
                'total' => $total,
            ]);
        }

        return redirect()->route('purchaseorders');
    }

    public function getPurchaseorderPivot($id)
    {
        $po = Purchaseorder::find($id);
        $data = Purchaseorder::where('id', $po->id)
            ->orderBy('id', 'desc')
            ->get();

        return PurchaseorderResource::collection($data);
    }

    public function sendPurchaseOrder(Request $request)
    {
        $emailData = [
            'purchaseorder_id' => $request->purchaseorder_id,
            'title' => $request->title,
            'body' => $request->body,
        ];
        //$this->storeReport($request->report, $request->purchaseorder_id);
        foreach ([$request->users] as $recipient) {
            Mail::to($recipient)->send(new SendPurchaseorder($emailData));
        }

        return redirect()->route('purchaseorders');
    }

    public function getPurchaseOrderReport($id)
    {
        $pod = PurchaseorderDetail::find($id);
        $purchaseorder = Purchaseorder::where('id', $pod->purchaseorder_id)->with(['provider', 'materials'])->get();
        $data = [
            'purchaseorderDetail' => $pod,
            'purchaseorder' => $purchaseorder,
            'report' => $pod->report,
            'date' => Carbon::parse($pod->created_at)->format('Y-m-d'),
        ];
        $pdf = Pdf::loadView('reports/purchaseorderReport', compact('data'));

        return $pdf->stream('orden-de-compra-'.$pod->id.Carbon::now().'-'.'.pdf');
    }

    public function storeReport($id)
    {
        $file = new FileController;
        $pod = PurchaseorderDetail::find($id);
        $purchaseorder = Purchaseorder::where('id', $pod->purchaseorder_id)->with(['provider', 'materials'])->get();
        $data = [
            'purchaseorderDetail' => $pod,
            'purchaseorder' => $purchaseorder,
            'report' => $pod->report,
            'date' => Carbon::parse($pod->created_at)->format('Y-m-d'),
        ];
        $pdf = Pdf::loadView('reports/purchaseorderReport', compact('data'));
        //Store in polymorphic table
        $file->store($pdf, PurchaseorderDetail::class, $id);
        $pod->file()->save($pdf);

        return $pdf->download('orden-de-compra-'.$pod->id.Carbon::now().'-'.'.pdf', $pdf->output());
    }
}
