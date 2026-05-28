@extends('layouts.app')
@section('titulo', 'Crear Servicio')
@section('contenido')
    <div class="max-w-2xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md mb-6">
            Crear Nuevo Servicio
        </h1>

        <form action="{{ route('servicios.store') }}" method="POST" class="bg-white shadow rounded-lg border border-gray-200 p-6 space-y-6">
            @csrf

            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Servicio</label>
                <input type="text" name="nombre" id="nombre" class="w-full border-2 border-gray-400 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-gray-500" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="w-full border-2 border-gray-400 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-gray-500">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between pt-4">
                <a href="{{ route('servicios.index') }}" class="text-gray-600 hover:text-gray-800 font-medium py-2 px-4 rounded border border-gray-300 hover:bg-gray-50 transition duration-300">
                    Cancelar
                </a>
                <button type="submit" class="bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md transition duration-300">
                    Guardar
                </button>
            </div>
        </form>
    </div>
@endsection
