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
use App\Models\SiteSetting;
use App\Models\TestDrive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends \Illuminate\Routing\Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['loginForm', 'login']);
    }

    // ─── Auth ────────────────────────────────────────────────

    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    // ─── Dashboard ───────────────────────────────────────────

    public function dashboard()
    {
        $stats = [
            'test_drive'  => TestDrive::count(),
            'simulasi'    => SimulasiKredit::count(),
            'kontak'      => Kontak::count(),
            'promo'       => Promo::count(),
            'galeri'      => Galeri::count(),
        ];

        $latestTestDrives  = TestDrive::latest()->take(5)->get();
        $latestKontaks     = Kontak::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestTestDrives', 'latestKontaks'));
    }

    // ─── Test Drive ──────────────────────────────────────────

    public function testDriveIndex(Request $request)
    {
        $query = TestDrive::latest();
        if ($request->filled('search')) {
            $q = $request->search;
            $query->where('nama', 'like', "%{$q}%")
                  ->orWhere('telepon', 'like', "%{$q}%")
                  ->orWhere('tipe_mobil', 'like', "%{$q}%");
        }
        $testDrives = $query->paginate(15)->withQueryString();
        return view('admin.test-drives', compact('testDrives'));
    }

    public function testDriveDestroy(TestDrive $testDrive)
    {
        $testDrive->delete();
        return redirect()->route('admin.test-drives.index')->with('success', 'Data test drive berhasil dihapus.');
    }

    // ─── Simulasi Kredit ─────────────────────────────────────

    public function simulasiIndex(Request $request)
    {
        $query = SimulasiKredit::latest();
        if ($request->filled('search')) {
            $q = $request->search;
            $query->where('nama', 'like', "%{$q}%")
                  ->orWhere('telepon', 'like', "%{$q}%")
                  ->orWhere('tipe_mobil', 'like', "%{$q}%");
        }
        $simulasis = $query->paginate(15)->withQueryString();
        return view('admin.simulasi', compact('simulasis'));
    }

    public function simulasiDestroy(SimulasiKredit $simulasiKredit)
    {
        $simulasiKredit->delete();
        return redirect()->route('admin.simulasi.index')->with('success', 'Data simulasi kredit berhasil dihapus.');
    }

    // ─── Kontak ──────────────────────────────────────────────

    public function kontakIndex(Request $request)
    {
        $query = Kontak::latest();
        if ($request->filled('search')) {
            $q = $request->search;
            $query->where('nama', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%")
                  ->orWhere('telepon', 'like', "%{$q}%");
        }
        $kontaks = $query->paginate(15)->withQueryString();
        return view('admin.kontak', compact('kontaks'));
    }

    public function kontakDestroy(Kontak $kontak)
    {
        $kontak->delete();
        return redirect()->route('admin.kontak.index')->with('success', 'Pesan berhasil dihapus.');
    }

    // ─── Promo ───────────────────────────────────────────────

    public function promoIndex()
    {
        $promos = Promo::latest()->get();
        return view('admin.promo', compact('promos'));
    }

    public function promoStore(Request $request)
    {
        $request->validate([
            'gambar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'judul'  => ['nullable', 'string', 'max:255'],
        ]);

        $file     = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/Promo'), $filename);

        Promo::create(['filename' => $filename, 'judul' => $request->judul]);

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil ditambahkan.');
    }

    public function promoDestroy(Promo $promo)
    {
        $path = public_path('images/Promo/' . $promo->filename);
        if (file_exists($path)) {
            unlink($path);
        }
        $promo->delete();
        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil dihapus.');
    }

    // ─── Pricelist ───────────────────────────────────────────

    public function pricelistIndex()
    {
        $pricelists = Pricelist::latest()->get();
        return view('admin.pricelist', compact('pricelists'));
    }

    public function pricelistStore(Request $request)
    {
        $request->validate([
            'gambar' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:20480'],
        ]);

        $file     = $request->file('gambar');
        $filename = 'pricelist_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/pricelist'), $filename);

        Pricelist::create(['filename' => $filename]);

        return redirect()->route('admin.pricelist.index')->with('success', 'Pricelist berhasil diunggah.');
    }

    public function pricelistDestroy(Pricelist $pricelist)
    {
        $path = public_path('images/pricelist/' . $pricelist->filename);
        if (file_exists($path)) {
            unlink($path);
        }
        $pricelist->delete();
        return redirect()->route('admin.pricelist.index')->with('success', 'Pricelist berhasil dihapus.');
    }

    // ─── Galeri ──────────────────────────────────────────────

    public function galeriIndex()
    {
        $galeris = Galeri::orderBy('urutan')->get();
        return view('admin.galeri', compact('galeris'));
    }

    public function galeriStore(Request $request)
    {
        $request->validate([
            'gambar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'judul'  => ['nullable', 'string', 'max:255'],
        ]);

        $file     = $request->file('gambar');
        $filename = 'galeri_' . time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/Galeri'), $filename);

        Galeri::create(['filename' => $filename, 'judul' => $request->judul]);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function galeriUpdateUrutan(Request $request)
    {
        $request->validate([
            'urutan'   => ['required', 'array'],
            'urutan.*' => ['integer', 'min:1'],
        ]);

        foreach ($request->urutan as $id => $urutan) {
            Galeri::where('id', $id)->update(['urutan' => $urutan]);
        }

        return redirect()->route('admin.galeri.index')->with('success', 'Urutan galeri berhasil disimpan.');
    }

    public function galeriDestroy(Galeri $galeri)
    {
        $path = public_path('images/Galeri/' . $galeri->filename);
        if (file_exists($path)) {
            unlink($path);
        }
        $galeri->delete();
        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil dihapus.');
    }

    // ─── Mobil ───────────────────────────────────────────────

    public function mobilIndex()
    {
        $mobils = Mobil::orderBy('urutan')->get();
        return view('admin.mobil', compact('mobils'));
    }

    public function mobilStore(Request $request)
    {
        $request->validate([
            'nama'     => ['required', 'string', 'max:100'],
            'harga'    => ['required', 'string', 'max:50'],
            'kategori' => ['required', 'in:mpv,suv,eco'],
            'url'      => ['required', 'string', 'max:100'],
            'gambar'   => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $file     = $request->file('gambar');
        $filename = $file->getClientOriginalName();
        $file->move(public_path('images/car'), $filename);

        Mobil::create([
            'nama'     => $request->nama,
            'harga'    => $request->harga,
            'gambar'   => $filename,
            'kategori' => $request->kategori,
            'url'      => $request->url,
            'urutan'   => (Mobil::max('urutan') ?? 0) + 1,
            'aktif'    => true,
        ]);

        return redirect()->route('admin.mobil.index')->with('success', 'Mobil berhasil ditambahkan.');
    }

    public function mobilUpdate(Request $request, Mobil $mobil)
    {
        $request->validate([
            'nama'     => ['required', 'string', 'max:100'],
            'harga'    => ['required', 'string', 'max:50'],
            'kategori' => ['required', 'in:mpv,suv,eco'],
            'url'      => ['required', 'string', 'max:100'],
            'urutan'   => ['required', 'integer', 'min:1'],
            'gambar'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $data = $request->only('nama', 'harga', 'kategori', 'url', 'urutan');
        $data['aktif'] = $request->has('aktif');

        if ($request->hasFile('gambar')) {
            $file     = $request->file('gambar');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/car'), $filename);
            $data['gambar'] = $filename;
        }

        $mobil->update($data);
        return redirect()->route('admin.mobil.index')->with('success', 'Data mobil berhasil diperbarui.');
    }

    public function mobilDestroy(Mobil $mobil)
    {
        $mobil->delete();
        return redirect()->route('admin.mobil.index')->with('success', 'Mobil berhasil dihapus dari daftar homepage.');
    }

    // ─── Banner ──────────────────────────────────────────────

    public function bannerIndex()
    {
        $banners = Banner::latest()->get();
        return view('admin.banner', compact('banners'));
    }

    public function bannerStore(Request $request)
    {
        $request->validate([
            'gambar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
            'judul'  => ['nullable', 'string', 'max:255'],
        ]);

        $file     = $request->file('gambar');
        $filename = 'banner_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/banners'), $filename);

        $banner = Banner::create([
            'filename' => 'images/banners/' . $filename,
            'judul'    => $request->judul,
            'aktif'    => false,
        ]);

        if (Banner::where('aktif', true)->doesntExist()) {
            $banner->update(['aktif' => true]);
        }

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil diunggah.');
    }

    public function bannerSetActive(Banner $banner)
    {
        Banner::where('aktif', true)->update(['aktif' => false]);
        $banner->update(['aktif' => true]);
        return redirect()->route('admin.banner.index')->with('success', 'Banner aktif berhasil diubah.');
    }

    public function bannerDestroy(Banner $banner)
    {
        $path = public_path($banner->filename);
        if (file_exists($path) && str_contains($banner->filename, 'banners/')) {
            unlink($path);
        }
        if ($banner->aktif) {
            Banner::where('id', '!=', $banner->id)->latest()->first()?->update(['aktif' => true]);
        }
        $banner->delete();
        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil dihapus.');
    }

    // ─── Sales Profile ───────────────────────────────────────

    public function salesIndex()
    {
        $profile = SalesProfile::first();
        return view('admin.sales', compact('profile'));
    }

    public function salesUpdate(Request $request)
    {
        $request->validate([
            'nama'       => ['required', 'string', 'max:100'],
            'jabatan'    => ['required', 'string', 'max:100'],
            'telepon'    => ['required', 'string', 'max:20'],
            'whatsapp'   => ['required', 'string', 'max:20'],
            'keunggulan' => ['required', 'string'],
            'foto'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $profile = SalesProfile::first() ?? new SalesProfile();

        $data = $request->only('nama', 'jabatan', 'telepon', 'whatsapp');
        $data['keunggulan'] = array_values(array_filter(array_map('trim', explode("\n", $request->keunggulan))));

        if ($request->hasFile('foto')) {
            $file     = $request->file('foto');
            $filename = 'sales_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['foto'] = $filename;
        }

        $profile->fill($data)->save();
        return redirect()->route('admin.sales.index')->with('success', 'Profil sales berhasil diperbarui.');
    }

    // ─── Site Settings ───────────────────────────────────────

    public function settingsIndex()
    {
        $settings = SiteSetting::allSettings();
        return view('admin.pengaturan', compact('settings'));
    }

    public function settingsUpdate(Request $request)
    {
        $request->validate([
            'judul_promo' => ['required', 'string', 'max:100'],
            'whatsapp'    => ['required', 'string', 'max:20'],
            'telepon'     => ['required', 'string', 'max:20'],
            'email'       => ['required', 'email', 'max:100'],
            'alamat'      => ['required', 'string'],
        ]);

        foreach (['judul_promo', 'whatsapp', 'telepon', 'email', 'alamat'] as $key) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $request->input($key)]);
        }

        return redirect()->route('admin.pengaturan.index')->with('success', 'Pengaturan berhasil disimpan.');
    }

    // ─── Partner Finance ─────────────────────────────────────

    public function partnerIndex()
    {
        $partners = Partner::orderBy('urutan')->get();
        return view('admin.partner', compact('partners'));
    }

    public function partnerStore(Request $request)
    {
        $request->validate([
            'logo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'nama' => ['required', 'string', 'max:100'],
        ]);

        $file     = $request->file('logo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/finance'), $filename);

        Partner::create([
            'nama'     => $request->nama,
            'filename' => $filename,
            'urutan'   => (Partner::max('urutan') ?? 0) + 1,
        ]);

        return redirect()->route('admin.partner.index')->with('success', 'Partner berhasil ditambahkan.');
    }

    public function partnerUpdateUrutan(Request $request)
    {
        $request->validate([
            'urutan'   => ['required', 'array'],
            'urutan.*' => ['integer', 'min:1'],
        ]);

        foreach ($request->urutan as $id => $urutan) {
            Partner::where('id', $id)->update(['urutan' => $urutan]);
        }

        return redirect()->route('admin.partner.index')->with('success', 'Urutan partner berhasil disimpan.');
    }

    public function partnerDestroy(Partner $partner)
    {
        $path = public_path('images/finance/' . $partner->filename);
        if (file_exists($path) && str_contains($partner->filename, '_')) {
            unlink($path);
        }
        $partner->delete();
        return redirect()->route('admin.partner.index')->with('success', 'Partner berhasil dihapus.');
    }
}
