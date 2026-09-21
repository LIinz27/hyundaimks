<?php

namespace App\Http\Controllers;

class HomeController
{
    public function index()
    {
        $sales = app('active.sales'); // dari middleware G0

        // Galeri kini milik tiap sales: yang dirender hanya galeri milik sales
        // yang sedang dilihat (?s=slug), bukan lagi galeri bersama dealer.
        // Tetap hanya yang aktif dan diurutkan sort_order.
        $galeris = $sales
            ? $sales->galeris()->where('is_active', true)->orderBy('id')->get()
            : collect();

        return view('homepage/home', compact('sales', 'galeris'));
    }
}
