<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

/**
 * Halaman wajib ganti password. Middleware EnsurePasswordChanged
 * mengarahkan user ke sini selama password_changed_at masih NULL
 * (password default seeder). Setelah berhasil, kolom itu diisi now().
 */
class ChangePassword extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-key';

    protected static ?string $navigationLabel = 'Ganti Password';

    protected static ?string $title = 'Ganti Password';

    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'filament.pages.change-password';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public static function canAccess(): bool
    {
        return auth()->check();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('password')
                    ->label('Password Baru')
                    ->password()
                    ->revealable()
                    ->required()
                    ->minLength(8)
                    // Jangan boleh tetap memakai password default seeder.
                    ->notIn(['password'])
                    ->confirmed(),
                TextInput::make('password_confirmation')
                    ->label('Ulangi Password Baru')
                    ->password()
                    ->revealable()
                    ->required()
                    ->dehydrated(false),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        $user = auth()->user();
        $user->forceFill([
            'password' => Hash::make($state['password']),
            'password_changed_at' => now(),
        ])->save();

        Notification::make()
            ->title('Password berhasil diganti')
            ->success()
            ->send();

        $this->redirect('/admin');
    }
}
