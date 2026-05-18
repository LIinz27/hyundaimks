@extends('admin.layout')
@section('title', 'Pengaturan Kontak & Alamat')
@section('page-title', 'Pengaturan Kontak & Alamat')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-lg-7">
        <div class="bg-white rounded-3 p-4 shadow-sm">
            <h6 class="fw-bold mb-1" style="color:#1C4682;">
                <i class="bi bi-gear-fill me-2"></i>Informasi Kontak Global
            </h6>
            <p class="text-muted small mb-4">
                Data ini akan tampil di <strong>footer</strong>, tombol bubble chat, dan halaman Kontak.
            </p>

            @if (session('success'))
                <div class="alert alert-success py-2 small"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.pengaturan.update') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-semibold small">
                        <i class="bi bi-megaphone me-1"></i>Judul Seksi Promo (Homepage)
                    </label>
                    <input type="text" name="judul_promo" class="form-control"
                           value="{{ old('judul_promo', $settings['judul_promo'] ?? 'Promo Terbaru 2024') }}"
                           placeholder="Promo Terbaru 2024" required>
                    <small class="text-muted">Teks heading yang tampil di atas slider promo homepage.</small>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold small">
                        <i class="bi bi-whatsapp me-1 text-success"></i>Nomor WhatsApp
                    </label>
                    <div class="input-group">
                        <span class="input-group-text text-muted small">wa.me/62...</span>
                        <input type="text" name="whatsapp" class="form-control"
                               value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}"
                               placeholder="0896-1688-0688" required>
                    </div>
                    <small class="text-muted">Gunakan format lokal, misal: 0896-1688-0688</small>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold small">
                        <i class="bi bi-telephone me-1"></i>Nomor Telepon
                    </label>
                    <input type="text" name="telepon" class="form-control"
                           value="{{ old('telepon', $settings['telepon'] ?? '') }}"
                           placeholder="0411-123456" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold small">
                        <i class="bi bi-envelope me-1"></i>Email
                    </label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', $settings['email'] ?? '') }}"
                           placeholder="info@hyundaimks.com" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold small">
                        <i class="bi bi-geo-alt me-1"></i>Alamat Lengkap
                    </label>
                    <textarea name="alamat" class="form-control" rows="3" required
                              placeholder="Jl. A. P. Pettarani No.55, Makassar...">{{ old('alamat', $settings['alamat'] ?? '') }}</textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn text-white px-5 fw-semibold" style="background:#1C4682;">
                        <i class="bi bi-save me-2"></i>Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ── Info Panel ── --}}
    <div class="col-12 col-lg-5 mt-4 mt-lg-0">
        <div class="bg-white rounded-3 p-4 shadow-sm">
            <h6 class="fw-bold mb-3" style="color:#1C4682;">
                <i class="bi bi-info-circle me-2"></i>Data Saat Ini
            </h6>
            <ul class="list-unstyled small">
                <li class="mb-2">
                    <span class="text-muted">Judul Promo:</span><br>
                    <strong>{{ $settings['judul_promo'] ?? '-' }}</strong>
                </li>
                <li class="mb-2">
                    <span class="text-muted">WhatsApp:</span><br>
                    <strong>{{ $settings['whatsapp'] ?? '-' }}</strong>
                </li>
                <li class="mb-2">
                    <span class="text-muted">Telepon:</span><br>
                    <strong>{{ $settings['telepon'] ?? '-' }}</strong>
                </li>
                <li class="mb-2">
                    <span class="text-muted">Email:</span><br>
                    <strong>{{ $settings['email'] ?? '-' }}</strong>
                </li>
                <li class="mb-2">
                    <span class="text-muted">Alamat:</span><br>
                    <strong>{{ $settings['alamat'] ?? '-' }}</strong>
                </li>
            </ul>
        </div>
        <div class="alert alert-info mt-3 small">
            <i class="bi bi-lightbulb me-1"></i>
            Nomor WhatsApp digunakan untuk bubble chat dan tombol hubungi sales.
            Pastikan diawali dengan <code>0</code>, bukan <code>62</code>.
        </div>
    </div>
</div>

@endsection
