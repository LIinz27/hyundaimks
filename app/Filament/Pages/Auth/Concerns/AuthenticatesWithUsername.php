<?php

namespace App\Filament\Pages\Auth\Concerns;

use Filament\Forms\Components\TextInput;
use Illuminate\Validation\ValidationException;

/**
 * Mengganti login bawaan Filament (email + password) menjadi
 * username + password. Dipakai oleh AdminLogin dan SalesLogin.
 */
trait AuthenticatesWithUsername
{
    protected function getEmailFormComponent(): \Filament\Schemas\Components\Component
    {
        return TextInput::make('username')
            ->label('Username')
            ->required()
            ->autocomplete('username')
            ->autofocus();
    }

    protected function getCredentialsFromFormData(#[\SensitiveParameter] array $data): array
    {
        return [
            'username' => $data['username'],
            'password' => $data['password'],
        ];
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.username' => __('filament-panels::auth/pages/login.messages.failed'),
        ]);
    }

}
