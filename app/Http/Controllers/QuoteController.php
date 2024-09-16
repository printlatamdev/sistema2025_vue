<?php

namespace App\Http\Controllers;

use App\Enums\QuoteStatusEnum;
use App\Http\Resources\QuotedetailResource;
use App\Http\Resources\QuoteResource;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Quote;
use App\Models\Quotedetail;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::orderBy('id', 'desc')->get();
        $qd = Quotedetail::orderBy('id', 'desc')->get();

        return Inertia::render('Quote/Index', [
            'quotes' => QuoteResource::collection($quotes),
            'users' => User::orderBy('id', 'desc')->get(),
            'companies' => Company::orderBy('id', 'desc')->get(),
            'contacts' => Contact::orderBy('id', 'desc')->get(),
            'products' => Product::orderBy('id', 'desc')->get(),
            'quotedetails' => QuotedetailResource::collection($qd),
        ]);
    }

    public function store(Request $request)
    {
        Quote::create([
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

        return redirect()->route('quotations');
    }

    public function storeInPivot(Request $request)
    {
        $quote = Quote::find($request->quote_id);
        $total = $request->price * $request->quantity;
        //store in pivot table
        $quote->products()->attach($request->product_id, [
            'price' => $request->price, 'quantity' => $request->quantity, 'total' => $total, 'details' => $request->details,
        ]);
        Quotedetail::create(['quote_id'=>$request->quote_id, 'total_products'=>0, 'iva'=>0, 'total' => 0]); 
        return redirect()->route('quotations');
    }

    public function storeInQuoteDetail(Request $request, Quote $quote)
    {
        //Store in quotedetail table
        $getData = $quote->products->pluck('pivot');
        foreach ($getData as $data) {
            $total = $data->sum('total');
            $totaltotal = $total + ($total * $request->iva);
            $qd = Quotedetail::where('quote_id', $quote->id)->first();
            $qd->update([
                'total_products' => $total,
                'quote_id' => $quote->id,
                'iva' => $request->iva,
                'total' => $totaltotal,
            ]);
            return redirect()->route('quotations');
        }
    }

    public function show(Quote $quote){
        return QuoteResource::make($quote);
    }

    public function getQuoteReport(Quotedetail $quotedetail){
        $qd = $quotedetail->with('quote')->get();
        $quote = Quote::where('id', $qd[0]->quote_id)->with(['contact', 'company', 'user'])->get();
        
        $data = [ 'quotedetail' => $qd, 'quote' => $quote];
       
        $pdf = Pdf::loadView('reports/quoteReport', compact('data'));   
        return $pdf->stream('cotizacion.pdf', ['Attachment' => false]);
        //$pdf->stream('cotizacion' . $quotedetail->id . Carbon::now() . '.pdf');  
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();

        return redirect()->route('quotations');
    }
}
