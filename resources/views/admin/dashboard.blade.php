@extends('admin.layout')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- ── Stats ── --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="icon" style="background:#e8f0fe;">
                <i class="bi bi-car-front-fill" style="color:#1C4682;"></i>
            </div>
            <div>
                <div class="number">{{ $stats['test_drive'] }}</div>
                <div class="label">Booking Test Drive</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="icon" style="background:#fce8f3;">
                <i class="bi bi-calculator" style="color:#c2185b;"></i>
            </div>
            <div>
                <div class="number">{{ $stats['simulasi'] }}</div>
                <div class="label">Simulasi Kredit</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="icon" style="background:#e8f5e9;">
                <i class="bi bi-envelope-fill" style="color:#2e7d32;"></i>
            </div>
            <div>
                <div class="number">{{ $stats['kontak'] }}</div>
                <div class="label">Pesan Kontak</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="icon" style="background:#fff3e0;">
                <i class="bi bi-megaphone-fill" style="color:#e65100;"></i>
            </div>
            <div>
                <div class="number">{{ $stats['promo'] }}</div>
                <div class="label">Promo Aktif</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- ── Test Drive terbaru ── --}}
    <div class="col-12 col-xl-6">
        <div class="admin-table">
            <div class="d-flex align-items-center justify-content-between px-3 py-3 border-bottom">
                <h6 class="fw-bold mb-0" style="color:#1C4682;">
                    <i class="bi bi-car-front-fill me-2"></i>Test Drive Terbaru
                </h6>
                <a href="{{ route('admin.test-drives.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Tipe Mobil</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latestTestDrives as $td)
                            <tr>
                                <td>{{ $td->nama }}</td>
                                <td>{{ $td->telepon }}</td>
                                <td><span class="badge" style="background:#1C4682;">{{ $td->tipe_mobil }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($td->tanggal)->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">Belum ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ── Pesan Kontak terbaru ── --}}
    <div class="col-12 col-xl-6">
        <div class="admin-table">
            <div class="d-flex align-items-center justify-content-between px-3 py-3 border-bottom">
                <h6 class="fw-bold mb-0" style="color:#2e7d32;">
                    <i class="bi bi-envelope-fill me-2"></i>Pesan Terbaru
                </h6>
                <a href="{{ route('admin.kontak.index') }}" class="btn btn-sm btn-outline-success">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latestKontaks as $k)
                            <tr>
                                <td>{{ $k->nama }}</td>
                                <td>{{ $k->email }}</td>
                                <td>
                                    <span class="text-muted small" title="{{ $k->pesan }}">
                                        {{ Str::limit($k->pesan, 50) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted py-4">Belum ada pesan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
