@extends('admin.layout')
@section('title', 'Manajemen Pricelist')
@section('page-title', 'Manajemen Pricelist')

@section('content')

<div class="row g-4">
    {{-- ── Upload Form ── --}}
    <div class="col-12 col-lg-4">
        <div class="bg-white rounded-3 p-4 shadow-sm">
            <h6 class="fw-bold mb-3" style="color:#1C4682;">
                <i class="bi bi-cloud-upload me-2"></i>Upload Pricelist Baru
            </h6>
            <form action="{{ route('admin.pricelist.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold small">File Pricelist</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*,.pdf" required
                           onchange="previewImage(this, 'preview-pricelist')">
                    <small class="text-muted">Maks. 20 MB · JPG, PNG, WebP, PDF</small>
                </div>
                <img id="preview-pricelist" src="#" alt="Preview" class="img-fluid rounded mb-3 d-none" style="max-height:200px; object-fit:contain; width:100%;">
                <button type="submit" class="btn w-100 text-white fw-semibold" style="background:#1C4682;">
                    <i class="bi bi-arrow-up-circle me-2"></i>Upload Pricelist
                </button>
            </form>

            <div class="alert alert-info mt-3 small py-2">
                <i class="bi bi-info-circle me-1"></i>
                Pricelist terbaru (pertama dalam daftar) akan ditampilkan di halaman publik.
            </div>
        </div>
    </div>

    {{-- ── List Pricelist ── --}}
    <div class="col-12 col-lg-8">
        <p class="text-muted mb-3">Total: <strong>{{ $pricelists->count() }}</strong> file pricelist</p>

        @forelse ($pricelists as $pl)
            <div class="bg-white rounded-3 overflow-hidden shadow-sm mb-3 d-flex align-items-center gap-3 p-3">
                @if (str_ends_with(strtolower($pl->filename), '.pdf'))
                    <div class="rounded d-flex align-items-center justify-content-center bg-light" style="width:100px; height:70px;">
                        <i class="bi bi-file-earmark-pdf text-danger" style="font-size:2.5rem;"></i>
                    </div>
                @else
                    <img src="{{ asset('images/pricelist/' . $pl->filename) }}"
                         alt="Pricelist" class="rounded" style="width:100px; height:70px; object-fit:cover;">
                @endif
                <div class="flex-grow-1">
                    <p class="fw-semibold mb-1 small">{{ $pl->filename }}</p>
                    <p class="text-muted mb-0" style="font-size:.75rem;">
                        Diunggah: {{ $pl->created_at->format('d M Y, H:i') }}
                        @if ($loop->first)
                            <span class="badge bg-success ms-2">Aktif</span>
                        @endif
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ asset('images/pricelist/' . $pl->filename) }}" target="_blank"
                       class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-eye"></i>
                    </a>
                    <form action="{{ route('admin.pricelist.destroy', $pl) }}" method="POST"
                          onsubmit="return confirm('Hapus pricelist ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center text-muted py-5 bg-white rounded-3">
                <i class="bi bi-file-earmark-image display-6 d-block mb-2"></i>
                Belum ada pricelist. Upload pricelist pertama Anda.
            </div>
        @endforelse
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
