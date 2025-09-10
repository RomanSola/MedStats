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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>

<body class="flex flex-col min-h-screen">
    @include('layouts._partials.menu')

    <div class="flex justify-start px-4 mt-3">
        {{-- Solo mostramos "Volver" si NO estamos en la ruta 'inicio' --}}
        @unless (request()->routeIs('inicio'))
            <button type="button" onclick="history.back()"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded">
                ← Volver
            </button>
        @endunless
    </div>

    <main class="flex-1">
        @yield('contenido')
        <div class="container mt-2">

            @php
                $rutaActual = request()->route()->getName();

                switch ($rutaActual) {
                    //Todos los que deben volver al inicio
                    case 'stocks.index':
                    case 'pacientes.index':
                    case 'estadisticas':
                    case 'camas.index':
                    //case 'cirugias.index':
                    case 'ajustes':
                        $rutaAnterior = 'inicio';
                        break;

                    //Todos los que deben volver a Ajustes
                    case 'usuarios.index':
                    case 'empleados.index':
                    case 'medicamentos.index':
                    case 'cirugias.index':
                    case 'habitaciones.index':
                    case 'quirofanos.index':
                    case 'camas.index':
                    case 'procedimientos.index':
                    case 'profesion.index':
                    case 'tipoAnestesias.index':
                    case 'ocupacionCamas.index':
                    case 'UsuarioPerfil.index':
                    case 'salas.index':
                        $rutaAnterior = 'ajustes';
                        break;

                    case 'profesion.create':
                    case 'profesion.edit':
                    case 'profesion.show':
                        $rutaAnterior = 'profesion.index';
                        break;

                    case 'procedimientos.create':
                    case 'procedimientos.edit':
                    case 'procedimientos.show':
                        $rutaAnterior = 'procedimientos.index';
                        break;

                    case 'camas.create':
                    case 'camas.edit':
                    case 'camas.show':
                        $rutaAnterior = 'camas.index';
                        break;

                    case 'empleados.create':
                    case 'empleados.edit':
                    case 'empleados.show':
                        $rutaAnterior = 'empleados.index';
                        break;

                    case 'stocks.create':
                    case 'stocks.edit':
                    case 'stocks.show':
                        $rutaAnterior = 'stocks.index';
                        break;

                    case 'tipoAnestesias.create':
                    case 'tipoAnestesias.edit':
                        $rutaAnterior = 'tipoAnestesias.index';
                        break;

                    case 'profesion.create':
                    case 'profesion.edit':
                    case 'profesion.show':
                        $rutaAnterior = 'profesion.index';
                        break;

                    case 'pacientes.create':
                    case 'pacientes.edit':
                    case 'pacientes.show':
                        $rutaAnterior = 'pacientes.index';
                        break;

                    case 'ocupacionCamas.create':
                    case 'ocupacionCamas.edit':
                    case 'ocupacionCamas.show':
                    case 'ocupacionCamas.darAlta':
                        $rutaAnterior = 'ocupacionCamas.index';
                        break;

                    case 'medicamentos.create':
                    case 'medicamentos.edit':
                        $rutaAnterior = 'medicamentos.index';
                        break;

                    case 'procedimientos.create':
                    case 'procedimientos.edit':
                    case 'procedimientos.show':
                        $rutaAnterior = 'procedimientos.index';
                        break;

                    case 'habitaciones.create':
                    case 'habitaciones.edit':
                        $rutaAnterior = 'habitaciones.index';
                        break;

                    case 'UsuarioPerfil.create':
                    case 'UsuarioPerfil.edit':
                        $rutaAnterior = 'UsuarioPerfil.index';
                        break;

                    case 'salas.create':
                    case 'salas.edit':
                        $rutaAnterior = 'salas.index';
                        break;

                    case 'cirugias.create':
                    case 'cirugias.edit':
                    case 'cirugias.show':
                    case 'cirugias.estadisticas':
                        $rutaAnterior = 'cirugias.index';
                        break;

                    case 'quirofanos.create':
                    case 'quirofanos.edit':
                    case 'quirofanos.show':
                        $rutaAnterior = 'quirofanos.index';
                        break;

                    // Por default vuelve al inicio
                    default:
                        $rutaAnterior = 'inicio';
                        break;
                }
            @endphp

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
        </div>

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
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- Lucide Iconos -->
    <script>
        if (window.lucide) {
            lucide.createIcons();
        } else {
            console.error('Lucide no se cargó correctamente');
        }
    </script>

    
    <script>
      window.addEventListener('scroll', () => {
        const footer = document.querySelector('footer');
        const boton = document.querySelector('.boton-volver');
        if (!footer || !boton) return;

        const footerRect = footer.getBoundingClientRect();
        const windowHeight = window.innerHeight;

        if (footerRect.top < windowHeight) {
          const overlap = windowHeight - footerRect.top;
          boton.style.bottom = (20 + overlap) + 'px';
        } else {
          boton.style.bottom = '20px';
        }
      });
    </script>

    <!-- Script del botón menú -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const menuBtn = document.getElementById("menuBtn");
            const dropdownMenu = document.getElementById("dropdownMenu");

            if (menuBtn && dropdownMenu) {
                menuBtn.addEventListener("click", function() {
                    dropdownMenu.classList.toggle("hidden");
                });
            }
        });
    </script>


    <!-- Scripts adicionales desde las vistas -->
    @stack('scripts')
</body>
</html>