@extends('layouts.app')
@section('titulo', 'Inicio')
@section('contenido')
    <div class="flex min-h-screen bg-gray-100 transition-all duration-300 ease-in-out">
        <!-- Main -->
        <main class="flex-1 p-4 max-w-full">
            <div class="text-center mt-10 mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">
                    Hola, <span class="text-[#1B7D8F]">{{ Auth::user()->name ?? 'Usuario' }}</span>
                </h1>

                <!-- Buscador -->
                <div class="flex justify-center">
                    <form action="{{ route('buscar') }}" method="GET" class="relative w-full max-w-2xl transform transition-all hover:scale-[1.01]">
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-6 w-6 text-gray-400 group-focus-within:text-[#1B7D8F] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" id="busqueda" name="busqueda" autocomplete="off"
                                placeholder="Buscar paciente por nombre, apellido o DNI..."
                                class="w-full pl-12 pr-4 py-4 rounded-full border-2 border-gray-200 focus:border-[#1B7D8F] focus:ring-4 focus:ring-[#1B7D8F]/10 focus:outline-none shadow-sm text-lg transition-all duration-300" />
                            <button type="submit" class="absolute right-2 top-2 bottom-2 px-6 bg-[#1B7D8F] hover:bg-[#176d7b] text-white rounded-full font-medium shadow-md transition-all duration-300 hover:shadow-lg">
                                Buscar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- KPIs rápidos -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12 max-w-7xl mx-auto">
                
                <!-- Pacientes activos -->
                <div class="bg-white rounded-2xl p-6 flex items-center gap-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="p-3 bg-blue-50 rounded-xl">
                        <img src="{{ asset('assets/img/pacientes.png') }}" alt="Pacientes" class="h-10 w-10 object-contain" />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Pacientes en cama</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $pacientes }}</p>
                    </div>
                </div>

                <!-- Camas ocupadas -->
                <div class="bg-white rounded-2xl p-6 flex items-center gap-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="p-3 bg-teal-50 rounded-xl">
                        <img src="{{ asset('assets/img/camas.png') }}" alt="Camas" class="h-10 w-10 object-contain" />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Ocupación</p>
                        <div class="flex items-baseline gap-2">
                            <p class="text-3xl font-bold text-gray-800">{{ $porcentajeCamas }}%</p>
                            <span class="text-xs font-medium px-2 py-0.5 rounded-full {{ $porcentajeCamas > 80 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                {{ $porcentajeCamas > 80 ? 'Alta' : 'Normal' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Cirugías realizadas -->
                <div class="bg-white rounded-2xl p-6 flex items-center gap-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="p-3 bg-indigo-50 rounded-xl">
                        <img src="{{ asset('assets/img/cirugias.png') }}" alt="Cirugías" class="h-10 w-10 object-contain" />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Cirugías (Año)</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $cantCirugias }}</p>
                    </div>
                </div>

            </section>

            <!-- Cards principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-8 bg-gray-100">
                <!-- CARD 1: Insumos -->
                @if(Auth::user()->hasAccess('insumos'))
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
                @endif

                <!-- CARD 2: Estadísticas -->
                @if(Auth::user()->hasAccess('estadisticas'))
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
                @endif

                <!-- CARD 3: Pacientes -->
                @if(Auth::user()->hasAccess('pacientes'))
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
                @endif

                <!-- CARD 4: Camas -->
                @if(Auth::user()->hasAccess('camas'))
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
                @endif

                <!-- CARD 5: Libro de cirugías -->
                @if(Auth::user()->hasAccess('cirugias'))
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
                @endif
            </div>
        </main>
    </div>

@endsection
@push('scripts')
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
@endpush