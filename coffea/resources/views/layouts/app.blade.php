<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Online Lu')</title>
    <!-- Kita pakai font dasar aja biar rapi tanpa install ribet -->
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; background: #f4f4f4; }
        .container { padding: 20px; max-width: 1200px; margin: auto; background: white; min-height: 400px; }
    </style>
</head>
<body>

    <!-- Memanggil Komponen Navbar -->
    @include('components.navbar')

    <!-- Wadah Konten Dinamis -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Memanggil Komponen Footer -->
    @include('components.footer')

</body>
</html>
