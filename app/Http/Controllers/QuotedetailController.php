<?php

namespace App\Http\Controllers;

use App\Models\Quotedetail;
use Illuminate\Http\Request;

class QuotedetailController extends Controller
{
    
    public function store(Request $request)
    {
        $data = Quotedetail::insert([
            'quote_id' => $request->quote_id,
            'iva' => $request->iva,
            'total' => $request->total,
        ]);

        return redirect()->route('quotations');
    }
}
