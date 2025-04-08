<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)
->prefix('product')
->group(function () {
    Route::get('/list', 'list');
    Route::get('/show/{id}', 'show');
});

Route::controller(CartController::class)
->middleware('auth:sanctum')
->prefix('cart')
->group(function () {
    Route::post('/add', 'add');
    Route::get('/show', 'show');
    Route::put('/update/{id}', 'update');
    Route::delete('/delete/{id}', 'delete');
});

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the Main API',
        'version' => '1.0.0'
    ]);
});
