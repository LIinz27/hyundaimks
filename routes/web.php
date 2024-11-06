<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage/home');
});

Route::get('/pricelist', [App\Http\Controllers\Controller::class, 'pricelist']);
Route::get('/proses-kredit', [App\Http\Controllers\Controller::class, 'kredit']);
Route::get('/simulasi-kredit', [App\Http\Controllers\Controller::class, 'simulasi']);
Route::get('/tes-drive', [App\Http\Controllers\Controller::class, 'tesdrive']);
Route::get('/portofolio', [App\Http\Controllers\Controller::class, 'portofolio']);
Route::get('/kontak', [App\Http\Controllers\Controller::class, 'kontak']);

