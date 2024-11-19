<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

Route::view('/', 'homepage/home');

Route::controller(Controller::class)->group(function () {
    Route::get('/pricelist', 'pricelist');
    Route::get('/proses-kredit', 'kredit');
    Route::get('/simulasi-kredit', 'simulasi');
    Route::get('/tes-drive', 'tesdrive');
    Route::get('/portofolio', 'portofolio');
    Route::get('/kontak', 'kontak');
});

Route::prefix('product')->controller(Controller::class)->group(function () {
    Route::get('/stargazer', 'hyundai_stargazer');
    Route::get('/creta', 'hyundai_creta');
    Route::get('/stargazer-x', 'hyundai_stargazer_x');
    Route::get('/hyundai-kona', 'hyundai_kona');
    Route::get('/santa-fe', 'hyundai_santa_fe');
    Route::get('/staria', 'hyundai_staria');
    Route::get('/ioniq-5', 'hyundai_ioniq_5');
    Route::get('/palisade', 'hyundai_palisade');
    Route::get('/ioniq-6', 'hyundai_ioniq_6');
    Route::get('/all-new-santa-fe', 'hyundai_all_new_santa_fe');
});
