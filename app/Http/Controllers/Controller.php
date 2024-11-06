<?php

namespace App\Http\Controllers;

class Controller
{
    public function pricelist()
    {
        return view('pages/pricelist');
    }
    public function kredit()
    {
        return view('pages/kredit');
    }
    public function simulasi()
    {
        return view('pages/simulasi');
    }
    public function tesdrive()
    {
        return view('pages/tes-drive');
    }
    public function portofolio()
    {
        return view('pages/portofolio');
    }
    public function kontak()
    {
        return view('pages/kontak');
    }
}
