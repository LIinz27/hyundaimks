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
use Illuminate\Database\Eloquent\Builder;

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

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (! auth()->user()?->isAdmin()) {
            $salesId = auth()->user()?->sales?->id;

            if ($salesId) {
                $query->where('sales_id', $salesId);
            } else {
                $query->whereRaw('1 = 0');
            }
        }

        return $query;
    }

    public static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();

        return $user && ($user->isAdmin() || $user->sales()->exists());
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();

        return $user && ($user->isAdmin() || $user->sales()->exists());
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
