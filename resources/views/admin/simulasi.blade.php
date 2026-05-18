@extends('admin.layout')
@section('title', 'Simulasi Kredit')
@section('page-title', 'Simulasi Kredit')

@section('content')

<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-2 mb-4">
    <p class="text-muted mb-0">Total: <strong>{{ $simulasis->total() }}</strong> pengajuan</p>
    <form class="d-flex gap-2 flex-wrap" method="GET">
        <input type="text" name="search" value="{{ request('search') }}"
               class="form-control form-control-sm flex-grow-1" placeholder="Cari nama / telepon / tipe..." style="min-width:160px;">
        <button class="btn btn-sm btn-outline-secondary">Cari</button>
        @if(request('search'))
            <a href="{{ route('admin.simulasi.index') }}" class="btn btn-sm btn-outline-danger">Reset</a>
        @endif
    </form>
</div>

<div class="admin-table">
    <div class="table-responsive">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th class="d-none d-md-table-cell">#</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th class="d-none d-lg-table-cell">Kota</th>
                    <th>Tipe Mobil</th>
                    <th class="d-none d-lg-table-cell">Tenor</th>
                    <th class="d-none d-lg-table-cell">Uang Muka</th>
                    <th class="d-none d-md-table-cell">Dikirim</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($simulasis as $s)
                    <tr>
                        <td class="text-muted d-none d-md-table-cell">{{ $simulasis->firstItem() + $loop->index }}</td>
                        <td class="fw-semibold">{{ $s->nama }}</td>
                        <td>
                            <a href="https://wa.me/62{{ ltrim($s->telepon, '0') }}" target="_blank"
                               class="text-decoration-none">
                                <i class="bi bi-whatsapp text-success me-1"></i>{{ $s->telepon }}
                            </a>
                        </td>
                        <td class="d-none d-lg-table-cell">{{ $s->kota }}</td>
                        <td><span class="badge" style="background:#1C4682;">{{ $s->tipe_mobil }}</span></td>
                        <td class="d-none d-lg-table-cell">{{ $s->tenor }} Tahun</td>
                        <td class="d-none d-lg-table-cell">Rp {{ number_format($s->uang_muka, 0, ',', '.') }}</td>
                        <td class="text-muted small d-none d-md-table-cell">{{ $s->created_at->format('d M Y, H:i') }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.simulasi.destroy', $s) }}" method="POST"
                                  onsubmit="return confirm('Hapus data simulasi kredit {{ $s->nama }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-5">
                            <i class="bi bi-inbox display-6 d-block mb-2"></i>
                            Belum ada data simulasi kredit.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if ($simulasis->hasPages())
    <div class="mt-3">{{ $simulasis->links() }}</div>
@endif

@endsection
