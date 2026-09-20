<?php

namespace App\Providers;

use App\Models\Sales;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path('Support/helpers.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Homepage is served via Route::view(); inject sales data with a composer
        // so no route changes are needed.
        View::composer('homepage/home', function ($view) {
            $view->with('salesList', Sales::active()->ordered()->get());
        });
    }
}
