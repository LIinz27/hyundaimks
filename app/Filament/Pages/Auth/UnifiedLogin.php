<?php

namespace App\Filament\Pages\Auth;

use App\Filament\Pages\Auth\Concerns\AuthenticatesWithUsername;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Facades\Filament;
use Filament\Schemas\Components\Html;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\ValidationException;

/**
 * Halaman login gabungan /login dengan dua tab: Admin dan Sales.
 *
 * Tab aktif disimpan di query string (?tab=admin|sales) sehingga bisa
 * di-bookmark dan tidak hilang ketika validasi gagal (Livewire [Url]).
 *
 * Aturan peran diberlakukan di sini — BUKAN di canAccessPanel(), karena
 * canAccessPanel(null current panel) sengaja mengizinkan semua peran
 * (dipakai agar route /login ini tidak mengikat konteks panel mana pun).
 *
 * /login/admin dan /login/sales lama me-redirect ke halaman ini.
 */
class UnifiedLogin extends \Filament\Auth\Pages\Login
{
    use AuthenticatesWithUsername;

    #[\Livewire\Attributes\Url]
    public string $tab = 'admin';

    public function mount(): void
    {
        $this->tab = request()->query('tab') === 'sales' ? 'sales' : 'admin';

        parent::mount();
    }

    public function getHeading(): Htmlable|string|null
    {
        return 'Masuk';
    }

    public function getSubheading(): Htmlable|string|null
    {
        return 'Pilih tab sesuai jenis akun Anda.';
    }

    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Medium;
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Html::make(new HtmlString(
                view('filament.auth.login-tabs', ['tab' => $this->tab])->render()
            ))->columnSpanFull(),
            $this->getFormContentComponent(),
        ]);
    }

    public function authenticate(): ?LoginResponse
    {
        // Ambil kredensial lebih dulu agar pemeriksaan peran tetap di dalam
        // jalur validasi yang sama (pesan salah kredensial tetap generik).
        $data = $this->form->getState();

        /** @var \App\Models\User|null $user */
        $user = \App\Models\User::query()
            ->where('username', $data['username'] ?? null)
            ->first();

        if ($user) {
            if ($this->tab === 'admin' && $user->role !== 'admin') {
                throw ValidationException::withMessages([
                    'data.username' => 'Akun ini bukan akun admin.',
                ]);
            }

            if ($this->tab === 'sales' && $user->role !== 'sales') {
                throw ValidationException::withMessages([
                    'data.username' => 'Akun ini bukan akun sales.',
                ]);
            }
        }

        return parent::authenticate();
    }

    /**
     * Panel tujuan sesuai tab aktif. canAccessPanel() tanpa konteks panel
     * mengizinkan semua peran, jadi untuk /login kita tentukan panel tujuan
     * dari tab — bukan dari current panel (tidak ada) atau default (admin).
     */
    public function targetPanel(): \Filament\Panel
    {
        return Filament::getPanel($this->tab === 'sales' ? 'sales' : 'admin');
    }

    protected function isUserAllowedToAccessPanel(\Illuminate\Contracts\Auth\Authenticatable $user): bool
    {
        return $user->canAccessPanel($this->targetPanel());
    }
}
