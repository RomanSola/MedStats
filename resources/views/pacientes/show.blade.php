@extends('layouts.app')

@section('titulo', 'Ficha del Paciente')

@section('contenido')
<div class="max-w-4xl mx-auto px-4 py-8">

    {{-- Título institucional --}}
    <h1 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md mb-6">
        Ficha del Paciente
    </h1>

    {{-- Contenedor principal --}}
    <div class="bg-white shadow rounded-lg p-6 border border-gray-200 space-y-6">

        {{-- Datos personales --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">DNI</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->dni }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Fecha de nacimiento</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->fecha_nacimiento }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Nombre</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->nombre }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Apellido</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->apellido }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Teléfono</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->telefono }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Género</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->genero }}</p>
            </div>
        </div>

        {{-- Ubicación --}}
        <hr class="my-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">País</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->get_pais->nombre }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Provincia</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->get_provincia->nombre }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Código Postal</p>
                <p class="text-base font-semibold text-gray-800">
                    @if($paciente->cod_postal_id)
                        {{ $paciente->get_codigo_postal->codigo }} - {{ $paciente->get_codigo_postal->localidad }}
                    @else
                        No especificado
                    @endif
                </p>
            </div>

            <div class="md:col-span-2">
                <p class="text-sm text-gray-500 uppercase tracking-wide">Dirección</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->direccion }}</p>
            </div>
        </div>
    </div>

    {{-- Botón de retorno --}}
    <div class="mt-6">
        <a href="{{ route('pacientes.index') }}"
           class="btn btn-outline-primary px-5 py-2 rounded shadow-sm">
           ← Volver al listado
        </a>
    </div>
</div>
@endsection
