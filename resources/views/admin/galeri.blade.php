@extends('admin.layout')
@section('title', 'Galeri / Portofolio')
@section('page-title', 'Galeri / Portofolio')

@section('content')

<div class="row g-4">
    {{-- ── Upload Form ── --}}
    <div class="col-12 col-lg-4">
        <div class="bg-white rounded-3 p-4 shadow-sm">
            <h6 class="fw-bold mb-3" style="color:#1C4682;">
                <i class="bi bi-cloud-upload me-2"></i>Tambah Foto Galeri
            </h6>
            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Foto</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*" required
                           onchange="previewImage(this, 'preview-galeri')">
                    <small class="text-muted">Maks. 5 MB · JPG, PNG, WebP</small>
                </div>
                <img id="preview-galeri" src="#" alt="Preview" class="img-fluid rounded mb-3 d-none"
                     style="max-height:200px; object-fit:cover; width:100%;">
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Judul / Keterangan (opsional)</label>
                    <input type="text" name="judul" class="form-control"
                           placeholder="Contoh: Showroom Hyundai Makassar" maxlength="255">
                </div>
                <button type="submit" class="btn w-100 text-white fw-semibold" style="background:#1C4682;">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Foto
                </button>
            </form>

            <hr class="my-4">

            {{-- ── Simpan Urutan ── --}}
            <h6 class="fw-bold mb-2" style="color:#1C4682;">
                <i class="bi bi-sort-numeric-down me-2"></i>Atur Urutan
            </h6>
            <p class="text-muted small mb-3">
                Ubah angka urutan pada kolom foto lalu klik tombol simpan di bawah.
            </p>
            <form action="{{ route('admin.galeri.urutan') }}" method="POST" id="urutanForm">
                @csrf
                {{-- Input tersembunyi diisi dari JS --}}
                <div id="urutanInputs"></div>
                <button type="submit" class="btn btn-outline-primary w-100 btn-sm">
                    <i class="bi bi-save me-1"></i>Simpan Urutan
                </button>
            </form>
        </div>
    </div>

    {{-- ── Grid Foto ── --}}
    <div class="col-12 col-lg-8">
        <p class="text-muted mb-3">
            Total: <strong>{{ $galeris->count() }}</strong> foto &nbsp;·&nbsp;
            <span class="text-muted small">Ubah angka di bawah foto untuk mengatur urutan tampil.</span>
        </p>
        <div class="row g-3" id="galeriGrid">
            @forelse ($galeris as $foto)
                <div class="col-6 col-md-4" data-id="{{ $foto->id }}">
                    <div class="bg-white rounded-3 overflow-hidden shadow-sm h-100">
                        <img src="{{ asset('images/Galeri/' . $foto->filename) }}"
                             alt="{{ $foto->judul ?? $foto->filename }}"
                             class="img-fluid w-100" style="height:150px; object-fit:cover;">
                        <div class="p-2">
                            @if ($foto->judul)
                                <p class="small fw-semibold mb-1" title="{{ $foto->judul }}">
                                    {{ Str::limit($foto->judul, 30) }}
                                </p>
                            @endif
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <label class="text-muted small mb-0">Urutan:</label>
                                <input type="number" class="form-control form-control-sm urutan-input"
                                       data-id="{{ $foto->id }}"
                                       value="{{ $foto->urutan }}" min="1" style="width:65px;">
                            </div>
                            <form action="{{ route('admin.galeri.destroy', $foto) }}" method="POST"
                                  onsubmit="return confirm('Hapus foto ini?')">
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
                        Belum ada foto galeri. Tambahkan foto pertama Anda.
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

// Kumpulkan nilai urutan ke dalam hidden inputs sebelum form submit
document.getElementById('urutanForm').addEventListener('submit', function () {
    const container = document.getElementById('urutanInputs');
    container.innerHTML = '';
    document.querySelectorAll('.urutan-input').forEach(function (el) {
        const input = document.createElement('input');
        input.type  = 'hidden';
        input.name  = 'urutan[' + el.dataset.id + ']';
        input.value = el.value;
        container.appendChild(input);
    });
});
</script>
@endsection
