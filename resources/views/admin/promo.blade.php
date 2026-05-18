@extends('admin.layout')
@section('title', 'Manajemen Promo')
@section('page-title', 'Manajemen Promo')

@section('content')

<div class="row g-4">
    {{-- ── Upload Form ── --}}
    <div class="col-12 col-lg-4">
        <div class="bg-white rounded-3 p-4 shadow-sm">
            <h6 class="fw-bold mb-3" style="color:#1C4682;">
                <i class="bi bi-cloud-upload me-2"></i>Tambah Promo Baru
            </h6>
            <form action="{{ route('admin.promo.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Gambar Promo</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*" required
                           onchange="previewImage(this, 'preview-promo')">
                    <small class="text-muted">Maks. 5 MB · JPG, PNG, WebP</small>
                </div>
                <img id="preview-promo" src="#" alt="Preview" class="img-fluid rounded mb-3 d-none" style="max-height:200px; object-fit:cover; width:100%;">
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Judul Promo (opsional)</label>
                    <input type="text" name="judul" class="form-control" placeholder="Promo Lebaran 2024..." maxlength="255">
                </div>
                <button type="submit" class="btn w-100 text-white fw-semibold" style="background:#1C4682;">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Promo
                </button>
            </form>
        </div>
    </div>

    {{-- ── Grid Promo ── --}}
    <div class="col-12 col-lg-8">
        <p class="text-muted mb-3">Total: <strong>{{ $promos->count() }}</strong> promo</p>
        <div class="row g-3">
            @forelse ($promos as $promo)
                <div class="col-6 col-md-4">
                    <div class="bg-white rounded-3 overflow-hidden shadow-sm h-100">
                        <img src="{{ asset('images/Promo/' . $promo->filename) }}"
                             alt="{{ $promo->judul ?? $promo->filename }}"
                             class="img-fluid w-100" style="height:150px; object-fit:cover;">
                        <div class="p-2">
                            @if ($promo->judul)
                                <p class="small fw-semibold mb-1">{{ $promo->judul }}</p>
                            @endif
                            <p class="text-muted" style="font-size:.72rem;">{{ $promo->created_at->format('d M Y') }}</p>
                            <form action="{{ route('admin.promo.destroy', $promo) }}" method="POST"
                                  onsubmit="return confirm('Hapus promo ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger w-100">
                                    <i class="bi bi-trash me-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-images display-6 d-block mb-2"></i>
                        Belum ada promo. Tambahkan promo pertama Anda.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
