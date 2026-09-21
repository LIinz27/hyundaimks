{{-- Segmented control untuk halaman login gabungan /login (Admin vs Sales). --}}
{{-- Semua styling inline: Filament menghapus <style> tag, jadi JANGAN pakai <style>/class. --}}
@php($aktif = $tab ?? 'admin')
<div style="display:flex;flex-direction:column;gap:8px">
    <p style="margin:0;font-size:12px;font-weight:500;color:#6b7280;text-transform:uppercase;letter-spacing:0.08em">
        Masuk sebagai
    </p>
    <div role="tablist" aria-label="Jenis akun" style="display:flex;gap:8px;border-bottom:1px solid #e5e7eb">
        @foreach (['admin' => 'Admin', 'sales' => 'Sales'] as $nilai => $label)
            @php($isAktif = $aktif === $nilai)
            <a
                href="{{ url('/login') }}?tab={{ $nilai }}"
                role="tab"
                id="tab-{{ $nilai }}"
                aria-controls="panel-login"
                aria-selected="{{ $isAktif ? 'true' : 'false' }}"
                tabindex="{{ $isAktif ? '0' : '-1' }}"
                @if (!$isAktif)
                    onmouseover="this.style.color='#1f2937';this.style.backgroundColor='#f3f4f6'"
                    onmouseout="this.style.color='#4b5563';this.style.backgroundColor='transparent'"
                @endif
                style="display:flex;align-items:center;justify-content:center;gap:6px;padding:8px 16px;margin-bottom:-1px;font-size:14px;text-decoration:none;cursor:pointer;background:transparent;border:0;border-bottom:2px solid {{ $isAktif ? '#1c4682' : 'transparent' }};color:{{ $isAktif ? '#1c4682' : '#4b5563' }};font-weight:{{ $isAktif ? '600' : '500' }}"
            >
                @if ($nilai === 'admin')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="width:16px;height:16px;flex:none">
                        <path d="M12 3l7 3v5c0 4.4-2.9 8-7 10-4.1-2-7-5.6-7-10V6l7-3z"/>
                        <path d="M9.5 11.5l2 2 3.5-3.5"/>
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="width:16px;height:16px;flex:none">
                        <circle cx="12" cy="8" r="3.5"/>
                        <path d="M5 20c1-3.4 3.8-5.5 7-5.5s6 2.1 7 5.5"/>
                    </svg>
                @endif
                {{ $label }}
            </a>
        @endforeach
    </div>
</div>
