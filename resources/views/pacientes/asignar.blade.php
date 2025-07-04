@extends('layouts.app')

@section('titulo', 'Asignar habitación y cama')

@section('contenido')
<div class="max-w-2xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Asignar Habitación y Cama a {{ $paciente->nombre }} {{ $paciente->apellido }}</h1>

    <form action="{{ route('pacientes.asignar.guardar', $paciente) }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-6 border">
        @csrf

        <div>
            <label for="habitacion_id" class="block font-medium text-gray-700 mb-1">Habitación</label>
            <select name="habitacion_id" id="habitacion_id" class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-neutral-300">
                <option value="">-- Seleccioná una habitación --</option>
                @foreach($habitaciones as $habitacion)
                    <option value="{{ $habitacion->id }}">{{ $habitacion->numero ?? 'Habitación '.$habitacion->id }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="cama_id" class="block font-medium text-gray-700 mb-1">Cama</label>
            <select name="cama_id" id="cama_id" class="w-full border-gray-300 rounded shadow-sm">
                <option value="">-- Seleccioná una cama --</option>
                @foreach($habitaciones as $habitacion)
                    @foreach($habitacion->camas as $cama)
                        <option value="{{ $cama->id }}">Hab {{ $habitacion->numero ?? $habitacion->id }} - Cama {{ $cama->codigo ?? $cama->id }}</option>
                    @endforeach
                @endforeach
            </select>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-neutral-700 text-white px-6 py-2 rounded-full hover:bg-neutral-800 shadow">
                Guardar asignación
            </button>
        </div>
    </form>
</div>
@endsection