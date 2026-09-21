<?php

namespace App\Filament\Pages\Auth;

use App\Filament\Pages\Auth\Concerns\AuthenticatesWithUsername;
use Filament\Auth\Pages\Login;

class AdminLogin extends Login
{
    use AuthenticatesWithUsername;

    public function getHeading(): \Illuminate\Contracts\Support\Htmlable|string|null
    {
        return 'Login Admin';
    }
}
