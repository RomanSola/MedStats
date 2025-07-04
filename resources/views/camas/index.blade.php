@extends('layouts.app')

@section('titulo', 'Gestión de Camas')

@section('contenido')

<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Listado de Camas</h1>

    <div class="flex justify-end mb-4">
        <a href="{{ route('camas.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-full shadow transition">
            + Agregar Nueva Cama
        </a>
    </div>
    <form method="GET" action="{{ route('camas.index') }}" class="mb-6">
        <label for="sala" class="block text-sm font-semibold text-gray-700 mb-1">Filtrar por Sala:</label>
        <select name="sala_id" id="sala" onchange="this.form.submit()"
                class="w-full md:w-1/3 rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-green-500">
            <option value="">Todas las salas</option>
            @foreach ($salas as $sala)
                <option value="{{ $sala->id }}" {{ request('sala_id') == $sala->id ? 'selected' : '' }}>
                    {{ $sala->nombre }}
                </option>
            @endforeach
        </select>
    </form>
    <div class="row" style="width: 100%">
        @foreach ($camas as $cama)
            <div class="container col-3 shadow" style="background-color: #fff; border-radius: 22px; border: solid 1px lightgreen; padding: 10px; margin: 2%; text-align: center;">
                <h3>Habitación {{ $cama->get_habitacion->numero ?? 'Sin asignar' }}</h3>
                <div class="card" style="width: 18rem; border-radius: 12px; background-color: #e7e7e7; margin-bottom: 12px;">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-7">
                                <h5 class="card-title"><b>Cama {{ $cama->codigo }}</b></h5>
                            </div>
                            <div class="col-4">
                            </div>
                        </div>

                   @if ($cama->ocupada && $cama->paciente)
                        <p><strong>Paciente:</strong> {{ $cama->paciente->nombre }} {{ $cama->paciente->apellido }}</p>
                    @endif

                        <h4 class="mb-2">{{ $cama->ocupada == 'ocupada' ? 'OCUPADA' : 'LIBRE' }}</h4>
                        @if ($cama->ocupada && $cama->paciente)
                            <form action="{{ route('pacientes.darDeAlta', $cama->paciente) }}" method="POST" class="mb-2">
                                @csrf
                                <button type="submit" class="btn btn-danger">Dar de Alta</button>
                            </form>
                        @else
                            <a href="{{ url('/pacientes?habitacion=' . ($cama->habitacion->id ?? 0) . '&cama=' . $cama->id) }}"
                               class="btn" style="background-color: lightgreen">Asignar paciente</a>
                        @endif

                        <a href="{{ route('camas.edit', ['cama' => $cama->id]) }}"
                           class="btn btn-secondary mt-2">Editar cama</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
        {{-- <table class="min-w-full table-auto text-sm text-gray-800">
            <thead class="bg-green-100 text-green-800 font-semibold">
                <tr>
                    <th class="px-4 py-2 border">Código</th>
                    <th class="px-4 py-2 border">Habitación</th>
                    <th class="px-4 py-2 border text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($camas as $cama)
                <tr class="hover:bg-green-50">
                    <td class="px-4 py-2 border">{{ $cama->codigo }}</td>
                    <td class="px-4 py-2 border">{{ $cama->get_habitacion->numero }}</td>
                    <td class="px-4 py-2 border text-center space-x-2">
                        <a href="{{ route('camas.edit', $cama) }}"
                           class="text-blue-600 hover:underline font-semibold">Editar</a>
                        <form action="{{ route('camas.destroy', $cama) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline font-semibold" type="submit">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-4 py-2 text-center text-gray-500">No hay camas registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table> --}}
@endsection