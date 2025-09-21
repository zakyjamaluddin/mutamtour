<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Mutamtour</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Welcome to Mutamtour</h1>
        <p>Aplikasi berbasis Laravel Filament untuk pencatatan data jamaah umroh.</p>
        <p>Kelola data jamaah, pembayaran, paket umroh, dan keberangkatan umroh secara online.</p>
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    </div>
</body>
</html>