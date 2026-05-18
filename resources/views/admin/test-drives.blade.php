@extends('admin.layout')
@section('title', 'Test Drive')
@section('page-title', 'Booking Test Drive')

@section('content')

<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-2 mb-4">
    <p class="text-muted mb-0">Total: <strong>{{ $testDrives->total() }}</strong> pengajuan</p>
    <form class="d-flex gap-2 flex-wrap" method="GET">
        <input type="text" name="search" value="{{ request('search') }}"
               class="form-control form-control-sm flex-grow-1" placeholder="Cari nama / telepon / tipe..." style="min-width:160px;">
        <button class="btn btn-sm btn-outline-secondary">Cari</button>
        @if(request('search'))
            <a href="{{ route('admin.test-drives.index') }}" class="btn btn-sm btn-outline-danger">Reset</a>
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
                    <th>Tipe Mobil</th>
                    <th class="d-none d-md-table-cell">Tanggal Test Drive</th>
                    <th class="d-none d-md-table-cell">Dikirim</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($testDrives as $td)
                    <tr>
                        <td class="text-muted d-none d-md-table-cell">{{ $testDrives->firstItem() + $loop->index }}</td>
                        <td class="fw-semibold">{{ $td->nama }}</td>
                        <td>
                            <a href="https://wa.me/62{{ ltrim($td->telepon, '0') }}" target="_blank"
                               class="text-decoration-none">
                                <i class="bi bi-whatsapp text-success me-1"></i>{{ $td->telepon }}
                            </a>
                        </td>
                        <td><span class="badge" style="background:#1C4682;">{{ $td->tipe_mobil }}</span></td>
                        <td class="d-none d-md-table-cell">{{ \Carbon\Carbon::parse($td->tanggal)->locale('id')->translatedFormat('d F Y') }}</td>
                        <td class="text-muted small d-none d-md-table-cell">{{ $td->created_at->format('d M Y, H:i') }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.test-drives.destroy', $td) }}" method="POST"
                                  onsubmit="return confirm('Hapus data test drive {{ $td->nama }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-inbox display-6 d-block mb-2"></i>
                            Belum ada data booking test drive.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if ($testDrives->hasPages())
    <div class="mt-3">{{ $testDrives->links() }}</div>
@endif

@endsection
