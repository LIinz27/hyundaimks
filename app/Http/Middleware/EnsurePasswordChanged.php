<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Paksa user yang password_changed_at-nya masih NULL (masih memakai
 * password default seeder) untuk mengganti password sebelum bisa
 * mengakses halaman lain di panel admin.
 *
 * Halaman ganti password dan logout dikecualikan supaya tidak terjadi
 * redirect loop dan user tetap bisa keluar.
 */
class EnsurePasswordChanged
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && is_null($user->password_changed_at)) {
            if ($request->routeIs(
                'filament.admin.pages.change-password',
                'filament.admin.auth.logout',
            )) {
                return $next($request);
            }

            return redirect()->route('filament.admin.pages.change-password');
        }

        return $next($request);
    }
}
