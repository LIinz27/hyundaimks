<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Halaman tidak tersedia') — Hyundai Makassar</title>

    {{-- Halaman error HARUS mandiri: tanpa header/footer, karena keduanya
         membutuhkan konteks sales yang justru tidak ada di sini. --}}
    @vite(['resources/css/app.css'])
</head>
<body class="error-page">
    @yield('content')
</body>
</html>
