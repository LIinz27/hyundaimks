<?php

namespace App\Http\Controllers;

class HomeController
{
    public function index()
    {
        $sales = app('active.sales'); // dari middleware G0

        // Beranda memuat galeri dealer dari public/images/Galeri via JS (warisan
        // desain lama). Koleksi dokumen per-sales tidak lagi dirender di sini.
        return view('homepage/home', compact('sales'));
    }
}
