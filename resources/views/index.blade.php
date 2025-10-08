@extends('layouts.app')
@section('titulo', 'Inicio')
@section('contenido')

    <div class="flex min-h-screen bg-gray-100 transition-all duration-300 ease-in-out">
        <!-- Main -->
        <main class="flex-1 p-1 max-w-full">
            <!-- Header con búsqueda -->
            <header class="flex justify-center mb-8 mt-16">
                <form action="{{ route('buscar') }}" method="GET" class="relative w-full max-w-3xl">
                    <input type="text" id="busqueda" name="busqueda" autocomplete="off"
                        placeholder="Buscar paciente por nombre, apellido o DNI"
                        class="w-full rounded-l-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1B7D8F] transition" />
                    <button type="submit"
                        class="absolute right-0 top-0 bottom-0 px-6 bg-[#1B7D8F] hover:bg-[#176d7b] text-white rounded-r-md transition"
                        aria-label="Buscar">
                        🔍
                    </button>
                </form>
            </header>


            <!-- jQuery y autocomplete -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
            <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
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
                                            label: item.nombre + " " + item.apellido +
                                                " (DNI: " + item.dni + ")",
                                            value: item.nombre + item.apellido,
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

            <!-- KPIs rápidos -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

                <!-- Pacientes activos -->
                <div class="bg-white rounded-xl p-6 flex items-center gap-4 shadow-sm">
                    <div class="p-2 bg-[#2BA8A0]/20 rounded flex items-center justify-center">
                        <img src="{{ asset('assets/img/pacientes.png') }}" alt="Pacientes"
                            class="h-10 w-10 object-cover rounded border border-white/10" />
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Pacientes en cama</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $pacientes }}</p>
                    </div>
                </div>

                <!-- Camas ocupadas -->
                <div class="bg-white rounded-xl p-6 flex items-center gap-4 shadow-sm">
                    <div class="p-2 bg-[#245360]/20 rounded flex items-center justify-center">
                        <img src="{{ asset('assets/img/camas.png') }}" alt="Camas"
                            class="h-10 w-10 object-cover rounded border border-white/10" />
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Camas ocupadas</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $porcentajeCamas }}%</p>
                    </div>
                </div>

                <!-- Cirugías realizadas -->
                <div class="bg-white rounded-xl p-6 flex items-center gap-4 shadow-sm">
                    <div class="p-2 bg-[#2BA8A0]/20 rounded flex items-center justify-center">
                        <img src="{{ asset('assets/img/cirugias.png') }}" alt="Cirugías"
                            class="h-10 w-10 object-cover rounded border border-white/10" />
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Cirugías realizadas en el año</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $cantCirugias }}</p>
                    </div>
                </div>

            </section>


            <!-- Cards principales -->

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-8 bg-gray-100 min-h-screen">

                <!-- CARD 1: Insumos -->
                <a href="{{ route('stocks.index') }}"
                    class="flex rounded-2xl overflow-hidden transform hover:scale-[1.02] transition duration-300 bg-white text-decoration-none h-40">
                    <div class="w-1/2 p-6 flex flex-col justify-between">
                        <div>
                            <h2
                                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2">
                                <img src="{{ asset('assets/img/logo-san-felipe.png') }}" alt="Hospital San Felipe"
                                    class="w-6 h-6">
                                Insumos
                            </h2>
                            <p class="text-gray-500 mt-2 text-sm">Gestión de insumos médicos y material hospitalario.</p>
                        </div>
                        <span class="text-blue-600 font-semibold mt-4">Ver más →</span>
                    </div>
                    <div class="w-1/2 flex items-center justify-center">
                        <img src="{{ asset('assets/img/card_insumos.jpg') }}" alt="Insumos"
                            class="h-24 w-32 object-cover rounded-lg">
                    </div>
                </a>

                <!-- CARD 2: Estadísticas -->
                <a href="{{ route('cirugias.estadisticas') }}"
                    class="flex rounded-2xl overflow-hidden transform hover:scale-[1.02] transition duration-300 bg-white text-decoration-none h-40">
                    <div class="w-1/2 p-6 flex flex-col justify-between">
                        <div>
                            <h2
                                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2">
                                <img src="{{ asset('assets/img/logo-san-felipe.png') }}" alt="Hospital San Felipe"
                                    class="w-6 h-6">
                                Estadísticas
                            </h2>
                            <p class="text-gray-500 mt-2 text-sm">Informes visuales y análisis de datos médicos.</p>
                        </div>
                        <span class="text-blue-600 font-semibold mt-4">Ver más →</span>
                    </div>
                    <div class="w-1/2 flex items-center justify-center">
                        <img src="{{ asset('assets/img/card_estadisticas.jpg') }}" alt="Estadísticas"
                            class="h-24 w-32 object-cover rounded-lg">
                    </div>
                </a>

                <!-- CARD 3: Pacientes -->
                <a href="{{ route('pacientes.index') }}"
                    class="flex rounded-2xl overflow-hidden transform hover:scale-[1.02] transition duration-300 bg-white text-decoration-none h-40">
                    <div class="w-1/2 p-6 flex flex-col justify-between">
                        <div>
                            <h2
                                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2">
                                <img src="{{ asset('assets/img/logo-san-felipe.png') }}" alt="Hospital San Felipe"
                                    class="w-6 h-6">
                                Pacientes
                            </h2>
                            <p class="text-gray-500 mt-2 text-sm">Registro, historial clínico y seguimiento.</p>
                        </div>
                        <span class="text-blue-600 font-semibold mt-4">Ver más →</span>
                    </div>
                    <div class="w-1/2 flex items-center justify-center">
                        <img src="{{ asset('assets/img/card_pacientes.jpg') }}" alt="Pacientes"
                            class="h-24 w-32 object-cover rounded-lg">
                    </div>
                </a>

                <!-- CARD 4: Camas -->
                <a href="{{ route('camas.index') }}"
                    class="flex rounded-2xl overflow-hidden transform hover:scale-[1.02] transition duration-300 bg-white text-decoration-none h-40">
                    <div class="w-1/2 p-6 flex flex-col justify-between">
                        <div>
                            <h2
                                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2">
                                <img src="{{ asset('assets/img/logo-san-felipe.png') }}" alt="Hospital San Felipe"
                                    class="w-6 h-6">
                                Camas
                            </h2>
                            <p class="text-gray-500 mt-2 text-sm">Asignación, estado y control de camas.</p>
                        </div>
                        <span class="text-blue-600 font-semibold mt-4">Ver más →</span>
                    </div>
                    <div class="w-1/2 flex items-center justify-center">
                        <img src="{{ asset('assets/img/gestion_camas.jpg') }}" alt="Camas"
                            class="h-24 w-32 object-cover rounded-lg">
                    </div>
                </a>

                <!-- CARD 5: Libro de cirugías -->
                <a href="{{ route('cirugias.index') }}"
                    class="flex rounded-2xl overflow-hidden transform hover:scale-[1.02] transition duration-300 bg-white h-40 text-decoration-none h-40">
                    <div class="w-1/2 p-6 flex flex-col justify-between">
                        <div>
                            <h2
                                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2">
                                <img src="{{ asset('assets/img/logo-san-felipe.png') }}" alt="Hospital San Felipe"
                                    class="w-6 h-6">
                                Libro de cirugías
                            </h2>
                            <p class="text-gray-500 mt-2 text-sm">Registro de cirugías realizadas en quirófano</p>
                        </div>
                        <span class="text-blue-600 font-semibold mt-4">Ver más →</span>
                    </div>
                    <div class="w-1/2 flex items-center justify-center">
                        <img src="{{ asset('assets/img/libro_cirugias.jpeg') }}" alt="Cirugías"
                            class="h-24 w-32 object-cover rounded-lg">
                    </div>
                </a>

            </div>


        </main>
    </div>

    <!-- Script -->


@endsection
