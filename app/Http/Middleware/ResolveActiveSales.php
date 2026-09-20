<?php

namespace App\Http\Middleware;

use App\Models\Sales;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ResolveActiveSales
{
    /**
     * Resolve which Sales context is active for public pages.
     *
     * 1. Logged-in user with a Sales relation -> use their own Sales
     *    (the ?s= parameter is ignored even when present).
     * 2. Otherwise, when ?s=<slug> is present -> find an active Sales by slug.
     * 3. Neither -> 404.  Slug not found / inactive -> 404.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sales = null;
        $source = null;

        $user = $request->user();
        if ($user && $user->sales && $user->sales->is_active) {
            $sales = $user->sales;
            $source = 'account';
        } elseif ($slug = $request->query('s')) {
            $sales = Sales::active()->where('slug', $slug)->first();
            if ($sales) {
                $source = 'query';
            }
        }

        if (! $sales) {
            abort(404);
        }

        app()->instance('active.sales', $sales);
        app()->instance('active.sales.source', $source);
        View::share('activeSales', $sales);
        View::share('activeSalesSource', $source);

        return $next($request);
    }
}
