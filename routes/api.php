<?php

use App\Http\Controllers\PurchaseorderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/storepivot', [PurchaseorderController::class, 'storeInPivot']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
