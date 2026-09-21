<?php

namespace App\Filament\Widgets;

use App\Models\SalesDocument;
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

        $totalDokumen = $salesId
            ? SalesDocument::query()->where('sales_id', $salesId)->count()
            : 0;

        return [
            Stat::make('Dokumen Saya', $totalDokumen)
                ->description('Jumlah dokumentasi milik Anda')
                ->icon('heroicon-o-document-text'),
        ];
    }
}
