@extends('layouts.app')

@section('titulo', 'Editar Cama')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Editar Cama</h1>

    <form action="{{ route('camas.update', $cama) }}" method="POST"
          class="bg-white shadow rounded-lg p-6 border border-gray-200 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold text-sm text-gray-700 mb-1" for="codigo">Código de Cama</label>
            <input type="text" name="codigo" id="codigo"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500"
                   value="{{ old('codigo', $cama->codigo) }}" required>
        </div>

        <div>
            <label class="block font-semibold text-sm text-gray-700 mb-1" for="habitacion_id">Habitación</label>
            <select name="habitacion_id" id="habitacion_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500">
                @foreach($habitaciones as $habitacion)
                <option value="{{ $habitacion->id }}"
                    {{ $cama->sala_id == $habitacion->id ? 'selected' : '' }}>
                    {{ $habitacion->numero }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('camas.index') }}" class="text-green-700 hover:text-green-900 font-medium">← Cancelar</a>
            <button class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-full transition">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection
