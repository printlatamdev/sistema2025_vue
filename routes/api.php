<?php

use App\Http\Controllers\PurchaseorderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/storepivot/{purchaseorder}', [PurchaseorderController::class, 'getPurchaseorderPivot']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
