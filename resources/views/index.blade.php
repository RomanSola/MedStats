@extends('layouts.app')
@section('titulo','inicio')
@section('contenido')


<!-- Formulario estilizado con funcionalidad autocomplete -->
<div class="w-full flex justify-center mt-6">
  <form action="{{ route('buscar') }}" method="GET"
    class="flex items-center justify-center gap-2 w-full max-w-5xl px-6">

    <input
      type="text"
      id="busqueda"
      autocomplete="off"
      name="busqueda"
      placeholder="Buscar paciente por nombre, apellido o DNI"
      class="flex-grow border border-[#B4DCE2] rounded-md px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-[#1B7D8F]">

    <button
      type="submit"
      class="bg-[#1B7D8F] hover:bg-[#176d7b] text-white text-base px-5 py-3 rounded-md shadow transition whitespace-nowrap">
      🔍 Buscar
    </button>
  </form>
</div>

<!-- jQuery completo -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<!-- Script autocomplete -->
<script>
  $(function() {
    $("#busqueda").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: "{{ route('buscar.ajax') }}",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function(data) {
            response($.map(data, function(item) {
              return {
                label: item.nombre + " " + item.apellido + " (DNI: " + item.dni + ")",
                value: item.nombre+item.apellido,
                id: item.id
              };
            }));
          }
        });
      },
      minLength: 2,
      select: function(event, ui) {
        window.location.href = "/persona/" + ui.item.id;
      }
    });
  });
</script>


<div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-8 bg-gray-100 min-h-screen">


  <!-- CARD 1: Insumos -->
  <a href="{{ route('stocks.index') }}" class="flex h-52 rounded-2xl overflow-hidden transform hover:scale-[1.02]  transition duration-300 bg-white text-decoration-none">

    <div class="w-1/2 p-6 flex flex-col justify-between">
      <div>
        <h2 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2">
          <img src="{{ asset('assets/img/logo-san-felipe.png') }}" alt="Hospital San Felipe" class="w-6 h-6">
          Insumos
        </h2>

        <p class="text-gray-500 mt-2 text-sm">Gestión de insumos médicos y material hospitalario.</p>
      </div>
      <span class="text-blue-600 font-semibold mt-4">Ver más →</span>
    </div>
    <div class="w-1/2 h-full">
      <img src="{{ asset('assets/img/card_insumos.jpg') }}" alt="Insumos" class="w-full h-full object-cover">
    </div>
  </a>

  <!-- CARD 2: Estadísticas -->
  <a href="{{ route('cirugias.estadisticas') }}" class="flex h-52 rounded-2xl overflow-hidden transform hover:scale-[1.02]  transition duration-300 bg-white text-decoration-none">
    <div class="w-1/2 p-6 flex flex-col justify-between">
      <div>
        <h2 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2">
          <img src="{{ asset('assets/img/logo-san-felipe.png') }}" alt="Hospital San Felipe" class="w-6 h-6">Estadísticas
        </h2>
        <p class="text-gray-500 mt-2 text-sm">Informes visuales y análisis de datos médicos.</p>
      </div>
      <span class="text-blue-600 font-semibold mt-4">Ver más →</span>
    </div>
    <div class="w-1/2 h-full">
      <img src="{{ asset('assets/img/card_estadisticas.jpg') }}" alt="Estadísticas" class="w-full h-full object-cover">
    </div>
  </a>

  <!-- CARD 3: Pacientes -->
  <a href="/pacientes" class="flex h-52 rounded-2xl overflow-hidden transform hover:scale-[1.02]  transition duration-300 bg-white text-decoration-none">
    <div class="w-1/2 p-6 flex flex-col justify-between">
      <div>
        <h2 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2">
          <img src="{{ asset('assets/img/logo-san-felipe.png') }}" alt="Hospital San Felipe" class="w-6 h-6">Pacientes
        </h2>
        <p class="text-gray-500 mt-2 text-sm">Registro, historial clínico y seguimiento.</p>
      </div>
      <span class="text-blue-600 font-semibold mt-4">Ver más →</span>
    </div>
    <div class="w-1/2 h-full">
      <img src="{{ asset('assets/img/card_pacientes.jpg') }}" alt="Pacientes" class="w-full h-full object-cover">
    </div>
  </a>

  <!-- CARD 4: Camas -->
  <a href="/camas" class="flex h-52 rounded-2xl overflow-hidden transform hover:scale-[1.02]  transition duration-300 bg-white text-decoration-none">
    <div class="w-1/2 p-6 flex flex-col justify-between">
      <div>
        <h2 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2">
          <img src="{{ asset('assets/img/logo-san-felipe.png') }}" alt="Hospital San Felipe" class="w-6 h-6">Camas
        </h2>
        <p class="text-gray-500 mt-2 text-sm">Asignación, estado y control de camas.</p>
      </div>
      <span class="text-blue-600 font-semibold mt-4">Ver más →</span>
    </div>
    <div class="w-1/2 h-full">
      <img src="{{ asset('assets/img/gestion_camas.jpg') }}" alt="Camas" class="w-full h-full object-cover">
    </div>
  </a>

    <!-- CARD 5: Libro de cirugias -->
  <a href="/cirugias" class="flex h-52 rounded-2xl overflow-hidden transform hover:scale-[1.02]  transition duration-300 bg-white text-decoration-none">
    <div class="w-1/2 p-6 flex flex-col justify-between">
      <div>
        <h2 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2">
          <img src="{{ asset('assets/img/logo-san-felipe.png') }}" alt="Hospital San Felipe" class="w-6 h-6">Libro de cirugías</h2>
        <p class="text-gray-500 mt-2 text-sm">Registro de cirugias realizadas en quirófano</p>
      </div>
      <span class="text-blue-600 font-semibold mt-4">Ver más →</span>
    </div>
    <div class="w-1/2 h-full">
      <img src="{{ asset('assets/img/libro_cirugias.jpeg') }}" alt="Cirugias" class="w-full h-full object-cover">
    </div>
  </a>

</div>

@endsection
