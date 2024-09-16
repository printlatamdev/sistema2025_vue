<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuotedetailResource;
use App\Models\Quotedetail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuotedetailController extends Controller
{

    
    public function store(Request $request)
    {
        Quotedetail::create([
            'quote_id' => $request->quote_id,
            'iva' => $request->iva,
            'total' => $request->total,
        ]);

        return redirect()->route('quotations');
    }
}
