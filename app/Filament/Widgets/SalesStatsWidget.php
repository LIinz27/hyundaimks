<?php

namespace App\Filament\Widgets;

use App\Models\Galeri;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SalesStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    public static function canView(): bool
    {
        // Hanya tampil untuk non-admin (sales). Dashboard admin tidak berubah.
        return auth()->check() && ! auth()->user()->isAdmin();
    }

    protected function getStats(): array
    {
        $salesId = auth()->user()?->sales?->id;

        $totalFoto = $salesId
            ? Galeri::query()->where('sales_id', $salesId)->count()
            : 0;

        $totalAktif = $salesId
            ? Galeri::query()->where('sales_id', $salesId)->where('is_active', true)->count()
            : 0;

        return [
            Stat::make('Foto Galeri Saya', $totalFoto)
                ->description($totalAktif.' tampil di beranda')
                ->icon('heroicon-o-photo'),
        ];
    }
}
