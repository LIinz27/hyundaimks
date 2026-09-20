<?php

namespace App\Filament\Resources\SalesDocuments\Pages;

use App\Filament\Resources\SalesDocuments\SalesDocumentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSalesDocument extends CreateRecord
{
    protected static string $resource = SalesDocumentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (! auth()->user()?->isAdmin()) {
            $data['sales_id'] = auth()->user()?->sales?->id;
        }

        return $data;
    }
}
