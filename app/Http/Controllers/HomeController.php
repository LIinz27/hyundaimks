<?php

namespace App\Http\Controllers;

use App\Models\Galeri;

class HomeController
{
    public function index()
    {
        $sales = app('active.sales'); // dari middleware G0

        // Galeri dealer kini diambil dari database (panel admin /admin/galeris),
        // diurutkan sort_order dan hanya yang aktif yang dirender.
        $galeris = Galeri::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('homepage/home', compact('sales', 'galeris'));
    }
}
