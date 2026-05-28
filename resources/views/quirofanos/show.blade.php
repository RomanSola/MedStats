@extends('layouts.app')

@section('title', 'Ver Quirófano')

@section('contenido')
    <div class="max-w-5xl mx-auto px-4 py-4">

        {{-- Título institucional con degradado --}}
        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
                Detalle del Quirófano
            </h1>
        </div>

        {{-- Contenedor institucional --}}
        <div class="card border shadow-sm">
            <div class="card-body text-dark">

                <form>
                    <div class="row g-3">
                        {{-- Campo: Quirófano --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nombre del Quirófano</label>
                            <input type="text" class="form-control border shadow-sm"
                                   value="{{ $quirofano->nombre }}" readonly>
                        </div>

                        {{-- Campo: Descripción --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Descripción</label>
                            <input type="text" class="form-control border shadow-sm"
                                   value="{{ $quirofano->descripcion }}" readonly>
                        </div>
                    </div>

                    {{-- Botón de volver --}}
                    <div class="text-center mt-4">
                        <a href="{{ route('quirofanos.index') }}"
                           class="btn btn-outline-info fw-semibold px-4">
                             Volver al listado
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
