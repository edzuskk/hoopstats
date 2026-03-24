<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HoopStats🏀</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    {{-- Navigācija --}}
    <x-navigation />
    {{-- Saturs --}}
    <main class="page-container">
        {{ $slot }}
    </main>
</body>
</html>