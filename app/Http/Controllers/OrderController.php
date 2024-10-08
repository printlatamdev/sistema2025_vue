<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $data = Order::orderBy('id', 'desc')->get();

        return Inertia::render('Order/Index', [
            'orders' => OrderResource::collection($data),
        ]);
    }

    public function store(Request $request)
    {
        $data = Order::create([
            'status' => 1,
            'computo' => $request->computo,
            'print' => $request->print,
            'cut' => $request->cut,
            'payment' => $request->payment,
            'mod' => $request->mod,
            'application_number' => $request->application_number,
            'delivery_date' => $request->delivery_date,
            'application_date' => $request->application_date,
            'assign_date' => $request->assign_date,
            'next_payment_date' => $request->next_payment_date,
            'country_id' => $request->country_id,
            'user_id' => $request->user_id,
            'company_id' => $request->company_id,
            'contact_id' => $request->contact_id,
        ]);

        return redirect()->route('orders');
    }

    public function update(Request $request, Order $order)
    {
        $order->update([
            'status' => 1,
            'computo' => $request->computo,
            'print' => $request->print,
            'cut' => $request->cut,
            'payment' => $request->payment,
            'mod' => $request->mod,
            'application_number' => $request->application_number,
            'delivery_date' => $request->delivery_date,
            'application_date' => $request->application_date,
            'assign_date' => $request->assign_date,
            'next_payment_date' => $request->next_payment_date,
            'country_id' => $request->country_id,
            'user_id' => $request->user_id,
            'company_id' => $request->company_id,
            'contact_id' => $request->contact_id,
        ]);

        return redirect()->route('orders');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders');
    }
}
