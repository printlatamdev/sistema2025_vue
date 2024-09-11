<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuoteController extends Controller
{
    
    public function index(){
        $data = Quote::orderBy('id', 'desc')->get();
        return Inertia::render('Quote/Index', [
            'quotes' => $data
        ]);
    }
}
