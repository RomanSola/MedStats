<header class="bg-white shadow-md border-b border-[#B4DCE2]">
  <div class="max-w-7x1 mx-auto px-3 py-0 flex flex-col md:flex-row items-center justify-between gap-4">

    <!-- Centro: logos + título y subtítulo -->
    <div class="flex items-center justify-center gap-2 md:gap-3 flex-wrap">

      <img src="{{ asset('assets/img/logo-san-felipe.png') }}" alt="Hospital San Felipe" class="h-16 w-auto">
      <div class="text-center">
        <h1 class="text-4xl md:text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md tracking-widest whitespace-nowrap">
          Hospital San Felipe 
        </h1>
        <p class="text-[10px] text-[#4B6C73] tracking-wider uppercase mt-0 ">
          Sistema de Gestión Institucional
        </p>
      </div>

      
    </div>
    <!-- Acciones del usuario -->
    <div class="flex items-center gap-3 flex-shrink-0">
      <!-- Usuario -->
      <div class="hidden md:flex items-center gap-2 text-sm text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#1B7D8F]" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M5.121 17.804A9 9 0 1118.88 6.195A9 9 0 015.12 17.804z" />
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        @lang('Usuario Conectado')
      </div>

      <!-- Ajustes -->
      <a href="{{ route('ajustes') }}"
        class="no-underline bg-[#1B7D8F] hover:bg-[#176d7b] text-white text-sm px-3 py-2 rounded-md shadow transition">
        ⚙️ @lang('Ajustes')
      </a>

      <!-- Menú -->
      <div class="relative">
        <button id="menuBtn"
          class="bg-[#E2F3F6] hover:bg-[#cde7ec] text-[#1B7D8F] text-sm px-4 py-2 rounded-md shadow transition flex items-center gap-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          @lang('Menú')
        </button>

        <!-- Dropdown del menú -->
        <div id="dropdownMenu"
          class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50">
          <a href="{{ route('inicio') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">@lang('Inicio')</a>
          <a href="libro_paciente.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">@lang('Libro Pacientes')</a>
          <a href="{{ route('medicamentos.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">@lang('Insumos Médicos')</a>
          <a href="{{ route('camas.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">@lang('Camas')</a>
          <a href="{{ route('estadisticas') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">@lang('Estadísticas')</a>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">@lang('Perfil de Usuario')</a>
          <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100">@lang('Cerrar Sesión')</a>
        </div>
      </div>
    </div>
  </div>
</header>