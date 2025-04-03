<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)
->prefix('auth')
->group(function () {
    Route::post('/signup', 'signup');
    Route::post('/login', 'login');
});
