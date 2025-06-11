@extends('layouts.app')
@section('titulo','inicio')
@section('contenido')

  <main class="max-w-7xl mx-auto px-6 py-8">
    <!-- Buscador -->
    <div class="mb-8 flex justify-center">
      <input
        type="text"
        placeholder="Buscar paciente"
        class="w-full md:w-1/2 border border-green-300 rounded-full py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500"
      />
    </div>

    <!-- Tarjetas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
      <a href="libro_paciente.php"
         class="bg-white rounded-xl shadow-md p-6 max-w-xs mx-auto transform transition hover:scale-105 duration-300">
        <img src="{{ asset ('assets/img/card_pacientes.jpg') }}" alt="Libro Pacientes" class="rounded-md mb-4 w-full h-40 object-cover" />
        <h2 class="text-xl font-semibold text-green-800 text-center">LIBRO PACIENTES</h2>
      </a>

      <a href="#"
         class="bg-white rounded-xl shadow-md p-6 max-w-xs mx-auto transform transition hover:scale-105 duration-300">
        <img src="{{ asset ('assets/img/card_insumos.jpg') }}" alt="Insumos Médicos" class="rounded-md mb-4 w-full h-40 object-cover" />
        <h2 class="text-xl font-semibold text-green-800 text-center">INSUMOS MÉDICOS</h2>
      </a>

            <a href="gestion_cama.php"
         class="bg-white rounded-xl shadow-md p-6 max-w-xs mx-auto transform transition hover:scale-105 duration-300">
        <img src="{{ asset ('assets/img/gestion_camas.jpg') }}" alt="Gestion Camas" class="rounded-md mb-4 w-full h-40 object-cover" />
        <h2 class="text-xl font-semibold text-green-800 text-center">GESTIÓN CAMAS</h2>
      </a>

      <a href="#"
         class="bg-white rounded-xl shadow-md p-6 max-w-xs mx-auto transform transition hover:scale-105 duration-300">
        <img src="{{ asset ('assets/img/card_estadisticas.jpg') }}" alt="Estadísticas" class="rounded-md mb-4 w-full h-40 object-cover" />
        <h2 class="text-xl font-semibold text-green-800 text-center">ESTADÍSTICAS</h2>
      </a>
    </div>
  </main>







@endsection

