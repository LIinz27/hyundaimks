<?php

namespace App\Filament\Resources\Sales\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class SalesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_path')
                    ->disk('public')
                    ->circular()
                    ->size(40),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('slug')
                    ->copyable()
                    ->toggleable(),
                TextColumn::make('whatsapp')
                    ->label('WhatsApp')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort(['sort_order' => 'asc', 'name' => 'asc'])
            ->filters([
                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        '1' => 'Aktif',
                        '0' => 'Nonaktif',
                    ]),
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('toggleActive')
                    ->label(fn ($record) => $record->is_active ? 'Nonaktifkan' : 'Aktifkan')
                    ->icon(fn ($record) => $record->is_active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->action(function ($record) {
                        $record->update(['is_active' => ! $record->is_active]);

                        Notification::make()
                            ->success()
                            ->title($record->is_active ? 'Sales diaktifkan' : 'Sales dinonaktifkan')
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('activateAll')
                        ->label('Aktifkan semua')
                        ->icon('heroicon-o-check-circle')
                        ->action(function (Collection $records) {
                            $records->each->update(['is_active' => true]);

                            Notification::make()
                                ->success()
                                ->title('Sales diaktifkan')
                                ->send();
                        }),
                    BulkAction::make('deactivateAll')
                        ->label('Nonaktifkan semua')
                        ->icon('heroicon-o-x-circle')
                        ->action(function (Collection $records) {
                            $records->each->update(['is_active' => false]);

                            Notification::make()
                                ->success()
                                ->title('Sales dinonaktifkan')
                                ->send();
                        }),
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
