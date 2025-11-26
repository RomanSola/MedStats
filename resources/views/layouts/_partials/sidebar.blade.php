<!-- Sidebar global -->
<aside id="sidebar"
    class="fixed top-16 left-0 h-[calc(100vh-4rem)] w-20 bg-white shadow-xl flex flex-col transition-all duration-300 ease-in-out z-40 border-r border-gray-100 sidebar-colapsado collapsed">

    <!-- Header del sidebar -->
    <div class="flex items-center justify-between px-4 h-16 border-b border-gray-100 shrink-0">
        <span id="sidebar-title" class="font-bold text-[#1B7D8F] text-lg hidden whitespace-nowrap overflow-hidden transition-all duration-300">Menú</span>
        <button id="toggleSidebar" class="p-2 rounded-lg hover:bg-gray-50 text-gray-500 hover:text-[#1B7D8F] focus:outline-none transition-colors mx-auto">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </div>

    <!-- Contenido Scrollable -->
    <div class="flex-1 overflow-y-auto py-4 space-y-1 px-3 custom-scrollbar">

        <!-- Botón volver -->
        @php
            $rutaActual = request()->route() ? request()->route()->getName() : '';
            $rutaAnterior = 'inicio'; // Default

            // Lógica simplificada de rutas (puedes expandir esto según tu lógica original si es necesario)
            // Aquí mantenemos la lógica original pero resumida para el ejemplo, asegurando que funcione.
            // ... (Tu lógica PHP original de switch case iría aquí si es compleja, 
            // pero para limpieza visual en este ejemplo asumimos que ya tienes la variable $rutaAnterior calculada correctamente
            // o usamos la lógica anterior).
            
            // Copiamos la lógica original para no romper nada:
            switch ($rutaActual) {
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
                case 'camas.listar':
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
                    $rutaAnterior = 'camas.listar';
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
                    // Si la URL anterior es pacientes, volver a pacientes.index, si no volver a persona.ver
                    if (url()->previous() && str_contains(url()->previous(), route('pacientes.index'))) {
                        $rutaAnterior = 'pacientes.index';
                    } else {
                        // Obtener el id del paciente desde la ruta actual
                        $id = request()->route('id') ?? request()->route('paciente') ?? null;
                        if ($id) {
                            $rutaAnterior = ['persona.ver', ['id' => $id]];
                        } else {
                            $rutaAnterior = 'pacientes.index';
                        }
                    }
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
            // NOTA: Para brevedad del snippet, asegúrate de que la lógica PHP completa esté presente si hay casos específicos críticos.
            // He incluido los principales.
        @endphp

        @if ($rutaActual !== 'inicio')
            <a href="{{ is_array($rutaAnterior) ? route($rutaAnterior[0], $rutaAnterior[1]) : route($rutaAnterior) }}" 
               class="flex items-center gap-3 p-3 rounded-xl text-gray-600 hover:bg-gray-50 hover:text-[#1B7D8F] transition-all group relative overflow-hidden"
               title="Volver">
                <i data-lucide="arrow-left" class="w-6 h-6 flex-shrink-0 transition-transform group-hover:-translate-x-1"></i>
                <span class="link-text font-medium whitespace-nowrap hidden opacity-0 transition-opacity duration-300">Volver</span>
                
                <!-- Tooltip para modo colapsado -->
                <div class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity z-50 whitespace-nowrap md:hidden">
                    Volver
                </div>
            </a>
            <div class="my-2 border-t border-gray-100 mx-2"></div>
        @endif

        <!-- Links Principales -->
        @php
            $menuItems = [
                ['route' => 'stocks.index', 'title' => 'Insumos', 'icon' => 'package', 'access' => 'insumos'],
                ['route' => 'cirugias.estadisticas', 'title' => 'Estadísticas', 'icon' => 'bar-chart-2', 'access' => 'estadisticas'],
                ['route' => 'pacientes.index', 'title' => 'Pacientes', 'icon' => 'users', 'access' => 'pacientes'],
                ['route' => 'camas.index', 'title' => 'Camas', 'icon' => 'bed', 'access' => 'camas'],
                ['route' => 'cirugias.index', 'title' => 'Cirugías', 'icon' => 'activity', 'access' => 'cirugias'],
                ['route' => 'ajustes', 'title' => 'Ajustes', 'icon' => 'settings', 'access' => null], // Visible para todos
            ];
        @endphp

        @foreach($menuItems as $item)
            @if(Auth::user()->hasAccess($item['access']))
            <a href="{{ route($item['route']) }}" 
               class="flex items-center gap-3 p-3 rounded-xl transition-all group relative overflow-hidden
                      {{ request()->routeIs($item['route']) ? 'bg-[#1B7D8F]/10 text-[#1B7D8F]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#1B7D8F]' }}"
               title="{{ $item['title'] }}">
                <i data-lucide="{{ $item['icon'] }}" class="w-6 h-6 flex-shrink-0"></i>
                <span class="link-text font-medium whitespace-nowrap hidden opacity-0 transition-opacity duration-300">{{ $item['title'] }}</span>
            </a>
            @endif
        @endforeach

    </div>

    <!-- Footer del Sidebar (Logout) -->
    <div class="p-3 border-t border-gray-100 shrink-0">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 p-3 rounded-xl text-red-500 hover:bg-red-50 transition-all group relative overflow-hidden"
                title="Cerrar Sesión">
                <i data-lucide="log-out" class="w-6 h-6 flex-shrink-0"></i>
                <span class="link-text font-medium whitespace-nowrap hidden opacity-0 transition-opacity duration-300">Cerrar Sesión</span>
            </button>
        </form>
    </div>

</aside>

<style>
    /* Estilos para el scrollbar personalizado */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #e5e7eb;
        border-radius: 20px;
    }
    .custom-scrollbar:hover::-webkit-scrollbar-thumb {
        background-color: #d1d5db;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (window.lucide) lucide.createIcons();
        
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        const linkTexts = document.querySelectorAll('.link-text');
        const sidebarTitle = document.getElementById('sidebar-title');
        const mainContent = document.getElementById('mainContent'); // Asegúrate de que este ID exista en tu layout

        // Función para aplicar estado visual
        function setSidebarState(expanded) {
            const footer = document.getElementById('footer');
            
            if (expanded) {
                sidebar.classList.remove('w-20', 'sidebar-colapsado', 'collapsed');
                sidebar.classList.add('w-64', 'sidebar-expandido');
                
                linkTexts.forEach(el => {
                    el.classList.remove('hidden');
                    setTimeout(() => el.classList.remove('opacity-0'), 50);
                });
                
                if(sidebarTitle) {
                    sidebarTitle.classList.remove('hidden');
                    setTimeout(() => sidebarTitle.classList.remove('opacity-0'), 50);
                }

                if(mainContent) {
                    mainContent.style.marginLeft = "16rem";
                    mainContent.style.transform = "scale(0.98)";
                }
                
                if(footer) {
                    footer.style.marginLeft = "16rem";
                    footer.style.width = "calc(100% - 16rem)";
                    footer.style.transition = "all 0.3s ease-in-out";
                }

            } else {
                sidebar.classList.remove('w-64', 'sidebar-expandido');
                sidebar.classList.add('w-20', 'sidebar-colapsado', 'collapsed');
                
                linkTexts.forEach(el => {
                    el.classList.add('opacity-0');
                    el.classList.add('hidden');
                });

                if(sidebarTitle) {
                    sidebarTitle.classList.add('hidden');
                }

                if(mainContent) {
                    mainContent.style.marginLeft = "5rem";
                    mainContent.style.transform = "scale(1)";
                }
                
                if(footer) {
                    footer.style.marginLeft = "5rem";
                    footer.style.width = "calc(100% - 5rem)";
                    footer.style.transition = "all 0.3s ease-in-out";
                }
            }
        }

        // Inicialización: Por defecto COLAPSADO (false)
        // Si quieres persistencia, descomenta las líneas de localStorage, pero invirtiendo la lógica para que default sea false
        const storedState = localStorage.getItem('sidebar-expanded');
        const isExpanded = storedState === 'true'; // Default false si es null
        
        setSidebarState(isExpanded);

        toggleBtn.addEventListener('click', function() {
            const isCurrentlyExpanded = sidebar.classList.contains('w-64');
            const newState = !isCurrentlyExpanded;
            
            setSidebarState(newState);
            localStorage.setItem('sidebar-expanded', newState);
        });
    });
</script>
