@extends('admin.layout')
@section('title', 'Profil Sales Consultant')
@section('page-title', 'Profil Sales Consultant')

@section('content')

<div class="row g-4">
    {{-- ── Preview ── --}}
    <div class="col-12 col-lg-4">
        <div class="bg-white rounded-3 p-4 shadow-sm text-center">
            <h6 class="fw-bold mb-3" style="color:#1C4682;">Preview Tampilan</h6>
            @if ($profile)
                <img src="{{ asset('images/' . $profile->foto) }}"
                     alt="{{ $profile->nama }}"
                     class="rounded-circle mb-3"
                     style="width:120px; height:120px; object-fit:cover; border:3px solid #1C4682;">
                <h5 class="fw-bold mb-1">{{ $profile->nama }}</h5>
                <p class="text-muted small mb-3">{{ $profile->jabatan }}</p>
                <ul class="text-start list-unstyled small">
                    @foreach ($profile->keunggulan ?? [] as $poin)
                        <li class="mb-1"><i class="bi bi-check-circle-fill text-success me-2"></i>{{ $poin }}</li>
                    @endforeach
                </ul>
                <div class="d-flex gap-2 justify-content-center mt-3">
                    <a href="https://wa.me/62{{ ltrim($profile->whatsapp, '0') }}" target="_blank"
                       class="btn btn-sm btn-success">
                        <i class="bi bi-whatsapp me-1"></i>{{ $profile->whatsapp }}
                    </a>
                    <a href="tel:{{ $profile->telepon }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-telephone-fill me-1"></i>{{ $profile->telepon }}
                    </a>
                </div>
            @else
                <p class="text-muted">Belum ada data profil.</p>
            @endif
        </div>
    </div>

    {{-- ── Edit Form ── --}}
    <div class="col-12 col-lg-8">
        <div class="bg-white rounded-3 p-4 shadow-sm">
            <h6 class="fw-bold mb-4" style="color:#1C4682;">
                <i class="bi bi-pencil-square me-2"></i>Edit Profil Sales
            </h6>
            <form action="{{ route('admin.sales.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control"
                               value="{{ old('nama', $profile?->nama) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control"
                               value="{{ old('jabatan', $profile?->jabatan ?? 'Profesional Sales Consultant') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">No. WhatsApp</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
                            <input type="text" name="whatsapp" class="form-control"
                                   value="{{ old('whatsapp', $profile?->whatsapp) }}" placeholder="0896-1688-0688" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">No. Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input type="text" name="telepon" class="form-control"
                                   value="{{ old('telepon', $profile?->telepon) }}" placeholder="0896-1688-0688" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold small">
                            Poin Keunggulan
                            <small class="text-muted fw-normal">(satu poin per baris)</small>
                        </label>
                        <textarea name="keunggulan" class="form-control" rows="5" required
                                  placeholder="Melayani tukar tambah mobil lama dengan harga tinggi.&#10;Layanan Chat 24 Jam Fast Respon.">{{ old('keunggulan', $profile ? implode("\n", $profile->keunggulan ?? []) : '') }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold small">
                            Ganti Foto
                            @if ($profile?->foto)
                                <small class="text-muted fw-normal"> — saat ini: {{ $profile->foto }}</small>
                            @endif
                        </label>
                        <input type="file" name="foto" class="form-control" accept="image/*"
                               onchange="previewFoto(this)">
                        <small class="text-muted">Maks. 5 MB · JPG, PNG, WebP</small>
                        <img id="previewFoto" src="#" class="img-fluid rounded mt-2 d-none"
                             style="max-height:120px; object-fit:cover;">
                    </div>
                </div>
                <button type="submit" class="btn mt-4 text-white px-5 fw-semibold" style="background:#1C4682;">
                    <i class="bi bi-save me-2"></i>Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function previewFoto(input) {
    const preview = document.getElementById('previewFoto');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.classList.remove('d-none'); };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
