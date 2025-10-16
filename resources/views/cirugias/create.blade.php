@extends('layouts.app')

@section('title', 'Registrar Nueva Cirugía')

@section('styles')
    <link href="{{ asset('css/cirugias-form.css') }}" rel="stylesheet">
@endsection

@section('contenido')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
            Agregar Nueva Cirugía
        </h1>
    </div>

    <!-- Formulario -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('cirugias.store') }}" method="POST" id="cirugia-form">
                @csrf
                
                <!-- Campos del formulario -->
                @include('cirugias.partials.form-fields')

                <!-- Botones con mejor espaciado -->
                <div class="flex justify-between items-center pt-8 mt-6 border-t border-gray-200">
                    <a href="{{ route('cirugias.index') }}" class="btn btn-outline-danger px-6 py-3 rounded-lg shadow-sm transition duration-300 hover:shadow-md">
                        <i class="fas fa-times mr-2"></i>Cancelar
                    </a>
                    <button type="submit" class="inline-block bg-gradient-to-r from-neutral-700 to-neutral-800 hover:from-neutral-800 hover:to-neutral-900 text-white font-medium py-3 px-8 rounded-lg shadow-md cursor-pointer transition duration-300 transform hover:-translate-y-1">
                        <i class="fas fa-save mr-2"></i>Registrar Cirugía
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Incluir scripts -->
@include('cirugias.partials.scripts')
@endsection