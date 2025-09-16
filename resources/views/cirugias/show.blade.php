@extends('layouts.app')

@section('title', 'Ver Cirugía')

@section('contenido')
<div class="max-w-4xl mx-auto px-6 py-8">

    {{-- Título --}}
    <h1 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow mb-6">
        Detalle de la Cirugía
    </h1>

    {{-- Tarjeta principal --}}
    <div class="bg-white shadow rounded-lg p-6 border border-gray-200 space-y-5 text-[15px]">

        {{-- Paciente --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-gray-500 uppercase tracking-wide text-sm">Paciente</p>
                <p class="font-semibold text-gray-800">{{ $cirugia->get_paciente->nombre }} {{ $cirugia->get_paciente->apellido }}</p>
            </div>
            <div>
                <p class="text-gray-500 uppercase tracking-wide text-sm">DNI</p>
                <p class="font-semibold text-gray-800">{{ $cirugia->get_paciente->dni }}</p>
            </div>
        </div>

        {{-- Procedimiento --}}
        <div>
            <p class="text-gray-500 uppercase text-sm">Procedimiento</p>
            <p class="text-gray-800 font-medium">
                {{ $cirugia->get_procedimiento->nombre_procedimiento }} - {{ $cirugia->get_procedimiento->descripcion }}
            </p>
        </div>

        {{-- Quirófano --}}
        <div>
            <p class="text-gray-500 uppercase text-sm">Quirófano</p>
            <p class="text-gray-800 font-medium">
                {{ $cirugia->get_quirofano->nombre }} - {{ $cirugia->get_quirofano->descripcion }}
            </p>
        </div>

        {{-- Cirujano --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-gray-500 uppercase text-sm">Cirujano</p>
                <p class="text-gray-800 font-medium">{{ $cirugia->get_cirujano->nombre }} {{ $cirugia->get_cirujano->apellido }}</p>
            </div>
            <div>
                <p class="text-gray-500 uppercase text-sm">DNI</p>
                <p class="text-gray-800 font-medium">{{ $cirugia->get_cirujano->dni }}</p>
            </div>
        </div>

        {{-- Ayudantes --}}
        @foreach (['1', '2', '3'] as $num)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-gray-500 uppercase text-sm">Ayudante {{ $num }}</p>
                <p class="text-gray-800 font-medium">
                    {{ $cirugia->{'get_ayudante' . $num}->nombre ?? '' }} {{ $cirugia->{'get_ayudante' . $num}->apellido ?? '' }}
                </p>
            </div>
            <div>
                <p class="text-gray-500 uppercase text-sm">DNI</p>
                <p class="text-gray-800 font-medium">{{ $cirugia->{'get_ayudante' . $num}->dni ?? '' }}</p>
            </div>
        </div>
        @endforeach

        {{-- Tipo de Anestesia --}}
        <div>
            <p class="text-gray-500 uppercase text-sm">Tipo de Anestesia</p>
            <p class="text-gray-800 font-medium">{{ $cirugia->get_tipo_anestesia->nombre }}</p>
        </div>

        {{-- Instrumentador --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-gray-500 uppercase text-sm">Instrumentador</p>
                <p class="text-gray-800 font-medium">
                    {{ $cirugia->get_instrumentador->nombre }} {{ $cirugia->get_instrumentador->apellido }}
                </p>
            </div>
            <div>
                <p class="text-gray-500 uppercase text-sm">DNI</p>
                <p class="text-gray-800 font-medium">{{ $cirugia->get_instrumentador->dni }}</p>
            </div>
        </div>

        {{-- Enfermero --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-gray-500 uppercase text-sm">Enfermero</p>
                <p class="text-gray-800 font-medium">
                    {{ $cirugia->get_enfermero->nombre }} {{ $cirugia->get_enfermero->apellido }}
                </p>
            </div>
            <div>
                <p class="text-gray-500 uppercase text-sm">DNI</p>
                <p class="text-gray-800 font-medium">{{ $cirugia->get_enfermero->dni }}</p>
            </div>
        </div>

        {{-- Urgencia como switch visual --}}
        <div>
            <p class="text-gray-500 uppercase text-sm mb-1">Urgencia</p>
            <label class="inline-flex items-center cursor-default">
                <input type="checkbox" class="sr-only peer" disabled {{ $cirugia->urgencia ? 'checked' : '' }}>
                <div class="w-11 h-6 bg-gray-300 rounded-full peer-checked:bg-[#2BA8A0] relative transition-all">
                    <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition peer-checked:translate-x-5"></span>
                </div>
                <span class="ml-3 text-base font-medium text-gray-800">
                    {{ $cirugia->urgencia ? 'Sí' : 'No' }}
                </span>
            </label>
        </div>

        {{-- Fecha y hora --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-gray-500 uppercase text-sm">Fecha de la cirugía</p>
                <p class="text-gray-800 font-medium">{{ $cirugia->fecha_cirugia }}</p>
            </div>
            <div>
                <p class="text-gray-500 uppercase text-sm">Hora de la cirugía</p>
                <p class="text-gray-800 font-medium">{{ $cirugia->hora_cirugia }}</p>
            </div>
        </div>
    </div>


</div>
@endsection
