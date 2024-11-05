<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage/home');
});

Route::get('/pricelist', [App\Http\Controllers\PricelistController::class, 'index']);
