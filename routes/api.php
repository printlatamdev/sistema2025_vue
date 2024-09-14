<?php

use App\Http\Controllers\QuoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(QuoteController::class)->group(function () {
    Route::get('/get-pivot/{quote}', 'getPivot');
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
