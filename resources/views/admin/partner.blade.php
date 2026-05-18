@extends('admin.layout')
@section('title', 'Partner Finance')
@section('page-title', 'Partner Finance')

@section('content')

<div class="row g-4">
    {{-- ── Upload Form ── --}}
    <div class="col-12 col-lg-4">
        <div class="bg-white rounded-3 p-4 shadow-sm">
            <h6 class="fw-bold mb-3" style="color:#1C4682;">
                <i class="bi bi-plus-circle me-2"></i>Tambah Logo Partner
            </h6>
            <form action="{{ route('admin.partner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Nama Partner</label>
                    <input type="text" name="nama" class="form-control" placeholder="BCA Finance" required maxlength="100">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Logo (JPG/PNG)</label>
                    <input type="file" name="logo" class="form-control" accept="image/*" required
                           onchange="previewLogo(this)">
                    <small class="text-muted">Maks. 2 MB</small>
                    <img id="previewLogo" src="#" class="img-fluid rounded mt-2 d-none"
                         style="max-height:60px; object-fit:contain;">
                </div>
                <button type="submit" class="btn w-100 text-white fw-semibold" style="background:#1C4682;">
                    <i class="bi bi-cloud-upload me-2"></i>Upload Logo
                </button>
            </form>
        </div>

        <div class="bg-white rounded-3 p-4 shadow-sm mt-4">
            <h6 class="fw-bold mb-3" style="color:#1C4682;">
                <i class="bi bi-arrow-down-up me-2"></i>Atur Urutan
            </h6>
            <form action="{{ route('admin.partner.urutan') }}" method="POST">
                @csrf
                @foreach ($partners as $partner)
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <img src="{{ asset('images/finance/' . $partner->filename) }}" alt="{{ $partner->nama }}"
                             style="width:40px; height:28px; object-fit:contain;">
                        <span class="small flex-grow-1">{{ $partner->nama }}</span>
                        <input type="number" name="urutan[{{ $partner->id }}]"
                               value="{{ $partner->urutan }}" class="form-control form-control-sm"
                               style="width:70px;" min="1">
                    </div>
                @endforeach
                <button type="submit" class="btn btn-sm w-100 mt-2 text-white" style="background:#1C4682;">
                    Simpan Urutan
                </button>
            </form>
        </div>
    </div>

    {{-- ── Grid Logos ── --}}
    <div class="col-12 col-lg-8">
        <p class="text-muted mb-3">Total: <strong>{{ $partners->count() }}</strong> partner</p>
        <div class="row g-3">
            @forelse ($partners as $partner)
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="bg-white rounded-3 p-3 shadow-sm text-center h-100 d-flex flex-column align-items-center justify-content-between">
                        <img src="{{ asset('images/finance/' . $partner->filename) }}"
                             alt="{{ $partner->nama }}"
                             style="max-height:50px; max-width:100%; object-fit:contain;" class="mb-2">
                        <p class="small fw-semibold mb-1">{{ $partner->nama }}</p>
                        <p class="text-muted mb-2" style="font-size:.7rem;">Urutan: {{ $partner->urutan }}</p>
                        <form action="{{ route('admin.partner.destroy', $partner) }}" method="POST"
                              onsubmit="return confirm('Hapus {{ $partner->nama }}?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger py-0 px-2">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <i class="bi bi-images display-6 d-block mb-2"></i>
                    Belum ada logo partner.
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function previewLogo(input) {
    const preview = document.getElementById('previewLogo');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.classList.remove('d-none'); };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
