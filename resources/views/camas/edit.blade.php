@extends('layouts.app')

@section('titulo', 'Editar Cama')

@section('contenido')
    <div class="max-w-xl mx-auto px-4 py-4">

        {{-- Título institucional --}}
        <h1
            class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md mb-4">
            Editar Cama
        </h1>

        {{-- Contenedor con borde azul degradado --}}
        <div class="p-[1px] rounded-xl bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] shadow-md">
            <div class="bg-white rounded-xl p-5 space-y-5">

                <form action="{{ route('camas.update', $cama) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Código --}}
                    <div>
                        <label for="codigo" class="block text-sm font-semibold text-gray-700 mb-1">
                            Código de Cama
                        </label>
                        <input type="text" name="codigo" id="codigo"
                            class="w-full rounded-md border border-gray-400 shadow-sm focus:ring-2 focus:ring-green-500 px-4 py-2"
                            value="{{ old('codigo', $cama->codigo) }}" required>
                    </div>

                    {{-- Habitación --}}
                    <div>
                        <label for="habitacion_id" class="block text-sm font-semibold text-gray-700 mb-1">
                            Habitación
                        </label>
                        <select name="habitacion_id" id="habitacion_id"
                            class="w-full rounded-md border border-gray-400 shadow-sm focus:ring-2 focus:ring-green-500 px-4 py-2">
                            @foreach ($habitaciones as $habitacion)
                                <option value="{{ $habitacion->id }}"
                                    {{ $cama->sala_id == $habitacion->id ? 'selected' : '' }}>
                                    {{ $habitacion->numero }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Botones --}}
                    <div class="flex justify-between pt-4">

                        <a href="{{ route('camas.index') }}" class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                            ← Cancelar
                        </a>
                        <button type="submit"
                            class="bg-neutral-700 hover:bg-neutral-800 text-white font-semibold px-6 py-2 rounded-full shadow-md transition">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
