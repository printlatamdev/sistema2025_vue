<?php

namespace App\Http\Controllers;

use App\Enums\QuoteStatusEnum;
use App\Http\Requests\PivotProductQuoteRequest;
use App\Http\Requests\QuoteRequest;
use App\Http\Resources\ContactResource;
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

    public function store(QuoteRequest $request)
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
        Quotedetail::create(['quote_id' => $data->id, 'total_products' => 0, 'iva' => 0, 'total' => 0]);

        return new QuoteResource($data);
    }

    public function update(QuoteRequest $request, $id)
    {
        $quote = Quote::find($id);
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

    public function storeInPivot(PivotProductQuoteRequest $request)
    {
        $image = new ImageController;
        $quote = Quote::find($request->quote_id);
        $total = $request->price * $request->quantity;
        //store in pivot table
        $quote->products()->attach($request->product_id, [
            'price' => $request->price, 'quantity' => $request->quantity, 'total' => $total, 'details' => $request->details,
        ]);
        $image->store($request->url, Product::class, $quote->id);

        return redirect()->route('quotations');
    }

    public function storeInQuoteDetail(Request $request, Quote $quote)
    {
        //Store in quotedetail table
        $getData = $quote->products->pluck('pivot');
        foreach ($getData as $data) {
            $total = $data->sum('total');
            $request->iva == null ? $totaltotal = $total : $totaltotal = $total + ($total * $request->iva);
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

    public function getContactByCompany(Company $company)
    {
        $data = Contact::where('company_id', $company->id)->get();

        return ContactResource::collection($data);
    }

    public function getProductPivot(Quote $quote)
    {
        $data = Quote::where('id', $quote->id)
            ->orderBy('id', 'desc')
            ->get();

        return QuoteResource::collection($data);
    }

    public function getQuoteReport(Quotedetail $quotedetail)
    {
        $qd = $quotedetail->with('quote')->get();
        $quote = Quote::where('id', $qd[0]->quote_id)->with(['contact', 'company', 'user', 'products'])->get();
        $data = ['quotedetail' => $qd, 'quote' => $quote, 'date' => Carbon::parse($qd[0]->created_at)->format('Y-m-d')];

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
