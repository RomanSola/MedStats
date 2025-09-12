@extends('layouts.app')

@section('titulo', 'Agregar Nueva Cama')

@section('contenido')
<div class="max-w-3xl mx-auto px-4 py-4">

    {{-- Título institucional --}}
    <h1 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md mb-4">
        Agregar Nueva Cama
    </h1>

    {{-- Contenedor con borde azul degradado --}}
    <div class="p-[1px] rounded-xl bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] shadow-md">
        <div class="bg-white rounded-xl p-5 space-y-5">

            <form action="{{ route('camas.store') }}" method="POST">
                @csrf

                {{-- Código --}}
                <div>
                    <label for="codigo" class="block text-sm font-semibold text-gray-700 mb-1">
                        Código de la Cama
                    </label>
                    <input type="text" name="codigo" id="codigo"
                           value="{{ request('codigo') }}"
                           class="w-full rounded-md border border-gray-400 shadow-sm focus:ring-2 focus:ring-green-500 px-4 py-2">
                    @error('codigo')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Sala --}}
                <div>
                    <label for="sala_id" class="block text-sm font-semibold text-gray-700 mb-1">
                        Seleccionar Sala
                    </label>
                    <select name="sala_id" id="sala_id"
                            onchange="location = '?sala_id=' + this.value + '&codigo=' + document.querySelector('[name=codigo]').value + '&habitacion_id=' + document.querySelector('[name=habitacion_id]').value;"
                            class="w-full rounded-md border border-gray-400 shadow-sm focus:ring-2 focus:ring-green-500 px-4 py-2">
                        <option value="">Seleccione una sala</option>
                        @foreach ($salas as $sala)
                            <option value="{{ $sala->id }}"
                                    {{ request('sala_id') == $sala->id ? 'selected' : '' }}>
                                Sala {{ $sala->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Habitación --}}
                <div>
                    <label for="habitacion_id" class="block text-sm font-semibold text-gray-700 mb-1">
                        Seleccionar Habitación
                    </label>
                    <select name="habitacion_id" id="habitacion_id"
                            class="w-full rounded-md border border-gray-400 shadow-sm focus:ring-2 focus:ring-green-500 px-4 py-2">
                        <option value="">Seleccione una habitación</option>
                        @if(request('sala_id'))
                            @foreach($habitaciones as $habitacion)
                                <option value="{{ $habitacion->id }}"
                                        {{ old('habitacion_id') == $habitacion->id ? 'selected' : '' }}>
                                    Habitación {{ $habitacion->numero }} - Sala {{ $habitacion->get_sala->nombre ?? 'Sin sala' }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('habitacion_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botones --}}
                    <div class="flex justify-between pt-4">

                        <a href="{{ route('camas.index') }}" class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                            ← Cancelar
                        </a>
                    <button type="submit"
                            class="bg-neutral-700 hover:bg-neutral-800 text-white font-semibold px-6 py-2 rounded-full shadow-md transition">
                        Guardar Cama
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
