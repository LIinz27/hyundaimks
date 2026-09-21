<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login;

class AdminLogin extends Login
{
    public function getHeading(): \Illuminate\Contracts\Support\Htmlable|string|null
    {
        return 'Login Admin';
    }
}
