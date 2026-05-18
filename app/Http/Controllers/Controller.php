<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Galeri;
use App\Models\Kontak;
use App\Models\Mobil;
use App\Models\Partner;
use App\Models\Pricelist;
use App\Models\Promo;
use App\Models\SalesProfile;
use App\Models\SimulasiKredit;
use App\Models\TestDrive;
use Illuminate\Http\Request;

class Controller
{
    public function home()
    {
        $galeriImages = Galeri::orderBy('urutan')->get()
            ->map(fn ($g) => asset('images/Galeri/' . $g->filename))
            ->values();

        $cars = Mobil::where('aktif', true)->orderBy('urutan')->get()
            ->map(fn ($m) => [
                'name'       => $m->nama,
                'price'      => $m->harga,
                'image'      => asset('images/car/' . $m->gambar),
                'categories' => [$m->kategori],
                'url'        => $m->url,
            ])->values();

        $banner = Banner::where('aktif', true)->first();

        $salesProfile = SalesProfile::first();

        $promoImages = Promo::latest()->get()
            ->map(fn ($p) => asset('images/Promo/' . $p->filename))
            ->values();

        $partnerImages = Partner::orderBy('urutan')->get()
            ->map(fn ($p) => [
                'src'   => asset('images/finance/' . $p->filename),
                'alt'   => $p->nama,
                'class' => 'img-fluid finance-logo',
            ])->values();

        return view('homepage/home', compact(
            'galeriImages', 'cars', 'banner', 'salesProfile', 'promoImages', 'partnerImages'
        ));
    }

    public function pricelist()
    {
        $pricelist = Pricelist::latest()->first();
        return view('pages/pricelist', compact('pricelist'));
    }

    public function pricelistDownload()
    {
        $pricelist = Pricelist::latest()->first();
        if (!$pricelist) {
            return redirect('/pricelist')->with('error', 'Pricelist belum tersedia.');
        }
        $path = public_path('images' . DIRECTORY_SEPARATOR . 'pricelist' . DIRECTORY_SEPARATOR . $pricelist->filename);
        if (!file_exists($path)) {
            return redirect('/pricelist')->with('error', 'File pricelist tidak ditemukan.');
        }
        return response()->download($path, 'Pricelist-Hyundai-Makassar.' . pathinfo($path, PATHINFO_EXTENSION), [
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }
    public function kredit()
    {
        return view('pages/kredit');
    }
    public function portofolio()
    {
        $galeriImages = Galeri::orderBy('urutan')->get()
            ->map(fn ($g) => asset('images/Galeri/' . $g->filename))
            ->values();

        return view('pages/portofolio', compact('galeriImages'));
    }

    public function kontak()
    {
        return view('pages/kontak');
    }

    public function kontakStore(Request $request)
    {
        $request->validate([
            'nama'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255'],
            'telepon'  => ['required', 'string', 'max:20'],
            'pesan'    => ['required', 'string'],
        ]);

        Kontak::create($request->only('nama', 'email', 'telepon', 'pesan'));

        return back()->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
    }

    public function tesdrive()
    {
        return view('pages/tes-drive');
    }

    public function tesdriveStore(Request $request)
    {
        $request->validate([
            'nama'       => ['required', 'string', 'max:255'],
            'telepon'    => ['required', 'string', 'max:20'],
            'tanggal'    => ['required', 'date', 'after_or_equal:today'],
            'tipe_mobil' => ['required', 'string', 'max:100'],
        ]);

        TestDrive::create($request->only('nama', 'telepon', 'tanggal', 'tipe_mobil'));

        return back()->with('success', 'Booking test drive Anda berhasil! Kami akan segera menghubungi Anda.');
    }

    public function simulasi()
    {
        return view('pages/simulasi');
    }

    public function simulasiStore(Request $request)
    {
        $request->validate([
            'nama'       => ['required', 'string', 'max:255'],
            'telepon'    => ['required', 'string', 'max:20'],
            'kota'       => ['required', 'string', 'max:100'],
            'tipe_mobil' => ['required', 'string', 'max:100'],
            'tenor'      => ['required', 'integer', 'min:1', 'max:6'],
            'uang_muka'  => ['required', 'integer', 'min:0'],
        ]);

        SimulasiKredit::create($request->only('nama', 'telepon', 'kota', 'tipe_mobil', 'tenor', 'uang_muka'));

        return back()->with('success', 'Data simulasi kredit Anda berhasil dikirim! Sales kami akan menghubungi Anda segera.');
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
