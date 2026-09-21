<?php

namespace App\Filament\Resources\Sales\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
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
                Tabs::make('Sales')
                    ->persistTabInQueryString()
                    ->tabs([
                        Tabs\Tab::make('profil')
                            ->label('Profil')
                            ->schema(self::profilTab()),
                        Tabs\Tab::make('galeri')
                            ->label('Galeri')
                            ->schema(self::galeriTab()),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    /**
     * Data diri, kontak, publikasi, dan akun.
     */
    protected static function profilTab(): array
    {
        return [
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
        ];
    }

    /**
     * Foto galeri milik sales ini. Tampil di carousel beranda, jadi urutan
     * dan status aktif diatur di sini.
     */
    protected static function galeriTab(): array
    {
        return [
            Repeater::make('galeris')
                ->label('Foto Galeri')
                ->relationship()
                ->orderColumn('sort_order')
                ->reorderable()
                ->addActionLabel('Tambah foto')
                ->itemLabel(fn (array $state): ?string => $state['caption'] ?? null)
                ->schema([
                    FileUpload::make('image_path')
                        ->label('Foto')
                        ->image()
                        ->disk('public')
                        ->directory('galeri/sales')
                        ->imageEditor()
                        ->maxSize(4096)
                        ->required()
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                    TextInput::make('caption')
                        ->label('Keterangan')
                        ->maxLength(255),
                    Toggle::make('is_active')
                        ->label('Tampil di beranda')
                        ->default(true),
                ])
                ->columns(1)
                ->helperText('Foto ini yang muncul di carousel beranda sales ini. Kalau semuanya dimatikan, beranda menampilkan frame kosong.'),
        ];
    }
}
