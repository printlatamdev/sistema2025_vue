<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuotedetailController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('/companies', CompanyController::class)->except(['create', 'edit'])->names([
        'index' => 'companies', 'store' => 'store.companies', 'show' => 'show.companies', 'update' => 'update.companies', 'destroy' => 'delete.companies',
    ]);

    //quote routes
    Route::resource('/quotations', QuoteController::class)->except(['create', 'edit'])->names([
        'index' => 'quotations', 'store' => 'store.quotations', 'show' => 'show.quotations', 'update' => 'update.quotations', 'destroy' => 'delete.quotations',
    ]);
    Route::controller(QuoteController::class)->group(function () {
        Route::post('/store-quoteproduct', 'storeInPivot')->name('store.productquote');
        Route::post('/get-quotedetails', 'getQuotedetails')->name('get.quotedetails');
        Route::get('/products-quote/{quote}', 'getPivot')->name('product.quote');
        Route::put('/store-quotedetail/{quote}', 'storeInQuoteDetail')->name('store.quotedetail');
        Route::get('/get-report/{quotedetail}', 'getQuoteReport')->name('report.quote');
    });

    //quotedetail routes
    Route::resource('/quote-details', QuotedetailController::class)->except(['create', 'edit'])->names([
        'index' => 'quotedetails', 'store' => 'store.quotedetails', 'show' => 'show.quotedetails', 'update' => 'update.quotedetails', 'destroy' => 'delete.quotedetails',
    ]);

    //contact routes
    Route::resource('/contacts', ContactController::class)->except(['create', 'edit'])->names([
        'index' => 'contacts', 'store' => 'store.contacts', 'show' => 'show.contacts', 'update' => 'update.contacts', 'destroy' => 'delete.contacts',
    ]);
});
