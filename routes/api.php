<?php

use App\Http\Controllers\QuoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**Route::controller(QuoteController::class)->group(function () {
    Route::put('/get-pivot/{quote}', 'storeInQuoteDetail');
}); */
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
