 <header class="bg-green-100 bg-opacity-90 shadow-md py-6 px-6 flex items-center justify-between">
    <!-- Izquierda: Usuario -->
    <button class="flex items-center gap-2 text-green-900 text-sm font-medium hover:text-green-700 transition">
      <!-- Icono usuario -->
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1118.88 6.195 9 9 0 015.12 17.804z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
      </svg>
      Usuario Conectado
    </button>

    <!-- Centro logo -->
    <div class="flex justify-center flex-grow">
      <h1 class="text-4xl font-extrabold text-green-800 select-none">Medical Stats</h1>
    </div>

    <!-- Derecha: Menú -->
    <div class="relative inline-block text-left">
      <button id="menuBtn" class="flex items-center gap-2 bg-green-600 text-white px-4 py-1 rounded-md hover:bg-green-700 transition">
        <!-- Icono menú (hamburguesa) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        MENÚ
      </button>
      <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-green-200 rounded-md shadow-lg z-50">
        <a href="#" class="block px-4 py-2 text-sm text-green-900 hover:bg-green-100">Inicio</a>
        <a href="libro_paciente.php" class="block px-4 py-2 text-sm text-green-900 hover:bg-green-100">Libro Pacientes</a>
        <a href="#" class="block px-4 py-2 text-sm text-green-900 hover:bg-green-100">Insumos Médicos</a>
        <a href="#" class="block px-4 py-2 text-sm text-green-900 hover:bg-green-100">Estadísticas</a>
        <a href="#" class="block px-4 py-2 text-sm text-green-900 hover:bg-green-100">Configuraciones</a>
        <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100">Cerrar Sesión</a>
      </div>
    </div>
  </header>