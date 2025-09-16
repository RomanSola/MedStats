@extends('layouts.app')

@section('title', 'Ver Procedimiento')

@section('contenido')
<div class="container mt-4">
    <div class="max-w-xl mx-auto px-4 py-8">

        {{-- Título con degradado y estilo igual al show de empleados --}}
        <h2
            class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md text-center mb-6">
            Detalle del Procedimiento
        </h2>

        {{-- Contenedor principal con borde secundario (gris) y sombra --}}
        <div class="card border-secondary shadow-sm">
            <div class="card-body">

                <form>
                    {{-- Campo nombre --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary">Procedimiento</label>
                        <input type="text" class="form-control border border-gray-300 shadow-sm"
                               value="{{ $procedimiento->nombre_procedimiento }}" readonly>
                    </div>

                    {{-- Campo descripción --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary">Descripción</label>
                        <input type="text" class="form-control border border-gray-300 shadow-sm"
                               value="{{ $procedimiento->descripcion }}" readonly>
                    </div>

                    {{-- Botón volver con el mismo estilo que empleados --}}
                    <div class="text-center mt-4">
                        <a href="{{ route('procedimientos.index') }}"
                           class="btn btn-outline-info fw-semibold px-4">
                             Volver al listado
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
