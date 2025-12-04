<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Estadísticas')</title>

    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Tailwind (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Archivo CSS opcional específico para estadísticas -->
    <link rel="stylesheet" href="{{ asset('assets/css/estadisticas.css') }}">

    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>


        body {
            background-color: #e6f4f3;
            color: #1a1a1a;
            font-family: 'Poppins', sans-serif;
        }

        main {
            padding-top: 5rem;
            padding-bottom: 3rem;
        }

        .card {
            border-radius: 0.75rem;
        }

        /* Pequeñas adaptaciones visuales para mantener look & feel */
        .bg-info { background-image: none; }
    </style>
</head>

<body class="bg-[#e6f4f3] text-gray-900">
    @include('layouts._partials.menu')

    <div class="flex min-h-screen"> <!-- Contenedor para sidebar + contenido -->
        @include('layouts._partials.sidebar') <!-- Tu sidebar expandible -->


        <!--<main class="flex-1 p-8 pb-20 transition-all duration-300 ease-in-out">

    <div class="max-w-full mx-auto">-->

        <main id="mainContent" class="flex-1 pt-20 px-8 pb-20 transition-all duration-300 ease-in-out transform">
            <div class="max-w-full mx-auto">

                @yield('contenido')
                {{-- <div class="container mt-2">
            @if ($rutaActual !== 'inicio')
                <div class="boton-volver mt-3" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
                    <a href="{{ route($rutaAnterior) }}"
                        class="d-flex justify-content-center align-items-center rounded-circle bg-secondary text-white shadow-lg"
                        style="width: 48px; height: 48px; transition: all 0.3s;"
                        onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                        </svg>
                    </a>
                </div>
            @endif

            <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
        </div> --}}
            </div>
        </main>
    </div>


    @include('components.boton-volver')
    @include('layouts._partials.footer')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- Chart.js y AOS los cargamos solo cuando la vista los necesita (pero pueden estar aquí) -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        if (window.lucide) lucide.createIcons();
        if (window.AOS) AOS.init();
    </script>

    <script>

    </script>



    @stack('scripts')
    @stack('modales')
</body>

</html>
