<?php

namespace App\Filament\Resources\SalesDocuments\Pages;

use App\Filament\Resources\SalesDocuments\SalesDocumentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSalesDocument extends EditRecord
{
    protected static string $resource = SalesDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
