<?php

namespace App\Http\Controllers;

use App\Enums\QuoteStatusEnum;
use App\Http\Resources\QuoteResource;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::orderBy('id', 'desc')->get();

        return Inertia::render('Quote/Index', [
            'quotes' => QuoteResource::collection($quotes),
            'users' => User::orderBy('id', 'desc')->get(),
            'companies' => Company::orderBy('id', 'desc')->get(),
            'contacts' => Contact::orderBy('id', 'desc')->get(),
            'products' => Product::orderBy('id', 'desc')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = Quote::create([
            'important_note' => $request->important_note,
            'payment_condition' => $request->payment_condition,
            'offer_validity' => $request->offer_validity,
            'currency' => $request->currency,
            'status' => QuoteStatusEnum::Review,
            'incoterm' => $request->incoterm,
            'user_id' => $request->user_id,
            'company_id' => $request->company_id,
            'contact_id' => $request->contact_id,
        ]);

        return redirect()->route('quotations');
    }

    public function update(Request $request, Quote $quote)
    {
        $quote->update([
            'important_note' => $request->important_note,
            'payment_condition' => $request->payment_condition,
            'offer_validity' => $request->offer_validity,
            'currency' => $request->currency,
            'status' => $request->status,
            'incoterm' => $request->incoterm,
            'user_id' => $request->user_id,
            'company_id' => $request->company_id,
            'contact_id' => $request->contact_id,
        ]);
        $subtotal = $request->price * $request->quantity;
        $quote->products()->attach($request->product_id, [
            'price' => $request->price, 'quantity' => $request->quantity, 'subtotal' => $subtotal, 'details' => $request->details,
        ]);
        return redirect()->route('quotations');
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();

        return redirect()->route('quotations');
    }
}
