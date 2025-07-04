@extends('layouts.app')

@section('titulo', 'Agregar Nueva Cama')

@section('contenido')
<div class="max-w-3xl mx-auto px-4 py-8">

    <h1 class="text-2xl font-bold text-green-800 mb-6">Agregar Nueva Cama</h1>

    <form action="{{ route('camas.store') }}" method="POST"
          class="bg-white shadow-md rounded-lg p-6 border border-gray-200 space-y-6">
        @csrf

        <!-- Código -->
        <div>
            <label for="codigo" class="block text-sm font-semibold text-gray-700 mb-1">
                Código de la Cama
            </label>
            <input type="text" name="codigo" id="codigo"
                   value="{{ old('codigo') }}"
                   class="w-full rounded-md border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:outline-none px-4 py-2"
                   required>
            @error('codigo')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Habitación -->
        <div>
            <label for="habitacion_id" class="block text-sm font-semibold text-gray-700 mb-1">
                Seleccionar Habitación
            </label>
            <select name="habitacion_id" id="habitacion_id"
                    class="w-full rounded-md border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:outline-none px-4 py-2"
                    required>
                <option value="">Seleccione una habitación</option>
                @foreach($habitaciones as $habitacion)
                <option value="{{ $habitacion->id }}"
                        {{ old('habitacion_id') == $habitacion->id ? 'selected' : '' }}>
                        Habitación {{ $habitacion->numero }} - Sala {{ $habitacion->get_sala->nombre ?? 'Sin sala' }}

                </option>
                @endforeach
            </select>
            @error('habitacion_id')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('camas.index') }}"
               class="text-green-700 hover:text-green-900 font-medium transition">
                ← Cancelar
            </a>
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-full shadow transition">
                💾 Guardar Cama
            </button>
        </div>
    </form>
</div>
@endsection
