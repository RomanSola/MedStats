@extends('layouts.app')

@section('title', 'Ver Profesión')

@section('contenido')
    <div class="max-w-5xl mx-auto px-4 py-4">

        {{-- Título institucional con degradado --}}
        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
                Detalle de la Profesión
            </h1>
        </div>

        {{-- Contenedor institucional --}}
        <div class="card border shadow-sm">
            <div class="card-body text-dark">

                <form>
                    <div class="row g-3">
                        {{-- Campo: Nombre de la Profesión --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Profesión</label>
                            <input type="text" class="form-control border shadow-sm"
                                value="{{ $profesion->nombre_profesion }}" readonly>
                        </div>

                        {{-- Campo: Descripción --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Descripción</label>
                            <input type="text" class="form-control border shadow-sm"
                                value="{{ $profesion->descripcion }}" readonly>
                        </div>

                        {{-- Campo: Rol en Quirófano --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Rol en Quirófano</label>
                            <input type="text" class="form-control border shadow-sm"
                                value="{{ $profesion->get_rol->rol ?? 'Sin asignar' }}" readonly>
                        </div>
                    </div>

                    {{-- Botón volver --}}
                    <div class="text-center mt-4">
                        <a href="{{ route('profesion.index') }}"
                           class="btn btn-outline-secondary fw-semibold px-4">
                            Volver al listado
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
