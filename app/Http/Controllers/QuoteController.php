<?php

namespace App\Http\Controllers;

use App\Enums\QuoteStatusEnum;
use App\Http\Requests\PivotProductQuoteRequest;
use App\Http\Requests\QuoteRequest;
use App\Http\Requests\StoreQuoteDetailRequest;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::orderBy('id', 'desc')->get();
        $qd = Quotedetail::orderBy('id', 'desc')->get();
        $qd->load('quote');

        return Inertia::render('Quote/Index', [
            'quotes' => QuoteResource::collection($quotes),
            'users' => User::whereHas('roles', function (Builder $query) {
                $query->where('id', 7);
            })->orderBy('id', 'desc')->get(),
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
        //store image
        $name = time().'.'.$request->image->extension();
        $urlImage = $request->image->storeAs('images', $name);
        $iva = $request->iva / 100;

        $quote = Quote::find($request->quote_id);
        $subtotal = $request->price * $request->quantity;
        //store in pivot table
        $quote->products()->attach($request->product_id, [
            'price' => $request->price,
            'quantity' => $request->quantity,
            'subtotal' => $subtotal,
            'details' => $request->details,
            'image' => Storage::url($urlImage),
        ]);
        $getData = $quote->products->pluck('pivot');
        $totalSum = $getData->sum('subtotal');
        $detail = Quotedetail::where('quote_id', $request->quote_id)->get();
        foreach ($detail as $item) {
            $item->update(['quote_id' => $quote->id, 'total_products' => $totalSum,
            ]);
        }

        return redirect()->route('quotations');
    }

    public function updateInQuoteDetail(StoreQuoteDetailRequest $request, $id)
    {
        //Store in quotedetail table
        $iva = $request->iva / 100;
        $detail = Quotedetail::find($id);
        $quote = Quote::where('quote_id', $detail->quote_id)->get();
        $getData = $quote->products->pluck('pivot');
        $totalSum = $getData->sum('subtotal');
        $total = $totalSum + ($totalSum * $iva);

        foreach ($detail as $item) {
            $item->update([
                'quote_id' => $quote->id,
                'total_products' => $totalSum,
                'iva' => $totalSum * $iva,
                'total' => $total,
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
        $data = Quote::where('id', $quote->id)->orderBy('id', 'desc')->get();

        return QuoteResource::collection($data);
    }

    public function getQuoteDetail(Quote $quote)
    {
        $data = Quotedetail::where('id', $quote->id)->orderBy('id', 'desc')->get();

        return QuotedetailResource::collection($data);
    }

    public function getQuoteReport(Quotedetail $quotedetail)
    {
        $quote = Quote::where('id', $quotedetail->quote_id)->with(['contact', 'company', 'user', 'products'])->get();
        $data = [
            'quotedetail' => $quotedetail,
            'quote' => $quote,
            'date' => Carbon::parse($quotedetail->created_at)->format('Y-m-d'),
        ];
        $pdf = Pdf::loadView('reports/quoteReport', compact('data'));

        return $pdf->stream('cotizacion-'.$quotedetail->id.Carbon::now().'-'.'.pdf');
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();

        return redirect()->route('quotations');
    }
}
