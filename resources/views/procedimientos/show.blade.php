@extends('layouts.app')

@section('title', 'Ver Procedimiento')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    {{-- Título institucional rojo --}}
    <h2 class="text-danger fw-bold border-bottom border-danger pb-2 mb-4 text-center">
        Detalle del Procedimiento
    </h2>

    {{-- Contenedor con borde rojo institucional --}}
    <div class="card border-danger shadow-sm">
        <div class="card-body text-dark">

            <form>
                {{-- Campo nombre --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark">Procedimiento</label>
                    <input type="text" class="form-control border border-danger shadow-sm"
                           value="{{ $procedimiento->nombre_procedimiento }}" readonly>
                </div>

                {{-- Campo descripción --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark">Descripción</label>
                    <input type="text" class="form-control border border-danger shadow-sm"
                           value="{{ $procedimiento->descripcion }}" readonly>
                </div>

                {{-- Botón de volver --}}
                <div class="text-center mt-4">
                    <a href="{{ route('procedimientos.index') }}" class="btn btn-outline-danger fw-semibold px-4">
                        ← Volver al listado
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
