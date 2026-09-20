<?php

namespace App\Http\Controllers;

class HomeController
{
    public function index()
    {
        $sales = app('active.sales'); // dari middleware G0

        $documents = $sales->documents()
            ->orderBy('sort_order')
            ->latest()
            ->limit(config('site.homepage_gallery_limit', 6))
            ->get();

        return view('homepage/home', compact('sales', 'documents'));
    }
}
