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

    <!-- Links -->
    <nav class="flex-1 px-2 py-6 space-y-2 text-gray-700 overflow-y-auto overflow-x-hidden">
        <a href="{{ route('stocks.index') }}"
            class="flex items-center gap-3 p-3 rounded-md hover:bg-[#1B7D8F] hover:text-white transition">
            <img src="{{ asset('assets/img/insumos.jpeg') }}" class="h-6 w-6 flex-shrink-0">
            <span class="link-text">Insumos</span>
        </a>
        <a href="{{ route('cirugias.estadisticas') }}"
            class="flex items-center gap-3 p-3 rounded-md hover:bg-[#1B7D8F] hover:text-white transition">
            <img src="{{ asset('assets/img/estadisticas.jpeg') }}" class="h-6 w-6 flex-shrink-0">
            <span class="link-text">Estadísticas</span>
        </a>
        <a href="{{ route('pacientes.index') }}"
            class="flex items-center gap-3 p-3 rounded-md hover:bg-[#1B7D8F] hover:text-white transition">
            <img src="{{ asset('assets/img/pacientes.jpeg') }}" class="h-6 w-6 flex-shrink-0">
            <span class="link-text">Pacientes</span>
        </a>
        <a href="{{ route('camas.index') }}"
            class="flex items-center gap-3 p-3 rounded-md hover:bg-[#1B7D8F] hover:text-white transition">
            <img src="{{ asset('assets/img/camas.jpeg') }}" class="h-6 w-6 flex-shrink-0">
            <span class="link-text">Camas</span>
        </a>
        <a href="{{ route('cirugias.index') }}"
            class="flex items-center gap-3 p-3 rounded-md hover:bg-[#1B7D8F] hover:text-white transition">
            <img src="{{ asset('assets/img/cirugias.jpeg') }}" class="h-6 w-6 flex-shrink-0">
            <span class="link-text">Cirugías</span>
        </a>
    </nav>

</aside>


<!-- Script para colapsar/expandir el sidebar-->

