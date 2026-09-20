<?php

namespace App\Filament\Resources\SalesDocuments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SalesDocumentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('file_path')
                    ->disk('public')
                    ->size(40),
                TextColumn::make('sales.name')
                    ->searchable(),
                TextColumn::make('caption')
                    ->searchable(),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
