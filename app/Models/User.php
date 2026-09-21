<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'password_changed_at',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password_changed_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sales(): HasOne
    {
        return $this->hasOne(Sales::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Batasi akses panel per role:
     * - admin hanya panel "admin", sales hanya panel "sales".
     * - Role tidak dikenal ditolak dari semua panel.
     * Middleware Authenticate Filament akan mengarahkan user yang tertolak
     * ke panel default (/admin) lewat /login/admin — bukan redirect loop
     * karena targetnya halaman login, bukan panel yang menolaknya.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Tanpa konteks panel aktif (unit-test Livewire standalone),
        // Filament memberi panel fallback — jangan blokir di situasi itu.
        if (is_null(\Filament\Facades\Filament::getCurrentPanel())) {
            return true;
        }

        return match ($this->role) {
            'admin' => $panel->getId() === 'admin',
            'sales' => $panel->getId() === 'sales',
            default => false,
        };
    }
}
