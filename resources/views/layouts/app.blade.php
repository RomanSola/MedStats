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

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
</head> 

<body> 

    @include('layouts._partials.menu')

    <div class="flex justify-start px-4 mt-3">
        <x-boton-volver />
    </div>

    @yield('contenido') 

    @include('layouts._partials.footer')

    <!-- JS de Bootstrap y Tailwind -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdn.tailwindcss.com"></script>

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

    <!-- Scripts adicionales desde las vistas -->
    @stack('scripts')

</body>
</html>


