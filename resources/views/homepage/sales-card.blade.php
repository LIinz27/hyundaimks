@php
    use Illuminate\Support\Facades\Storage;
    $photoUrl = $sales->photo_path ? Storage::disk('public')->url($sales->photo_path) : null;
    $initials = strtoupper(mb_substr($sales->name, 0, 1));
@endphp
<div class="col-sm-6 col-lg-4">
    <a href="{{ route('sales.show', $sales->slug) }}" class="sales-card d-block h-100 text-decoration-none">
        <div class="sales-card-inner h-100">
            <div class="sales-card-photo">
                @if ($photoUrl)
                    <img src="{{ $photoUrl }}" alt="Foto profil {{ $sales->name }}" class="sales-card-img"
                        width="400" height="400" loading="lazy">
                @else
                    <div class="avatar-fallback sales-card-avatar" aria-hidden="true">{{ $initials }}</div>
                @endif
            </div>
            <div class="sales-card-body text-center">
                <h3 class="sales-card-name h5 mb-1">{{ $sales->name }}</h3>
                <p class="sales-card-title text-muted small mb-3">{{ $sales->title }}</p>
                @if ($sales->whatsappLink())
                    <span class="btn btn-success btn-sm sales-card-cta" onclick="event.preventDefault(); event.stopPropagation(); window.open('{{ $sales->whatsappLink() }}', '_blank', 'noopener');">
                        <i class="bi bi-whatsapp" aria-hidden="true"></i> Hubungi
                    </span>
                @else
                    <span class="btn btn-outline-primary btn-sm sales-card-cta">Lihat Profil</span>
                @endif
            </div>
        </div>
    </a>
</div>
