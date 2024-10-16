<?php

use App\Http\Controllers\MaterialtypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', [MaterialtypeController::class, 'storeInColorMaterialtype']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
