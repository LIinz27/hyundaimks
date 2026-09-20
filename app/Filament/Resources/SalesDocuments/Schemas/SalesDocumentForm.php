<?php

namespace App\Filament\Resources\SalesDocuments\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SalesDocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('sales_id')
                    ->relationship('sales', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->visible(fn () => auth()->user()?->isAdmin()),
                Hidden::make('sales_id')
                    ->default(fn () => auth()->user()?->sales?->id)
                    ->dehydrated()
                    ->hidden(fn () => (bool) auth()->user()?->isAdmin()),
                FileUpload::make('file_path')
                    ->image()
                    ->disk('public')
                    ->directory('sales/documents')
                    ->maxSize(4096)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->required(),
                TextInput::make('caption'),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
