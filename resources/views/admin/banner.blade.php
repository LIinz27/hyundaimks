@extends('admin.layout')
@section('title', 'Banner / Sampul Homepage')
@section('page-title', 'Banner / Sampul Homepage')

@section('content')

<div class="row g-4">
    {{-- ── Upload Form ── --}}
    <div class="col-12 col-lg-4">
        <div class="bg-white rounded-3 p-4 shadow-sm">
            <h6 class="fw-bold mb-3" style="color:#1C4682;">
                <i class="bi bi-cloud-upload me-2"></i>Upload Banner Baru
            </h6>
            <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Gambar Banner</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*" required
                           onchange="previewImage(this)">
                    <small class="text-muted">Maks. 10 MB · Disarankan lebar ≥ 1920px</small>
                </div>
                <img id="preview" src="#" class="img-fluid rounded mb-3 d-none"
                     style="max-height:150px; object-fit:cover; width:100%;">
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Keterangan (opsional)</label>
                    <input type="text" name="judul" class="form-control" placeholder="Banner Lebaran 2025..." maxlength="255">
                </div>
                <button type="submit" class="btn w-100 text-white fw-semibold" style="background:#1C4682;">
                    <i class="bi bi-arrow-up-circle me-2"></i>Upload Banner
                </button>
            </form>

            <div class="alert alert-info mt-3 small py-2">
                <i class="bi bi-info-circle me-1"></i>
                Klik tombol <strong>Aktifkan</strong> pada banner yang ingin ditampilkan di homepage.
                Hanya satu banner yang bisa aktif sekaligus.
            </div>
        </div>
    </div>

    {{-- ── List Banner ── --}}
    <div class="col-12 col-lg-8">
        <p class="text-muted mb-3">Total: <strong>{{ $banners->count() }}</strong> banner</p>

        @forelse ($banners as $banner)
            <div class="bg-white rounded-3 overflow-hidden shadow-sm mb-3">
                <div class="d-flex">
                    <img src="{{ asset($banner->filename) }}" alt="{{ $banner->judul }}"
                         style="width:160px; height:90px; object-fit:cover; flex-shrink:0;">
                    <div class="flex-grow-1 p-3 d-flex align-items-center justify-content-between">
                        <div>
                            <p class="fw-semibold mb-1 small">{{ $banner->judul ?? $banner->filename }}</p>
                            <p class="text-muted mb-0" style="font-size:.75rem;">
                                Diunggah: {{ $banner->created_at->format('d M Y, H:i') }}
                            </p>
                            @if ($banner->aktif)
                                <span class="badge bg-success mt-1">Aktif</span>
                            @endif
                        </div>
                        <div class="d-flex gap-2 ms-3">
                            @unless ($banner->aktif)
                                <form action="{{ route('admin.banner.aktif', $banner) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-check-circle me-1"></i>Aktifkan
                                    </button>
                                </form>
                            @endunless
                            <a href="{{ asset($banner->filename) }}" target="_blank"
                               class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-eye"></i>
                            </a>
                            @unless ($banner->aktif)
                                <form action="{{ route('admin.banner.destroy', $banner) }}" method="POST"
                                      onsubmit="return confirm('Hapus banner ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            @endunless
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted py-5 bg-white rounded-3">
                <i class="bi bi-image display-6 d-block mb-2"></i>
                Belum ada banner. Upload banner pertama Anda.
            </div>
        @endforelse
    </div>
</div>

@endsection

@section('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.classList.remove('d-none'); };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
