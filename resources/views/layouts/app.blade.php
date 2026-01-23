<!DOCTYPE html>
<html>
<head>
    <title>Aspirasi Sekolah</title>
</head>
<body>
    <h1>Aspirasi Sekolah</h1>
    <hr>
    <nav style="display: flex; align-items: center; gap: 10px;">
        <a href="{{ route('aspirasi.index') }}">Home</a> |
        <a href="{{ route('aspirasi.create') }}">Buat Aspirasi</a> |
        <p style="margin: 0;">Hai, {{ auth()->user()->name }}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>
    <hr>
    <h2>{{ ($title) }}</h2>
    @yield('content')
</body>
</html>