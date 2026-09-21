<?php

namespace App\Filament\Widgets;

use App\Filament\Pages\MyProfile;
use App\Filament\Resources\SalesDocuments\SalesDocumentResource;
use App\Models\SalesDocument;
use Filament\Widgets\Widget;

class SalesOverviewWidget extends Widget
{
    protected string $view = 'filament.widgets.sales-overview';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        // Hanya tampil untuk non-admin (sales). Dashboard admin tidak berubah.
        return auth()->check() && ! auth()->user()->isAdmin();
    }

    protected function getViewData(): array
    {
        $salesId = auth()->user()?->sales?->id;

        $dokumenTerbaru = $salesId
            ? SalesDocument::query()
                ->where('sales_id', $salesId)
                ->latest()
                ->limit(5)
                ->get()
            : collect();

        return [
            'dokumenTerbaru' => $dokumenTerbaru,
            'profilUrl' => MyProfile::getUrl(),
            'dokumentasiUrl' => SalesDocumentResource::getUrl('index'),
        ];
    }
}
