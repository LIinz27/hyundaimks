<?php

namespace App\Filament\Pages;

use App\Models\Sales;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class MyProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationLabel = 'Profil Saya';

    protected static ?string $title = 'Profil Saya';

    protected string $view = 'filament.pages.my-profile';

    public ?array $data = [];

    public function mount(): void
    {
        $sales = $this->getSales();

        if (! $sales) {
            Notification::make()
                ->title('Belum ada profil sales')
                ->body('Akun Anda belum terhubung ke data sales. Hubungi admin.')
                ->warning()
                ->persistent()
                ->send();
        }

        $this->form->fill($this->kumpulkanDataAwal($sales));
    }

    /**
     * Isi form awal: data profil ditambah foto galeri milik sales ini.
     * Galeri diisi sebagai array supaya Repeater bisa membacanya.
     */
    protected function kumpulkanDataAwal(?Sales $sales): array
    {
        if (! $sales) {
            return [];
        }

        return $sales->only(['name', 'title', 'bio', 'photo_path', 'whatsapp', 'phone', 'email']);
    }

    public static function canAccess(): bool
    {
        return auth()->check();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Profil')
                    ->persistTabInQueryString()
                    ->tabs([
                        Tabs\Tab::make('profil')
                            ->label('Profil')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('title')
                                    ->label('Jabatan')
                                    ->maxLength(255),
                                Textarea::make('bio')
                                    ->label('Tentang Saya')
                                    ->rows(4),
                                FileUpload::make('photo_path')
                                    ->label('Foto Profil')
                                    ->image()
                                    ->disk('public')
                                    ->directory('sales/photos')
                                    ->maxSize(4096)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                                TextInput::make('whatsapp')
                                    ->label('Nomor WhatsApp')
                                    ->maxLength(50),
                                TextInput::make('phone')
                                    ->label('Telepon')
                                    ->maxLength(50),
                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->maxLength(255),
                            ]),
                        Tabs\Tab::make('galeri')
                            ->label('Galeri')
                            ->schema([
                                Repeater::make('galeris')
                                    ->label('Foto Galeri')
                                    ->relationship('galeris')
                                    ->orderColumn('sort_order')
                                    ->addActionLabel('Tambah foto')
                                    ->reorderable()
                                    ->itemLabel(fn (array $state): ?string => $state['caption'] ?? null)
                                    ->schema([
                                        FileUpload::make('image_path')
                                            ->label('Foto')
                                            ->image()
                                            ->disk('public')
                                            ->directory('galeri/sales')
                                            ->maxSize(4096)
                                            ->required()
                                            ->formatStateUsing(function ($state): ?string {
                                                // Repeater relationship menyuntikkan key "record-{id}" ke
                                                // state item — itu bukan array path FileUpload.
                                                if (is_array($state)) {
                                                    $path = collect($state)
                                                        ->except('id')
                                                        ->first(fn ($v, $k) => ! str_starts_with((string) $k, 'record-'));

                                                    return filled($path) ? $path : null;
                                                }

                                                return $state;
                                            })
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                                        TextInput::make('caption')
                                            ->label('Keterangan')
                                            ->maxLength(255),
                                        Toggle::make('is_active')
                                            ->label('Tampil di beranda')
                                            ->default(true),
                                    ])
                                    ->helperText('Foto ini yang muncul di carousel beranda Anda. Kalau semuanya dimatikan, pengunjung melihat frame kosong.'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data')
            ->model($this->getSales());
    }

    public function save(): void
    {
        $sales = $this->getSales();

        if (! $sales) {
            Notification::make()
                ->title('Tidak dapat menyimpan')
                ->body('Belum ada data sales untuk akun ini. Hubungi admin.')
                ->danger()
                ->send();

            return;
        }

        $state = $this->form->getState();

        $sales->update(
            collect($state)
                ->only(['name', 'title', 'bio', 'photo_path', 'whatsapp', 'phone', 'email'])
                ->toArray()
        );

        // Repeater galeris memakai ->relationship(): sinkronisasi
        // tambah/ubah/hapus/urut diurus Filament di sini (baris baru otomatis
        // mendapat sales_id dari relasi).
        $this->form->saveRelationships();

        Notification::make()
            ->title('Profil berhasil disimpan')
            ->success()
            ->send();
    }

    private function getSales(): ?Sales
    {
        return Sales::query()->where('user_id', auth()->id())->first();
    }
}
