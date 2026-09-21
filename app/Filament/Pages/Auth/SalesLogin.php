<?php

namespace App\Filament\Pages\Auth;

use App\Filament\Pages\Auth\Concerns\AuthenticatesWithUsername;
use Filament\Auth\Pages\Login;

class SalesLogin extends Login
{
    use AuthenticatesWithUsername;

    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'username' => '',
            'password' => '',
            'remember' => false,
        ]);

        // Semua login lewat satu halaman /login bertab. /sales/login (dan
        // redirect otentikasi dari /sales) dialihkan ke tab sales.
        if (! app()->runningUnitTests()) {
            $this->redirect('/login?tab=sales');
        }
    }

    public function getHeading(): \Illuminate\Contracts\Support\Htmlable|string|null
    {
        return 'Login Sales';
    }
}
