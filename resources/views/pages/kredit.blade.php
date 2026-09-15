@extends('layouts.app')

@section('title', 'Proses Kredit - Dealer Hyundai Makassar')

@section('content')
    <div class="page-hero">
        <img src="{{ asset('images/photo_2023-06-06_20-05-30.jpg') }}" alt="Syarat Kredit" class="page-hero-image">
        <div class="page-hero-overlay"></div>
        <h1 class="page-hero-title">Syarat Kredit</h1>
    </div>

    <div class="container mt-4">
        <h2 class="fw-bold text-start">Berikut adalah syarat-syarat pengajuan kredit Mobil melalui kami.</h2>

        <div class="row mt-4 g-4 align-items-stretch">
            <div class="col-md-6 d-flex">
                <div class="info-card">
                    <h4 class="info-card-title">Kredit Perorangan</h4>
                    <ol class="list-unstyled info-list">
                        <li>1. KTP</li>
                        <li>2. KK</li>
                        <li>3. NPWP</li>
                        <li>4. PBB rumah / AJB</li>
                        <li>5. Slip gaji/siup/SURAT KETERANGAN USAHA</li>
                        <li>6. Cover Tabungan</li>
                        <li>7. REKENING KORAN 3 bulan terakhir</li>
                    </ol>
                </div>
            </div>

            <div class="col-md-6 d-flex">
                <div class="info-card">
                    <h4 class="info-card-title">Kredit Perusahaan</h4>
                    <ol class="list-unstyled info-list">
                        <li>1. SIUP, TDP dan domisili (atau penggantinya adalah NIB, Izin Usaha dan Izin Lokasi)</li>
                        <li>2. NPWP</li>
                        <li>3. Akta Pendirian perusahaan dan perubahannya (soft copy boleh format PDF)</li>
                        <li>4. Surat kuasa 2 lembar di kop surat. Di TTD dan stempel basah (format surat kuasa dikirim via WA)</li>
                    </ol>
                    <p class="fw-bold mt-3 mb-3 info-note-title">Note:</p>
                    <ul class="info-list info-list-nested">
                        <li>Untuk point 1 dan 2 (dibuat rangkap 3 lembar dan distempel basah)</li>
                        <li>Untuk kop surat, jika tertera alamat, maka sesuai dengan domisili/ NIB.</li>
                    </ul>
                </div>
            </div>
        </div>

        <h2 class="fw-bold text-start mt-5 mb-5">Berikut adalah proses kredit Mobil melalui kami:</h2>
        <ol class="list-unstyled info-list">
            <li>1. Anda menghubungi sales kami atau sales kami menghubungi anda melalui nomor telp yang anda berikan.</li>
            <li>2. Kami akan mengkonfirmasi mobil pilihan anda, DP dan angsuran yang anda mau.</li>
            <li>3. Kami akan mengkonfirmasi waktu dan tempat untuk pelaksanaan survey dari pihak leasing.</li>
            <li>4. Surveyor kredit dari pihak leasing akan mendatangi anda untuk proses survey.</li>
            <li>5. Pada saat anda disurvey, anda akan mengisi berkas kredit. Di sini juga adalah kesempatan anda bertanya cara pembayaran angsuran. Tidak ada pembayaran apapun saat survey.</li>
            <li>6. Surveyor akan memberi kami hasil survey dalam jangka waktu 1-2 hari setelah survey.</li>
            <li>Apabila alamat anda tinggal sekarang berbeda dengan alamat anda di KTP (contoh: kontrak) maka survey akan dilakukan di alamat anda sekarang.</li>
        </ol>

        <button class="btn btn-brand d-flex align-items-center page-cta">
            <i class="bi bi-whatsapp me-2"></i> Konsultasi via WhatsApp
        </button>
    </div>
@endsection
