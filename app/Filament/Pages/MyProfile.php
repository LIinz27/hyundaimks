<?php

namespace App\Filament\Pages;

use App\Models\Sales;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
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

        $this->form->fill($sales?->only([
            'name', 'title', 'bio', 'photo_path', 'whatsapp', 'phone', 'email',
        ]) ?? []);
    }

    public static function canAccess(): bool
    {
        return auth()->check();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('title')->maxLength(255),
                Textarea::make('bio')->rows(4),
                FileUpload::make('photo_path')
                    ->image()
                    ->disk('public')
                    ->directory('sales/photos')
                    ->maxSize(4096)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                TextInput::make('whatsapp')->maxLength(50),
                TextInput::make('phone')->maxLength(50),
                TextInput::make('email')->email()->maxLength(255),
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

        $data = collect($this->form->getState())
            ->only(['name', 'title', 'bio', 'photo_path', 'whatsapp', 'phone', 'email'])
            ->toArray();

        $sales->update($data);

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
