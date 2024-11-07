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

Route::get('/product/stargazer', [App\Http\Controllers\Controller::class, 'hyundai_stargazer']);
Route::get('/product/creta', [App\Http\Controllers\Controller::class, 'hyundai_creta']);
Route::get('/product/stargazer-x', [App\Http\Controllers\Controller::class, 'hyundai_stargazer_x']);
Route::get('/product/hyundai-kona', [App\Http\Controllers\Controller::class, 'hyundai_kona']);
Route::get('/product/santa-fe', [App\Http\Controllers\Controller::class, 'hyundai_santa_fe']);
Route::get('/product/staria', [App\Http\Controllers\Controller::class, 'hyundai_staria']);
Route::get('/product/ioniq-5', [App\Http\Controllers\Controller::class, 'hyundai_ioniq_5']);
Route::get('/product/palisade', [App\Http\Controllers\Controller::class, 'hyundai_palisade']);
Route::get('/product/ioniq-6', [App\Http\Controllers\Controller::class, 'hyundai_ioniq_6']);
Route::get('/product/all-new-santa-fe', [App\Http\Controllers\Controller::class, 'hyundai_all_new_santa_fe']);


