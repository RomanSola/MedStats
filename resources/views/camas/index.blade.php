@extends('layouts.app')

@section('titulo', 'Gestión de Camas')

@section('contenido')
<div class="max-w-6xl mx-auto px-4 py-4">

    {{-- Título institucional --}}
    <h1 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md mb-4">
        Listado de Camas
    </h1>

    {{-- Botón agregar cama --}}
    <div class="flex justify-end mb-2">
        <a href="{{ route('camas.create') }}"
           class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-5 rounded-full shadow-md transition duration-300"
           style="text-decoration: none;">
           Agregar Nueva Cama
        </a>
    </div>

    {{-- Filtro por sala compacto --}}
    <form method="GET" action="{{ route('camas.index') }}" class="mb-4">
        <div class="flex items-center gap-2">
            <label for="sala" class="text-sm font-semibold text-gray-700">Filtrar por Sala:</label>
            <select name="sala_id" id="sala" onchange="this.form.submit()"
                    class="rounded-md border border-gray-300 shadow-sm px-3 py-1 focus:ring-2 focus:ring-green-500">
                <option value="">Todas las salas</option>
                @foreach ($salas as $sala)
                    <option value="{{ $sala->id }}" {{ request('sala_id') == $sala->id ? 'selected' : '' }}>
                        {{ $sala->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    {{-- Contenedor azul degradado institucional --}}
    <div class="p-[1px] rounded-xl bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] shadow-md mb-4">
        <div class="bg-white rounded-xl p-4">

            {{-- Tarjetas de camas --}}
            <div class="row w-full">
                @foreach ($camas as $cama)
                    <div class="container col-3 bg-white rounded-xl border border-gray-400 shadow-lg p-3 m-2 text-center">

                        {{-- Título habitación --}}
                        <h3 class="text-base font-semibold text-gray-700 mb-1">
                            Habitación {{ $cama->get_habitacion->numero ?? 'Sin asignar' }}
                        </h3>

                        {{-- Tarjeta interna --}}
                        <div class="bg-gray-100 rounded-lg p-3 mb-2 shadow-sm">

                            {{-- Título cama --}}
                            <h5 class="text-sm font-bold text-gray-800 mb-1">
                                Cama {{ $cama->codigo }}
                            </h5>

                            {{-- Datos del paciente si está ocupada --}}
                            @if ($cama->ocupada && $cama->paciente)
                                <div class="text-left text-sm bg-white border border-gray-300 rounded px-2 py-2 mb-2">
                                    <p><strong>Nombre:</strong> {{ $cama->paciente->nombre }} {{ $cama->paciente->apellido }}</p>
                                    <p><strong>DNI:</strong> {{ $cama->paciente->dni }}</p>
                                    @php
                                        $fechaNacimiento = \Carbon\Carbon::parse($cama->paciente->fecha_nacimiento);
                                        $edadAnios = $fechaNacimiento->age;
                                        $edadMeses = $fechaNacimiento->diffInMonths(\Carbon\Carbon::now());
                                    @endphp
                                    @if ($edadAnios >= 2)
                                        <p><strong>Edad:</strong> {{ $edadAnios }} años</p>
                                    @elseif ($edadAnios == 1)
                                        <p><strong>Edad:</strong> 1 año ({{ $edadMeses }} meses)</p>
                                    @else
                                        <p><strong>Edad:</strong> {{ $edadMeses }} meses</p>
                                    @endif
                                    <p><strong>Género:</strong> {{ $cama->paciente->genero }}</p>
                                    <p><strong>Teléfono:</strong> {{ $cama->paciente->telefono }}</p>
                                    <p><strong>Dirección:</strong> {{ $cama->paciente->direccion }}</p>
                                </div>
                            @endif

                            {{-- Estado de ocupación --}}
                            <h4 class="text-xs font-semibold text-white px-2 py-1 rounded-full inline-block mb-2
                                {{ $cama->ocupada == 'ocupada' ? 'bg-red-500' : 'bg-green-500' }}">
                                {{ $cama->ocupada == 'ocupada' ? 'OCUPADA' : 'LIBRE' }}
                            </h4>

                            {{-- Botones de acción --}}
                            @if ($cama->ocupada && $cama->paciente)
                                <form action="{{ route('pacientes.darDeAlta', $cama->paciente) }}" method="POST" class="mb-2">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        Dar de Alta
                                    </button>
                                </form>
                            @else
                                <a href="{{ url('/pacientes?habitacion=' . ($cama->habitacion->id ?? 0) . '&cama=' . $cama->id) }}"
                                   class="btn btn-outline-success btn-sm">
                                   Asignar paciente
                                </a>
                            @endif

                            <a href="{{ route('camas.edit', ['cama' => $cama->id]) }}"
                               class="btn btn-outline-warning btn-sm mt-1">
                               Editar cama
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
