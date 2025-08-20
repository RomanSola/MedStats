@extends('layouts.app')

@section('title', 'Ver Quirófano')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    {{-- Título institucional celeste --}}
    <h2 class="text-info fw-bold border-bottom border-info pb-2 mb-4 text-center">
        Detalle del Quirófano
    </h2>

    {{-- Contenedor con borde celeste institucional --}}
    <div class="card border-info shadow-sm">
        <div class="card-body text-dark">

            <form>
                {{-- Campo nombre --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark">Quirófano</label>
                    <input type="text" class="form-control border border-info shadow-sm"
                           value="{{ $quirofano->nombre }}" readonly>
                </div>

                {{-- Campo descripción --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark">Descripción</label>
                    <input type="text" class="form-control border border-info shadow-sm"
                           value="{{ $quirofano->descripcion }}" readonly>
                </div>

                {{-- Botón de volver --}}
                <div class="text-center mt-4">
                    <a href="{{ route('quirofanos.index') }}" class="btn btn-outline-info fw-semibold px-4">
                        ← Volver al listado
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
