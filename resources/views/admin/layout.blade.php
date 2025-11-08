<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Agrowisata</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <header>
        @include('admin.header')
    </header>

    <div class="container">
        <aside>
            @include('admin.sidebar')
        </aside>

        <main>
            @yield('content')
        </main>
    </div>

    <footer>
        @include('admin.footer')
    </footer>
</body>
</html>
