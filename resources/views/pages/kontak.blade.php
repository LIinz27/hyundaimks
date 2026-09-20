@extends('layouts.app')

@section('title', 'Kontak - Dealer Hyundai Makassar')

@section('content')
    <div class="page-hero">
        <img src="{{ asset('images/photo_2023-06-06_20-05-30.jpg') }}" alt="Kontak" class="page-hero-image">
        <div class="page-hero-overlay"></div>
        <h1 class="page-hero-title">Kontak</h1>
    </div>

    @php($sales = active_sales())

    <div class="container mt-5">
        <h2 class="fw-bold mb-4 text-center">Kirim Pesan</h2>
        <p class="mb-5 text-center">
            Isi formulir di bawah ini, pesan Anda akan dikirim melalui WhatsApp
            @if ($sales)
                ke <strong>{{ $sales->name }}</strong>
            @endif
        </p>

        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                {{-- Pesan dirangkai lalu dikirim ke WhatsApp sales aktif.
                     Tanpa sales, form tidak ditampilkan karena tidak ada tujuan. --}}
                <form class="p-3 p-md-4 p-lg-5" id="contactForm"
                      @if ($sales && $sales->whatsappLink())
                          action="{{ $sales->whatsappLink() }}"
                          method="get"
                          target="_blank"
                          data-wa-form
                      @endif
                >
                    <div class="mb-4">
                        <label for="fullName" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control form-control-lg" id="fullName" name="fullName"
                               placeholder="Masukkan nama lengkap Anda" required>
                    </div>

                    <div class="mb-4">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-lg" id="Email" name="email"
                               placeholder="Email">
                    </div>

                    <div class="mb-4">
                        <label for="contactNumber" class="form-label">No. HP/WhatsApp</label>
                        <input type="text" class="form-control form-control-lg" id="contactNumber" name="contactNumber"
                               placeholder="Masukkan nomor HP atau WhatsApp Anda">
                    </div>

                    <div class="mb-4">
                        <label for="message" class="form-label">Tulis Pesan</label>
                        <textarea class="form-control form-control-lg" id="message" name="message" rows="5"
                                  placeholder="Tulis pesan Anda di sini" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-whatsapp w-100 py-3 mb-5">
                        <i class="bi bi-whatsapp me-2" aria-hidden="true"></i>Kirim via WhatsApp
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@if ($sales && $sales->whatsappLink())
<script>
    // Rangkai isi form menjadi satu pesan WhatsApp.
    (function () {
        var form = document.getElementById('contactForm');
        if (!form) return;

        var waBase = @json($sales->whatsappLink());

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var val = function (id) {
                var el = document.getElementById(id);
                return el && el.value ? el.value.trim() : '';
            };

            var lines = [
                'Halo, saya ' + val('fullName') + '.',
                val('contactNumber') ? 'Nomor saya: ' + val('contactNumber') : '',
                val('email') ? 'Email: ' + val('email') : '',
                '',
                val('message')
            ].filter(function (l) { return l !== ''; });

            window.open(waBase + '?text=' + encodeURIComponent(lines.join('\n')), '_blank');
        });
    })();
</script>
@endif
@endpush
