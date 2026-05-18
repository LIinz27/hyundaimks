<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Share siteSettings ke semua views (untuk footer, bubble chat, dll.)
        View::composer('*', function ($view) {
            if (Schema::hasTable('site_settings')) {
                $view->with('siteSettings', SiteSetting::allSettings());
            } else {
                $view->with('siteSettings', []);
            }
        });
    }
}
