<?php

use App\Http\Controllers\BrandController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(BrandController::class)->group(function () {
    Route::get('/test', 'testFunction');
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
