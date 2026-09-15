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
        return $this->car('stargazer');
    }

    public function hyundai_creta()
    {
        return $this->car('creta');
    }

    public function hyundai_stargazer_x()
    {
        return $this->car('stargazer-x');
    }

    public function hyundai_kona()
    {
        return $this->car('hyundai-kona');
    }

    public function hyundai_santa_fe()
    {
        return $this->car('santa-fe');
    }

    public function hyundai_staria()
    {
        return $this->car('staria');
    }

    public function hyundai_ioniq_5()
    {
        return $this->car('ioniq-5');
    }

    public function hyundai_palisade()
    {
        return $this->car('palisade');
    }

    public function hyundai_ioniq_6()
    {
        return $this->car('ioniq-6');
    }

    public function hyundai_all_new_santa_fe()
    {
        return $this->car('all-new-santa-fe');
    }

    protected function car(string $slug)
    {
        return view('product.show', ['car' => config('cars.cars.' . $slug)]);
    }
}
