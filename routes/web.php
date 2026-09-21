<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Filament\Facades\Filament;
use Filament\Http\Middleware\SetUpPanel;

// URL login kustom: /admin/login di-redirect ke /login/admin (link lama tidak mati).
Route::middleware(SetUpPanel::class . ':admin')->group(function () {
    Route::get('/login/admin', fn () => redirect('/login?tab=admin'))
        ->name('filament.admin.auth.login');

    Route::get('/login/sales', fn () => redirect('/login?tab=sales'))
        ->name('filament.admin.auth.login.sales');

    Route::get('/admin/login', fn () => redirect('/login/admin'));
});

// Halaman login gabungan dengan dua tab (Admin & Sales). Panel tujuan
// ditentukan dari tab aktif oleh UnifiedLogin, bukan dari konteks panel.
Route::get('/login', \App\Filament\Pages\Auth\UnifiedLogin::class)->name('login');

Route::middleware('sales.context')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::controller(Controller::class)->group(function () {
        Route::get('/pricelist', 'pricelist')->name('pricelist');
        Route::get('/proses-kredit', 'kredit')->name('proses-kredit');
        Route::get('/simulasi-kredit', 'simulasi')->name('simulasi-kredit');
        Route::get('/tes-drive', 'tesdrive')->name('tes-drive');
        Route::get('/portofolio', 'portofolio')->name('portofolio');
        Route::get('/kontak', 'kontak')->name('kontak');
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
});
