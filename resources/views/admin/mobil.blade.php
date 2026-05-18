@extends('admin.layout')
@section('title', 'Daftar Mobil & Harga')
@section('page-title', 'Daftar Mobil & Harga')

@section('content')

{{-- ── Tambah Mobil ── --}}
<div class="bg-white rounded-3 p-4 shadow-sm mb-4">
    <h6 class="fw-bold mb-3" style="color:#1C4682;"><i class="bi bi-plus-circle me-2"></i>Tambah Mobil Baru</h6>
    <form action="{{ route('admin.mobil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label fw-semibold small">Nama Mobil</label>
                <input type="text" name="nama" class="form-control" placeholder="HYUNDAI STARGAZER" required>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold small">Harga</label>
                <input type="text" name="harga" class="form-control" placeholder="Rp249.600.000" required>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold small">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="mpv">MPV</option>
                    <option value="suv">SUV</option>
                    <option value="eco">Eco</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold small">URL Produk</label>
                <input type="text" name="url" class="form-control" placeholder="/product/stargazer" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold small">Gambar Mobil</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" required>
                <small class="text-muted">Maks. 5 MB</small>
            </div>
        </div>
        <button type="submit" class="btn mt-3 text-white px-4" style="background:#1C4682;">
            <i class="bi bi-plus-circle me-1"></i> Tambah
        </button>
    </form>
</div>

{{-- ── Tabel Mobil ── --}}
<div class="admin-table">
    <div class="table-responsive">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th style="width:60px;">Foto</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>URL</th>
                    <th style="width:80px;">Urutan</th>
                    <th style="width:70px;">Aktif</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mobils as $mobil)
                <tr>
                    <td>
                        <img src="{{ asset('images/car/' . $mobil->gambar) }}" alt="{{ $mobil->nama }}"
                             style="width:50px;height:35px;object-fit:cover;" class="rounded">
                    </td>
                    <td class="fw-semibold">{{ $mobil->nama }}</td>
                    <td><span class="badge" style="background:#1C4682;">{{ $mobil->harga }}</span></td>
                    <td><span class="badge bg-secondary text-uppercase">{{ $mobil->kategori }}</span></td>
                    <td class="text-muted small">{{ $mobil->url }}</td>
                    <td>{{ $mobil->urutan }}</td>
                    <td>
                        @if($mobil->aktif)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Nonaktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-outline-primary"
                                onclick="openEditModal({{ $mobil->id }}, '{{ addslashes($mobil->nama) }}', '{{ addslashes($mobil->harga) }}', '{{ $mobil->kategori }}', '{{ $mobil->url }}', {{ $mobil->urutan }}, {{ $mobil->aktif ? 1 : 0 }})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <form action="{{ route('admin.mobil.destroy', $mobil) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus {{ $mobil->nama }}?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- ── Modal Edit ── --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background:#1C4682;">
                <h5 class="modal-title text-white fw-bold">Edit Data Mobil</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Nama Mobil</label>
                        <input type="text" name="nama" id="editNama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Harga</label>
                        <input type="text" name="harga" id="editHarga" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Kategori</label>
                        <select name="kategori" id="editKategori" class="form-select" required>
                            <option value="mpv">MPV</option>
                            <option value="suv">SUV</option>
                            <option value="eco">Eco</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">URL Produk</label>
                        <input type="text" name="url" id="editUrl" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Urutan</label>
                        <input type="number" name="urutan" id="editUrutan" class="form-control" min="1" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="aktif" id="editAktif" class="form-check-input" value="1">
                        <label class="form-check-label" for="editAktif">Tampilkan di homepage</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Ganti Gambar (opsional)</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white" style="background:#1C4682;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
const baseUrl = '{{ url("admin/mobil") }}';

function openEditModal(id, nama, harga, kategori, url, urutan, aktif) {
    document.getElementById('editNama').value    = nama;
    document.getElementById('editHarga').value   = harga;
    document.getElementById('editKategori').value = kategori;
    document.getElementById('editUrl').value     = url;
    document.getElementById('editUrutan').value  = urutan;
    document.getElementById('editAktif').checked = aktif === 1;
    document.getElementById('editForm').action   = baseUrl + '/' + id;
    new bootstrap.Modal(document.getElementById('editModal')).show();
}
</script>
@endsection
