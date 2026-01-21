<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspirasi Sekolah</title>
</head>
<body>
    <header>
        <h1>Aspirasi Sekolah</h1>
    </header>

    <main>
        <h2>{{ $title}}</h2>
        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>

        @elseif ($errors->any())
            <ul style="color: red;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @yield('content')
    </main>
</body>
</html>