<?php

namespace App\Filament\Resources\Sales\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SalesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, Get $get, ?string $state, string $operation) {
                                if ($operation === 'create' && blank($get('slug'))) {
                                    $set('slug', Str::slug((string) $state));
                                }
                            }),
                        TextInput::make('title')
                            ->label('Jabatan')
                            ->placeholder('mis. Profesional Sales Consultant'),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/')
                            ->live(onBlur: true)
                            ->helperText('URL halaman: /sales/{slug}'),
                        Textarea::make('bio')
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                        FileUpload::make('photo_path')
                            ->image()
                            ->disk('public')
                            ->directory('sales/photos')
                            ->imageEditor()
                            ->maxSize(4096)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                    ]),
                Section::make('Kontak')
                    ->schema([
                        TextInput::make('whatsapp')
                            ->label('Nomor WhatsApp')
                            ->placeholder('08xx atau 628xx')
                            ->maxLength(20),
                        TextInput::make('phone')
                            ->label('Telepon')
                            ->tel(),
                        TextInput::make('email')
                            ->email(),
                    ]),
                Section::make('Publikasi')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Aktif (tampil di publik)')
                            ->default(true),
                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0),
                    ]),
                Section::make('Akun')
                    ->schema([
                        Select::make('user_id')
                            ->label('Akun Login')
                            ->relationship('user', 'email')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ]),
            ]);
    }
}
