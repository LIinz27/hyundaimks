<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login;

class SalesLogin extends Login
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'email' => '',
            'password' => '',
            'remember' => false,
        ]);
    }

    public function getHeading(): \Illuminate\Contracts\Support\Htmlable|string|null
    {
        return 'Login Sales';
    }
}
