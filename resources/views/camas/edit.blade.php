@extends('layouts.app')

@section('titulo', 'Editar Cama')

@section('contenido')
<div class="max-w-4xl mx-auto px-6 py-8">

    {{-- Título institucional centrado --}}
    <h1 class="text-3xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360]
               text-transparent bg-clip-text drop-shadow-md mb-8 text-center">
        Editar Cama
    </h1>

    {{-- Contenedor con borde degradado --}}
    <div class="p-[1px] rounded-2xl bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] shadow-lg">
        <div class="bg-white rounded-2xl p-8 space-y-8">

            <form action="{{ route('camas.update', $cama) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Código --}}
                <div>
                    <label for="codigo" class="block text-sm font-semibold text-gray-700 mb-1">
                        Código de Cama
                    </label>
                    <input type="text" name="codigo" id="codigo"
                           class="w-full rounded-lg border border-gray-300 shadow-sm px-4 py-2
                                  focus:outline-none focus:ring-2 focus:ring-[#1B7D8F]"
                           value="{{ old('codigo', $cama->codigo) }}" required>
                </div>

                {{-- Habitación --}}
                <div>
                    <label for="habitacion_id" class="block text-sm font-semibold text-gray-700 mb-1">
                        Habitación
                    </label>
                    <select name="habitacion_id" id="habitacion_id"
                            class="w-full rounded-lg border border-gray-300 shadow-sm px-4 py-2
                                   focus:outline-none focus:ring-2 focus:ring-[#1B7D8F]">
                        @foreach($habitaciones as $habitacion)
                            <option value="{{ $habitacion->id }}"
                                {{ $cama->sala_id == $habitacion->id ? 'selected' : '' }}>
                                {{ $habitacion->numero }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Botones --}}
                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                    <a href="{{ route('camas.index') }}"
                       class="text-sm text-[#1B7D8F] hover:underline transition">
                        ← Cancelar
                    </a>
                    <button type="submit"
                            class="bg-neutral-700 hover:bg-neutral-800 text-white font-semibold px-8 py-2.5 rounded-full shadow-md transition">
                        Guardar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
