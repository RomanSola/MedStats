<!-- Sidebar global -->
<aside id="sidebar"
    class="fixed top-16 left-0 h-[calc(100vh-8rem)] w-64 bg-white shadow-lg flex flex-col transition-all duration-300 ease-in-out z-40">

    <!-- Header del sidebar -->
    <div class="flex items-center justify-between px-4 h-16 border-b border-gray-200">
        <span id="sidebar-title" class="font-bold text-gray-700">Menú</span>
        <button id="toggleSidebar" class="p-2 rounded hover:bg-gray-200 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Botón volver -->
    @php
        $rutaActual = request()->route()->getName();

        switch ($rutaActual) {
            // Rutas que vuelven al inicio
            case 'stocks.index':
            case 'pacientes.index':
            case 'estadisticas':
            case 'camas.index':
            case 'cirugias.estadisticas':
            //case 'cirugias.index':
            case 'ajustes':
                $rutaAnterior = 'inicio';
                break;

            // Rutas que vuelven a Ajustes
            case 'usuarios.index':
            case 'medicamentos.index':
            case 'UsuarioPerfil.index':
            case 'empleados.index':
            case 'salas.index':
            case 'habitaciones.index':
            case 'quirofanos.index':
            case 'procedimientos.index':
            case 'profesion.index':
            case 'tipoAnestesias.index':
            case 'ocupacionCamas.index':
            case 'perfiles.index':
            case 'especialidades.index':
                $rutaAnterior = 'ajustes';
                break;

            //Perfiles
            case 'perfiles.create':
            case 'perfiles.edit':
                $rutaAnterior = 'perfiles.index';
                break;

            // Profesión
            case 'profesion.create':
            case 'profesion.edit':
            case 'profesion.show':
                $rutaAnterior = 'profesion.index';
                break;

            // Procedimientos
            case 'procedimientos.create':
            case 'procedimientos.edit':
            case 'procedimientos.show':
                $rutaAnterior = 'procedimientos.index';
                break;

            // Camas
            case 'camas.create':
            case 'camas.edit':
            case 'camas.show':
                $rutaAnterior = 'camas.index';
                break;

            // Empleados
            case 'empleados.create':
            case 'empleados.edit':
            case 'empleados.show':
                $rutaAnterior = 'empleados.index';
                break;

            // Stocks
            case 'stocks.create':
            case 'stocks.edit':
            case 'stocks.show':
                $rutaAnterior = 'stocks.index';
                break;

            // Tipo Anestesias
            case 'tipoAnestesias.create':
            case 'tipoAnestesias.edit':
                $rutaAnterior = 'tipoAnestesias.index';
                break;

            // Pacientes
            case 'pacientes.create':
            case 'pacientes.edit':
            case 'pacientes.show':
            case 'pacientes.asignar':
                $rutaAnterior = 'pacientes.index';
                break;

            // Ocupación de camas
            case 'ocupacionCamas.create':
            case 'ocupacionCamas.edit':
            case 'ocupacionCamas.show':
            case 'ocupacionCamas.darAlta':
                $rutaAnterior = 'ocupacionCamas.index';
                break;

            // Medicamentos
            case 'medicamentos.create':
            case 'medicamentos.edit':
                $rutaAnterior = 'medicamentos.index';
                break;

            // Usuarios
            case 'usuarios.create':
            case 'usuarios.edit':
            case 'usuarios.show':
                $rutaAnterior = 'usuarios.index';
                break;

            // Habitaciones
            case 'habitaciones.create':
            case 'habitaciones.edit':
                $rutaAnterior = 'habitaciones.index';
                break;

            // UsuarioPerfil
            case 'UsuarioPerfil.create':
            case 'UsuarioPerfil.edit':
                $rutaAnterior = 'UsuarioPerfil.index';
                break;

            // Salas
            case 'salas.create':
            case 'salas.edit':
                $rutaAnterior = 'salas.index';
                break;

            // Cirugías
            case 'cirugias.create':
            case 'cirugias.edit':
            case 'cirugias.show':
                // case 'cirugias.estadisticas':
                $rutaAnterior = 'cirugias.index';
                break;

            // Quirófanos
            case 'quirofanos.create':
            case 'quirofanos.edit':
            case 'quirofanos.show':
                $rutaAnterior = 'quirofanos.index';
                break;

            // Especialidades
            case 'especialidades.create':
            case 'especialidades.edit':
                $rutaAnterior = 'especialidades.index';
                break;

            // Por defecto
            default:
                $rutaAnterior = 'inicio';
                break;
        }
    @endphp

    <!-- Links -->
    <nav class="flex-1 px-2 py-6 space-y-2 text-gray-700 overflow-y-auto overflow-x-hidden">

        @if ($rutaActual !== 'inicio')
            <a href="{{ route($rutaAnterior) }}" title="Volver"
                class="sidebar-volver-link flex items-center gap-3 p-3 rounded-md hover:bg-[#1B7D8F] hover:text-white transition text-decoration-none text-gray-700 group">
                <img src="{{ asset('assets/img/volver.png') }}"
                    class="h-5 w-5 text-gray-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="sidebar-volver-label">Volver</span>
            </a>
        @endif

        <a href="{{ route('stocks.index') }}" title="Insumos"
            class="flex items-center gap-3 p-3 rounded-md hover:bg-[#1B7D8F] hover:text-white transition text-decoration-none">
            <img src="{{ asset('assets/img/insumos.png') }}" class="h-6 w-6 flex-shrink-0">
            <span class="link-text">Insumos</span>
        </a>
        <a href="{{ route('cirugias.estadisticas') }}" title="Estadísticas"
            class="flex items-center gap-3 p-3 rounded-md hover:bg-[#1B7D8F] hover:text-white transition text-decoration-none">
            <img src="{{ asset('assets/img/estadisticas.png') }}" class="h-6 w-6 flex-shrink-0">
            <span class="link-text">Estadísticas</span>
        </a>
        <a href="{{ route('pacientes.index') }}" title="Pacientes"
            class="flex items-center gap-3 p-3 rounded-md hover:bg-[#1B7D8F] hover:text-white transition text-decoration-none">
            <img src="{{ asset('assets/img/pacientes.png') }}" class="h-6 w-6 flex-shrink-0">
            <span class="link-text">Pacientes</span>
        </a>
        <a href="{{ route('camas.index') }}" title="Camas"
            class="flex items-center gap-3 p-3 rounded-md hover:bg-[#1B7D8F] hover:text-white transition text-decoration-none">
            <img src="{{ asset('assets/img/camas.png') }}" class="h-6 w-6 flex-shrink-0">
            <span class="link-text">Camas</span>
        </a>
        <a href="{{ route('cirugias.index') }}" title="Cirugias"
            class="flex items-center gap-3 p-3 rounded-md hover:bg-[#1B7D8F] hover:text-white transition text-decoration-none">
            <img src="{{ asset('assets/img/cirugias.png') }}" class="h-6 w-6 flex-shrink-0">
            <span class="link-text">Cirugías</span>
        </a>

        <!-- Ajustes -->
        <a href="{{ route('ajustes') }}" title="Ajustes"
            class="flex items-center gap-3 p-3 rounded-md hover:bg-[#1B7D8F] hover:text-white transition text-decoration-none">
            <img src="{{ asset('assets/img/ajustes.png') }}" class="h-6 w-6 flex-shrink-0">
            <span class="link-text">Ajustes</span>
        </a>

        <!-- cerrar sesión-->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 p-3 rounded-md hover:bg-[#1B7D8F] hover:text-white transition text-left text-decoration-none">
                <img src="{{ asset('assets/img/salir.jpeg') }}" alt="cerrar sesión" class="h-6 w-6 flex-shrink-0">
                <span class="link-text">Cerrar Sesión</span>
            </button>
        </form>


    </nav>

</aside>

<style>
    /* Ocultar texto del botón volver cuando el sidebar está colapsado */
    #sidebar.collapsed .sidebar-volver-label {
        display: none;
    }

    /* Centrar ícono al colapsar */
    #sidebar.collapsed .sidebar-volver-link {
        justify-content: center;
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }

    /* Cuando el sidebar está expandido, alinear texto e ícono igual que otros links */
    #sidebar:not(.collapsed) .sidebar-volver-link {
        justify-content: flex-start;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    /* Asegurar que el texto "Volver" esté visible cuando está expandido */
    #sidebar:not(.collapsed) .sidebar-volver-label {
        display: inline;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');

        function actualizarEstadoSidebar() {
            if (sidebar.classList.contains('w-64')) {
                sidebar.classList.remove('sidebar-colapsado');
                sidebar.classList.add('sidebar-expandido');
                sidebar.classList.remove('collapsed'); // para el CSS de arriba
            } else {
                sidebar.classList.remove('sidebar-expandido');
                sidebar.classList.add('sidebar-colapsado');
                sidebar.classList.add('collapsed'); // para el CSS de arriba
            }
        }

        // Ejecutar al cargar
        actualizarEstadoSidebar();

        // Ejecutar al hacer clic en el botón de colapsar
        toggleBtn.addEventListener('click', function() {
            setTimeout(actualizarEstadoSidebar, 300); // esperar transición
        });
    });
</script>
