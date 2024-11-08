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
    public function hyundai_stargazer()
    {
        return view('product/stargazer');
    }
    
    public function hyundai_creta()
    {
        return view('product/creta');
    }
    
    public function hyundai_stargazer_x()
    {
        return view('product/stargazer-x');
    }
    
    public function hyundai_kona()
    {
        return view('product/hyundai-kona');
    }
    
    public function hyundai_santa_fe()
    {
        return view('product/santa-fe');
    }
    
    public function hyundai_staria()
    {
        return view('product/staria');
    }
    
    public function hyundai_ioniq_5()
    {
        return view('product/ioniq-5');
    }
    
    public function hyundai_palisade()
    {
        return view('product/palisade');
    }
    
    public function hyundai_ioniq_6()
    {
        return view('product/ioniq-6');
    }
    
    public function hyundai_all_new_santa_fe()
    {
        return view('product/all-new-santa-fe');
    }    
}
