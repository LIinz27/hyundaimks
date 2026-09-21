<?php

namespace App\Providers\Filament;

use App\Filament\Pages\MyProfile;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

/**
 * Panel khusus sales di /sales. Panel ini SENGAJA tidak ->default()
 * dan tidak ->discoverResources()/->discoverPages(): halaman didaftarkan
 * eksplisit supaya resource Users/Sales/Galeris milik admin tidak bocor
 * ke panel sales. Namespace App\Filament\Pages di-discover oleh panel
 * admin, jadi MyProfile ditulis manual di ->pages().
 */
class SalesPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('sales')
            ->path('sales')
            ->login(\App\Filament\Pages\Auth\SalesLogin::class)
            ->brandName('Hyundai Makassar — Sales')
            ->colors([
                'primary' => Color::hex('#1c4682'),
            ])
            ->favicon(asset('images/hyundai-logo.png'))
            ->pages([
                Dashboard::class,
                MyProfile::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
