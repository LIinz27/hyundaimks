<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;

Route::get('/', [Controller::class, 'home']);

Route::controller(Controller::class)->group(function () {
    Route::get('/pricelist', 'pricelist');
    Route::get('/pricelist-download', 'pricelistDownload')->name('pricelist.download');
    Route::get('/proses-kredit', 'kredit');
    Route::get('/simulasi-kredit', 'simulasi');
    Route::post('/simulasi-kredit', 'simulasiStore')->name('simulasi.store');
    Route::get('/tes-drive', 'tesdrive');
    Route::post('/tes-drive', 'tesdriveStore')->name('tesdrive.store');
    Route::get('/portofolio', 'portofolio');
    Route::get('/kontak', 'kontak');
    Route::post('/kontak', 'kontakStore')->name('kontak.store');
});

// ─── Admin ────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->controller(AdminController::class)->group(function () {
    Route::get('/login', 'loginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');

    Route::get('/', 'dashboard')->name('dashboard');

    Route::get('/test-drives', 'testDriveIndex')->name('test-drives.index');
    Route::delete('/test-drives/{testDrive}', 'testDriveDestroy')->name('test-drives.destroy');

    Route::get('/simulasi', 'simulasiIndex')->name('simulasi.index');
    Route::delete('/simulasi/{simulasiKredit}', 'simulasiDestroy')->name('simulasi.destroy');

    Route::get('/kontak', 'kontakIndex')->name('kontak.index');
    Route::delete('/kontak/{kontak}', 'kontakDestroy')->name('kontak.destroy');

    Route::get('/promo', 'promoIndex')->name('promo.index');
    Route::post('/promo', 'promoStore')->name('promo.store');
    Route::delete('/promo/{promo}', 'promoDestroy')->name('promo.destroy');

    Route::get('/pricelist', 'pricelistIndex')->name('pricelist.index');
    Route::post('/pricelist', 'pricelistStore')->name('pricelist.store');
    Route::delete('/pricelist/{pricelist}', 'pricelistDestroy')->name('pricelist.destroy');

    Route::get('/galeri', 'galeriIndex')->name('galeri.index');
    Route::post('/galeri', 'galeriStore')->name('galeri.store');
    Route::post('/galeri/urutan', 'galeriUpdateUrutan')->name('galeri.urutan');
    Route::delete('/galeri/{galeri}', 'galeriDestroy')->name('galeri.destroy');

    Route::get('/mobil', 'mobilIndex')->name('mobil.index');
    Route::post('/mobil', 'mobilStore')->name('mobil.store');
    Route::put('/mobil/{mobil}', 'mobilUpdate')->name('mobil.update');
    Route::delete('/mobil/{mobil}', 'mobilDestroy')->name('mobil.destroy');

    Route::get('/banner', 'bannerIndex')->name('banner.index');
    Route::post('/banner', 'bannerStore')->name('banner.store');
    Route::post('/banner/{banner}/aktif', 'bannerSetActive')->name('banner.aktif');
    Route::delete('/banner/{banner}', 'bannerDestroy')->name('banner.destroy');

    Route::get('/sales', 'salesIndex')->name('sales.index');
    Route::post('/sales', 'salesUpdate')->name('sales.update');

    Route::get('/pengaturan', 'settingsIndex')->name('pengaturan.index');
    Route::post('/pengaturan', 'settingsUpdate')->name('pengaturan.update');

    Route::get('/partner', 'partnerIndex')->name('partner.index');
    Route::post('/partner', 'partnerStore')->name('partner.store');
    Route::post('/partner/urutan', 'partnerUpdateUrutan')->name('partner.urutan');
    Route::delete('/partner/{partner}', 'partnerDestroy')->name('partner.destroy');
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
