@extends('layouts.app')

@section('titulo', 'Ficha del Paciente')

@section('contenido')
<div class="max-w-4xl mx-auto px-4 py-8">

    <h1 class="text-2xl font-bold text-blue-800 mb-6">Ficha del Paciente</h1>

    <div class="bg-white shadow rounded-lg p-6 border border-gray-200 space-y-6">

        <!-- Datos personales -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-600">DNI</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->dni }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-600">Fecha de nacimiento</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->fecha_nacimiento }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-600">Nombre</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->nombre }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-600">Apellido</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->apellido }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-600">Teléfono</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->telefono }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-600">Género</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->genero }}</p>
            </div>
        </div>

        <!-- Ubicación -->
        <hr class="my-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-600">País</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->get_pais->nombre }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-600">Provincia</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->get_provincia->nombre }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-600">Código Postal</p>
                <p class="text-base font-semibold text-gray-800">
                    @if($paciente->cod_postal_id)
                        {{ $paciente->get_codigo_postal->codigo }} - {{ $paciente->get_codigo_postal->localidad }}
                    @else
                        No especificado
                    @endif
                </p>
            </div>

            <div class="md:col-span-2">
                <p class="text-sm text-gray-600">Dirección</p>
                <p class="text-base font-semibold text-gray-800">{{ $paciente->direccion }}</p>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('pacientes.index') }}"
           class="bg-blue-100 hover:bg-blue-200 text-blue-700 font-semibold py-2 px-5 rounded-full shadow">
            ← Volver al listado
        </a>
    </div>
</div>
@endsection
