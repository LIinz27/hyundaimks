<?php

namespace App\Http\Controllers;

use App\Models\Sales;

class SalesPageController
{
    public function show(string $slug)
    {
        $sales = Sales::active()
            ->where('slug', $slug)
            ->with(['documents' => fn ($q) => $q->orderBy('sort_order')])
            ->firstOrFail();

        return view('sales.show', compact('sales'));
    }
}
