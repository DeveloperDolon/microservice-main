<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)
->prefix('product')
->group(function () {
    Route::get('/list', 'list');
    Route::get('/show/{id}', 'show');
});

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the Main API',
        'version' => '1.0.0'
    ]);
});
