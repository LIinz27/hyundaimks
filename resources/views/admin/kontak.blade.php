@extends('admin.layout')
@section('title', 'Pesan Kontak')
@section('page-title', 'Pesan Kontak')

@section('content')

<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-2 mb-4">
    <p class="text-muted mb-0">Total: <strong>{{ $kontaks->total() }}</strong> pesan</p>
    <form class="d-flex gap-2 flex-wrap" method="GET">
        <input type="text" name="search" value="{{ request('search') }}"
               class="form-control form-control-sm flex-grow-1" placeholder="Cari nama / email..." style="min-width:160px;">
        <button class="btn btn-sm btn-outline-secondary">Cari</button>
        @if(request('search'))
            <a href="{{ route('admin.kontak.index') }}" class="btn btn-sm btn-outline-danger">Reset</a>
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
                    <th class="d-none d-md-table-cell">Email</th>
                    <th>Telepon</th>
                    <th>Pesan</th>
                    <th class="d-none d-md-table-cell">Dikirim</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kontaks as $k)
                    <tr>
                        <td class="text-muted d-none d-md-table-cell">{{ $kontaks->firstItem() + $loop->index }}</td>
                        <td class="fw-semibold">{{ $k->nama }}</td>
                        <td class="d-none d-md-table-cell">
                            <a href="mailto:{{ $k->email }}" class="text-decoration-none">
                                <i class="bi bi-envelope me-1"></i>{{ $k->email }}
                            </a>
                        </td>
                        <td>
                            <a href="https://wa.me/62{{ ltrim($k->telepon, '0') }}" target="_blank"
                               class="text-decoration-none">
                                <i class="bi bi-whatsapp text-success me-1"></i>{{ $k->telepon }}
                            </a>
                        </td>
                        <td>
                            <span data-bs-toggle="tooltip" title="{{ $k->pesan }}">
                                {{ Str::limit($k->pesan, 60) }}
                            </span>
                        </td>
                        <td class="text-muted small d-none d-md-table-cell">{{ $k->created_at->format('d M Y, H:i') }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.kontak.destroy', $k) }}" method="POST"
                                  onsubmit="return confirm('Hapus pesan dari {{ $k->nama }}?')">
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
                            Belum ada pesan masuk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if ($kontaks->hasPages())
    <div class="mt-3">{{ $kontaks->links() }}</div>
@endif

@endsection

@section('scripts')
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
</script>
@endsection
