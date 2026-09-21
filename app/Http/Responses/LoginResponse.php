<?php

namespace App\Http\Responses;

use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

/**
 * Respons setelah login sukses.
 *
 * Halaman login gabungan /login menentukan panel tujuan dari tab aktif
 * (UnifiedLogin::targetPanel()). Tanpa ini Filament memakai panel default
 * (admin) sehingga sales bisa diarahkan ke /admin lalu mental.
 *
 * Untuk login dari halaman panel biasa (/sales/login) current panel sudah
 * terpasang oleh middleware SetUpPanel, jadi perilaku lama dipertahankan.
 */
class LoginResponse implements \Filament\Auth\Http\Responses\Contracts\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        $panel = null;

        if ($request->routeIs('login') && ($livewire = $request->input('components.0.snapshot')) !== null) {
            $snapshot = json_decode($livewire, true);
            $tab = data_get($snapshot, 'data.tab');

            if (in_array($tab, ['admin', 'sales'], true)) {
                $panel = Filament::getPanel($tab);
            }
        }

        $panel ??= Filament::getCurrentOrDefaultPanel();

        return redirect()->intended($panel->getUrl());
    }
}
