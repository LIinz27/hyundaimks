@php
    use Illuminate\Support\Facades\Storage;
    $photoUrl = $sales->photo_path ? Storage::disk('public')->url($sales->photo_path) : null;
    $initials = strtoupper(mb_substr($sales->name, 0, 1));
    $waLink = $sales->whatsappLink();
    $phoneLink = $sales->phoneLink();
    $servicePoints = array_values(array_filter(array_map('trim', preg_split('/\R/', $sales->bio ?? ''))));
@endphp

@extends('layouts.app')

@section('title', $sales->name . ' - Sales Hyundai Makassar')

@push('styles')
    <meta name="description" content="{{ Str::limit(strip_tags($sales->bio ?? 'Sales resmi Hyundai Makassar.'), 160) }}">
    <meta property="og:title" content="{{ $sales->name }} - Sales Hyundai Makassar">
    <meta property="og:description" content="{{ Str::limit(strip_tags($sales->bio ?? ''), 200) }}">
    @if ($photoUrl)
        <meta property="og:image" content="{{ $photoUrl }}">
    @endif
    <meta property="og:type" content="profile">
@endpush

@section('content')
    <div class="container sales-page py-4">
        {{-- 1. Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sales</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $sales->name }}</li>
            </ol>
        </nav>

        {{-- 2 & 3. Foto + Nama --}}
        <div class="sales-hero text-center">
            <div class="sales-hero-photo mx-auto">
                @if ($photoUrl)
                    <img src="{{ $photoUrl }}" alt="Foto profil {{ $sales->name }}" class="sales-hero-img"
                        width="220" height="220">
                @else
                    <div class="avatar-fallback sales-hero-avatar" aria-hidden="true">{{ $initials }}</div>
                @endif
            </div>
            <h1 class="sales-hero-name mt-3 mb-1">{{ $sales->name }}</h1>
            <p class="text-muted mb-2">{{ $sales->title }}</p>
            <span class="badge sales-badge mb-3">Sales Resmi Hyundai Makassar</span>

            {{-- 4. Tombol kontak --}}
            <div class="sales-actions d-flex flex-wrap gap-2 justify-content-center mt-3">
                @if ($waLink)
                    <a href="{{ $waLink }}" target="_blank" rel="noopener" class="btn btn-success sales-btn"
                        aria-label="Hubungi {{ $sales->name }} via WhatsApp">
                        <i class="bi bi-whatsapp" aria-hidden="true"></i> WhatsApp
                    </a>
                @endif
                @if ($phoneLink)
                    <a href="{{ $phoneLink }}" class="btn btn-outline-primary sales-btn"
                        aria-label="Telepon {{ $sales->name }}">
                        <i class="bi bi-telephone-fill" aria-hidden="true"></i> Telepon
                    </a>
                @endif
            </div>
        </div>

        {{-- 5. Bio --}}
        @if ($sales->bio)
            <div class="sales-bio mx-auto mt-4">
                <h2 class="h5">Tentang</h2>
                <p>{{ $sales->bio }}</p>
            </div>
        @endif

        {{-- 6. Poin layanan --}}
        @if (count($servicePoints))
            <div class="sales-services mx-auto mt-4">
                <h2 class="h5">Layanan Saya</h2>
                <ul class="sales-service-list list-unstyled mb-0">
                    @foreach ($servicePoints as $point)
                        <li class="mb-2"><i class="bi bi-check-circle-fill sales-check" aria-hidden="true"></i> {{ $point }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- 7. Dokumentasi --}}
        <div class="sales-docs mx-auto mt-5">
            <h2 class="h5 text-center mb-3">Dokumentasi</h2>
            @if ($sales->documents->isEmpty())
                <div class="empty-state text-center py-4">
                    <i class="bi bi-images empty-state-icon" aria-hidden="true"></i>
                    <p class="text-muted mb-0">Belum ada dokumentasi yang diunggah.</p>
                </div>
            @else
                <div class="sales-docs-grid">
                    @foreach ($sales->documents as $doc)
                        @php $docUrl = Storage::disk('public')->url($doc->file_path); @endphp
                        <button type="button" class="sales-doc-item" data-bs-toggle="modal"
                            data-bs-target="#docModal-{{ $doc->id }}"
                            aria-label="Perbesar dokumentasi {{ $doc->caption ?? $loop->iteration }}">
                            <img src="{{ $docUrl }}" alt="{{ $doc->caption ?? 'Dokumentasi ' . $sales->name }}"
                                class="sales-doc-img" width="400" height="400" loading="lazy">
                        </button>

                        <div class="modal fade" id="docModal-{{ $doc->id }}" tabindex="-1"
                            aria-labelledby="docModalLabel-{{ $doc->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title h6" id="docModalLabel-{{ $doc->id }}">
                                            {{ $doc->caption ?? 'Dokumentasi' }}
                                        </h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ $docUrl }}" alt="{{ $doc->caption ?? 'Dokumentasi ' . $sales->name }}"
                                            class="img-fluid rounded">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- 8. CTA pricelist --}}
        <div class="text-center my-5">
            <h2 class="h5 mb-3">Lihat harga mobil Hyundai terbaru</h2>
            <a href="{{ url('/pricelist') }}" class="btn btn-brand btn-lg px-5">Lihat Pricelist</a>
        </div>
    </div>

    {{-- 9. Sticky action bar (mobile) --}}
    @if ($waLink || $phoneLink)
        <div class="sticky-contact-bar d-md-none">
            @if ($waLink)
                <a href="{{ $waLink }}" target="_blank" rel="noopener" class="btn btn-success flex-fill"
                    aria-label="Hubungi {{ $sales->name }} via WhatsApp">
                    <i class="bi bi-whatsapp" aria-hidden="true"></i> WhatsApp
                </a>
            @endif
            @if ($phoneLink)
                <a href="{{ $phoneLink }}" class="btn btn-outline-primary flex-fill bg-white"
                    aria-label="Telepon {{ $sales->name }}">
                    <i class="bi bi-telephone-fill" aria-hidden="true"></i> Telepon
                </a>
            @endif
        </div>
    @endif
@endsection
