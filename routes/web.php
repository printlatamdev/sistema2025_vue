<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MaterialcategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialtypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuotedetailController;
use App\Http\Controllers\UserController;
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
        'index' => 'companies',
        'store' => 'store.companies',
        'update' => 'update.companies',
        'destroy' => 'delete.companies',
    ]);

    //quote routes
    Route::resource('/quotations', QuoteController::class)->except(['create', 'edit'])->names([
        'index' => 'quotations',
        'store' => 'store.quotations',
        'update' => 'update.quotations',
        'destroy' => 'delete.quotations',
    ]);
    Route::controller(QuoteController::class)->group(function () {
        Route::post('/store-quoteproduct', 'storeInPivot')->name('store.productquote');
        Route::post('/get-quotedetails', 'getQuotedetails')->name('get.quotedetails');
        Route::get('/products-quote/{quote}', 'getPivot')->name('product.quote');
        Route::put('/store-quotedetail/{quote}', 'storeInQuoteDetail')->name('store.quotedetail');
        Route::get('/quotations/get-report/{quotedetail}', 'getQuoteReport')->name('report.quote');
        Route::get('/contact-by-company/{company}', 'getContactByCompany')->name('contact.company');
        Route::get('/quoterefresh/{quote}', 'getProductPivot')->name('quoterefresh');
    });

    //quotedetail routes
    Route::resource('/quote-details', QuotedetailController::class)->except(['create', 'edit'])->names([
        'index' => 'quotedetails',
        'store' => 'store.quotedetails',
        'update' => 'update.quotedetails',
        'destroy' => 'delete.quotedetails',
    ]);

    //products routes
    Route::resource('/products', ProductController::class)->except(['create', 'edit'])->names([
        'index' => 'products',
        'store' => 'store.products',
        'update' => 'update.products',
        'destroy' => 'delete.products',
    ]);

    //contact routes
    Route::resource('/contacts', ContactController::class)->except(['create', 'edit'])->names([
        'index' => 'contacts',
        'store' => 'store.contacts',
        'update' => 'update.contacts',
        'destroy' => 'delete.contacts',
    ]);

    //contact routes
    Route::resource('/users', UserController::class)->except(['create', 'edit'])->names([
        'index' => 'users',
        'store' => 'store.users',
        'update' => 'update.users',
        'destroy' => 'delete.users',
    ]);

    //orders routes
    Route::resource('/orders', OrderController::class)->except(['create', 'edit'])->names([
        'index' => 'orders',
        'store' => 'store.orders',
        'update' => 'update.orders',
        'destroy' => 'delete.orders',
    ]);
    Route::controller(OrderController::class)->group(function () {
        Route::post('/store-material-order', 'storeInPivot')->name('store.materialorder');
    });

    //materials routes
    Route::resource('/materials', MaterialController::class)->except(['create', 'edit'])->names([
        'index' => 'materials',
        'store' => 'store.materials',
        'update' => 'update.materials',
        'destroy' => 'delete.materials',
    ]);
    Route::controller(MaterialController::class)->group(function () {
        Route::get('/categories', 'getCategories')->name('categories');
        Route::get('/{materialcategory}/types', 'getTypeFromCategories')->name('categories.types');
        Route::get('/types/materials/{type}', 'getMaterialFromType')->name('materials.types');
    });
    Route::resource('/categories', MaterialcategoryController::class)->except(['index', 'create', 'edit'])->names([
        'index' => 'categories',
        'store' => 'store.categories',
        'update' => 'update.categories',
        'destroy' => 'destroy.categories',
    ]);
    Route::resource('/types', MaterialtypeController::class)->except(['index', 'create', 'edit'])->names([
        'index' => 'types',
        'store' => 'store.types',
        'show' => 'show.types',
        'update' => 'update.types',
        'destroy' => 'destroy.types',
    ]);

    //brands routes
    Route::resource('/brands', BrandController::class)->except(['create', 'edit'])->names([
        'index' => 'brands',
        'store' => 'store.brands',
        'update' => 'update.brands',
        'destroy' => 'delete.brands',
    ]);

    //providers routes
    Route::resource('/providers', ProviderController::class)->except(['create', 'edit'])->names([
        'index' => 'providers',
        'store' => 'store.providers',
        'update' => 'update.providers',
        'destroy' => 'delete.providers',
    ]);
});
