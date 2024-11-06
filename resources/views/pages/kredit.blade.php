@section('title', 'Proses Kredit - Dealer Hyundai Makassar')
@include('header')

<div class="position-relative">
    <img src="{{ asset('images/photo_2023-06-06_20-05-30.jpg') }}" alt="Syarat Kredit" class="img-fluid w-100" style="height: 230px; object-fit: cover;">
    
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(28, 70, 130, 0.6);"></div>
    
    <h1 class="position-absolute top-50 text-white fw-bold" style="left: 10%; transform: translateY(-50%);">Syarat Kredit</h1>
</div>

<div class="container mt-4">
    <h2 class="fw-bold text-start">Berikut adalah syarat-syarat pengajuan kredit Mobil melalui kami.</h2>

    <div class="row mt-4 d-flex align-items-stretch">
        <div class="col-md-6 d-flex">
            <div class="p-3 rounded shadow-sm bg-white w-100" style="border: 1px solid #ddd;">
                <h4 class="fw-bold text-start" style="font-size: 1.25rem;">Kredit Perorangan</h4>
                <ol class="list-unstyled mt-2 text-start ps-4" style="text-indent: 1em; font-size: 1.1rem; line-height: 2.2;">
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
            <div class="p-3 rounded shadow-sm bg-white w-100" style="border: 1px solid #ddd;">
                <h4 class="fw-bold text-start" style="font-size: 1.25rem;">Kredit Perusahaan</h4>
                <ol class="list-unstyled mt-2 text-start ps-4" style="text-indent: 1em; font-size: 1.1rem; line-height: 2;">
                    <li>1. SIUP, TDP dan domisili (atau penggantinya adalah NIB, Izin Usaha dan Izin Lokasi)</li>
                    <li>2. NPWP</li>
                    <li>3. Akta Pendirian perusahaan dan perubahannya (soft copy boleh format PDF)</li>
                    <li>4. Surat kuasa 2 lembar di kop surat. Di TTD dan stempel basah (format surat kuasa dikirim via WA)</li>
                </ol>
                <p class="fw-bold mt-3 mb-3" style="font-size: 1.0rem;">Note:</p>
                <ul class="ps-4" style="text-indent: 2em; font-size: 1.0rem; line-height: 2;">
                    <li>Untuk point 1 dan 2 (dibuat rangkap 3 lembar dan distempel basah)</li>
                    <li>Untuk kop surat, jika tertera alamat, maka sesuai dengan domisili/ NIB.</li>
                </ul>
            </div>
        </div>
    </div> 

    <h2 class="fw-bold text-start mt-5 mb-5 ">Berikut adalah proses kredit Mobil melalui kami:</h2>
    <ol class="list-unstyled mt-2 text-start ps-4" style="text-indent: 1em; font-size: 1.1rem; line-height: 2;">
        <li>1. Anda menghubungi sales kami atau sales kami menghubungi anda melalui nomor telp yang anda berikan.</li>
        <li>2. Kami akan mengkonfirmasi mobil pilihan anda, DP dan angsuran yang anda mau.</li>
        <li>3. Kami akan mengkonfirmasi waktu dan tempat untuk pelaksanaan survey dari pihak leasing.</li>
        <li>4. Surveyor kredit dari pihak leasing akan mendatangi anda untuk proses survey.</li>
        <li>5. Pada saat anda disurvey, anda akan mengisi berkas kredit. Di sini juga adalah kesempatan anda bertanya cara pembayaran angsuran. Tidak ada pembayaran apapun saat survey.</li>
        <li>6. Surveyor akan memberi kami hasil survey dalam jangka waktu 1-2 hari setelah survey.</li>
        <li>Apabila alamat anda tinggal sekarang berbeda dengan alamat anda di KTP (contoh: kontrak) maka survey akan dilakukan di alamat anda sekarang.</li>
    </ol>

    <button class="btn text-white d-flex align-items-center" style="background-color: #1c4682; border: none; padding: 0.5em 1em; font-size: 1.1rem; margin-bottom:5%">
        <i class="bi bi-whatsapp me-2"></i> Konsultasi via WhatsApp
    </button>
</div>

@include('footer')
