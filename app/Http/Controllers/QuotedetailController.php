<?php

namespace App\Http\Controllers;

use App\Models\Quotedetail;
use Illuminate\Http\Request;

class QuotedetailController extends Controller
{
    
    public function store(Request $request)
    {
        $image = new ImageController;
        $subtotal = $request->price * $request->quantity;
        $data = Quotedetail::insert([
            'quote_id' => $request->quote_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'iva' => $request->iva,
            'price' => $request->price,
            'subtotal' => $subtotal,
            'details' => $request->details,
        ]);
        $image->store($request->image, Quotedetail::class, $data->id);
        //$file->store($request->file, Quote::class, $data->id);

        return redirect()->to('/quotes');
    }
}
