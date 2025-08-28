@extends('layouts.app')

@section('titulo', 'Gestión de Camas')

@section('contenido')
<div class="max-w-6xl mx-auto px-4 py-8">

    {{-- Título + botón --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md">
            Listado de Camas
        </h1>
        <a href="{{ route('camas.create') }}"
           class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md transition duration-300">
            + Agregar Nueva Cama
        </a>
    </div>

    {{-- Filtro por sala --}}
    <form method="GET" action="{{ route('camas.index') }}" class="mb-6">
        <div class="flex items-center gap-2">
            <label for="sala" class="text-sm font-semibold text-gray-700">Filtrar por Sala:</label>
            <select name="sala_id" id="sala" onchange="this.form.submit()"
                    class="rounded-md border border-gray-300 shadow-sm px-3 py-1 focus:ring-2 focus:ring-[#1B7D8F]">
                <option value="">Todas las salas</option>
                @foreach ($salas as $sala)
                    <option value="{{ $sala->id }}" {{ request('sala_id') == $sala->id ? 'selected' : '' }}>
                        {{ $sala->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    {{-- Contenedor institucional --}}
    <div class="p-[1px] rounded-xl bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] shadow-md">
        <div class="bg-white rounded-xl p-5">

            {{-- Grid de tarjetas --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($camas as $cama)
                    <div class="bg-white rounded-xl border border-gray-300 shadow-lg p-4 flex flex-col justify-between">

                        {{-- Título habitación --}}
                        <h3 class="text-base font-semibold text-gray-700 mb-2">
                            Habitación {{ $cama->get_habitacion->numero ?? 'Sin asignar' }}
                        </h3>

                        {{-- Tarjeta interna --}}
                        <div class="bg-gray-100 rounded-lg p-3 mb-3 shadow-sm flex-grow">

                            {{-- Título cama --}}
                            <h5 class="text-sm font-bold text-gray-800 mb-2">
                                Cama {{ $cama->codigo }}
                            </h5>

                            {{-- Datos paciente --}}
                            @if ($cama->ocupada && $cama->paciente)
                                <div class="text-left text-sm bg-white border border-gray-300 rounded px-2 py-2 mb-3">
                                    <p><strong>Nombre:</strong> {{ $cama->paciente->nombre }} {{ $cama->paciente->apellido }}</p>
                                    <p><strong>DNI:</strong> {{ $cama->paciente->dni }}</p>

                                    @php
                                        $fechaNacimiento = \Carbon\Carbon::parse($cama->paciente->fecha_nacimiento);
                                        $hoy = \Carbon\Carbon::now();
                                        $dias = $fechaNacimiento->diffInDays($hoy);
                                        $semanas = floor($dias / 7);
                                        $meses = $fechaNacimiento->diffInMonths($hoy);
                                        $anios = $fechaNacimiento->diffInYears($hoy);
                                        $mesesExtras = $meses - ($anios * 12);
                                    @endphp

                                    @if ($dias < 15)
                                        <p><strong>Edad:</strong> {{ $dias }} {{ $dias === 1 ? 'día' : 'días' }}</p>
                                    @elseif ($dias < 31)
                                        <p><strong>Edad:</strong> {{ $semanas }} {{ $semanas === 1 ? 'semana' : 'semanas' }}</p>
                                    @elseif ($anios < 1)
                                        <p><strong>Edad:</strong> {{ $meses }} {{ $meses === 1 ? 'mes' : 'meses' }}</p>
                                    @elseif ($anios < 3)
                                        <p><strong>Edad:</strong> {{ $anios }} {{ $anios === 1 ? 'año' : 'años' }}
                                            @if ($mesesExtras > 0)
                                                ({{ $mesesExtras }} {{ $mesesExtras === 1 ? 'mes' : 'meses' }})
                                            @endif
                                        </p>
                                    @else
                                        <p><strong>Edad:</strong> {{ $anios }} años</p>
                                    @endif

                                    <p><strong>Género:</strong> {{ $cama->paciente->genero }}</p>
                                    <p><strong>Teléfono:</strong> {{ $cama->paciente->telefono }}</p>
                                    <p><strong>Dirección:</strong> {{ $cama->paciente->direccion }}</p>
                                </div>
                            @endif

                            {{-- Estado --}}
                            <span class="text-xs font-semibold text-white px-2 py-1 rounded-full inline-block mb-3
                                {{ $cama->ocupada == 'ocupada' ? 'bg-red-500' : 'bg-green-500' }}">
                                {{ $cama->ocupada == 'ocupada' ? 'OCUPADA' : 'LIBRE' }}
                            </span>

                            {{-- Botones --}}
                            <div class="flex flex-wrap gap-1">
                                @if ($cama->ocupada && $cama->paciente)
                                    <form action="{{ route('pacientes.darDeAlta', $cama->paciente) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm me-1">
                                            Dar de Alta
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ url('/pacientes?habitacion=' . ($cama->habitacion->id ?? 0) . '&cama=' . $cama->id) }}"
                                       class="btn btn-outline-success btn-sm me-1">
                                       Asignar paciente
                                    </a>
                                @endif

                                <a href="{{ route('camas.edit', ['cama' => $cama->id]) }}"
                                   class="btn btn-outline-warning btn-sm">
                                   Editar cama
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection
