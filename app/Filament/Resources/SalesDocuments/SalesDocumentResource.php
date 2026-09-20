<?php

namespace App\Filament\Resources\SalesDocuments;

use App\Filament\Resources\SalesDocuments\Pages\CreateSalesDocument;
use App\Filament\Resources\SalesDocuments\Pages\EditSalesDocument;
use App\Filament\Resources\SalesDocuments\Pages\ListSalesDocuments;
use App\Filament\Resources\SalesDocuments\Schemas\SalesDocumentForm;
use App\Filament\Resources\SalesDocuments\Tables\SalesDocumentsTable;
use App\Models\SalesDocument;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SalesDocumentResource extends Resource
{
    protected static ?string $model = SalesDocument::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Dokumentasi';

    protected static string|\UnitEnum|null $navigationGroup = 'Konten';

    protected static ?string $modelLabel = 'Dokumentasi';

    public static function form(Schema $schema): Schema
    {
        return SalesDocumentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SalesDocumentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSalesDocuments::route('/'),
            'create' => CreateSalesDocument::route('/create'),
            'edit' => EditSalesDocument::route('/{record}/edit'),
        ];
    }
}
