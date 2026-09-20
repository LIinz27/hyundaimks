<?php

use App\Models\Sales;

if (! function_exists('active_sales')) {
    /**
     * The currently resolved Sales context, or null when there is none
     * (e.g. admin panel, console, error pages).
     */
    function active_sales(): ?Sales
    {
        return app()->bound('active.sales') ? app('active.sales') : null;
    }
}

if (! function_exists('sales_route')) {
    /**
     * Build a URL to a named route while preserving the active sales context.
     *
     * - Source 'query'  -> append ?s=<slug> (unless already given in $params).
     * - Source 'account' -> no ?s= needed; context is implicit from the login.
     * - No context at all -> plain route(), never errors.
     */
    function sales_route(string $name, array $params = []): string
    {
        if (app()->bound('active.sales.source') && app('active.sales.source') === 'query' && ! array_key_exists('s', $params)) {
            $sales = active_sales();
            if ($sales) {
                $params['s'] = $sales->slug;
            }
        }

        return route($name, $params);
    }
}

if (! function_exists('sales_url')) {
    /**
     * Build a URL from an internal path while preserving the active sales
     * context (?s=<slug>). Use for internal routes without a name
     * (e.g. /product/*).
     */
    function sales_url(string $path): string
    {
        $url = url($path);

        if (app()->bound('active.sales.source') && app('active.sales.source') === 'query') {
            $sales = active_sales();
            if ($sales) {
                $url .= (str_contains($url, '?') ? '&' : '?').'s='.$sales->slug;
            }
        }

        return $url;
    }
}
