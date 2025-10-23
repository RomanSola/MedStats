<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inicio</title>

    <!-- Preload del CSS antes de cargar todo -->
    <link rel="preload" as="style" href="{{ Vite::asset('resources/css/app.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-[#f8fafc] transition-all duration-500">
    <div class="relative min-h-screen flex items-center justify-center p-4 bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('assets/img/hospital.png') }}');">

        <div class="absolute inset-0 bg-white/55"></div>

        <div class="relative z-10 flex flex-col items-center justify-center w-full sm:max-w-md px-8 py-6 bg-white shadow-lg rounded-2xl">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
