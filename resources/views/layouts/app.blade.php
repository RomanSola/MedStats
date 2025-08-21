<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>


    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
</head>

<body class="flex flex-col min-h-screen">

    @include('layouts._partials.menu')

    <div class="flex justify-start px-4 mt-3">
        @if (url()->previous() !== url()->current())
            <a href="{{ url()->previous() }}" 
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded">
                ← Volver
            </a>
        @endif
    </div>

    <main class="flex-1">
        @yield('contenido')
    </main>

    @include('layouts._partials.footer')

    <!-- jQuery (solo una vez) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI JS -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tailwind (si lo usás con CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Lucide Iconos -->
    <script>
        if (window.lucide) {
            lucide.createIcons();
        } else {
            console.error('Lucide no se cargó correctamente');
        }
    </script>

    <!-- Script del botón menú -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const menuBtn = document.getElementById("menuBtn");
            const dropdownMenu = document.getElementById("dropdownMenu");

            if (menuBtn && dropdownMenu) {
                menuBtn.addEventListener("click", function () {
                    dropdownMenu.classList.toggle("hidden");
                });
            }
        });
    </script>

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Scripts adicionales desde las vistas -->
    @stack('scripts')

</body>
<<<<<<< HEAD
</html>
=======
</html>

>>>>>>> parent of 62bd9fa (Cambios volver)
