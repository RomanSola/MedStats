@extends('layouts.app')

@section('titulo', 'Ver Profesión')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    {{-- Título institucional amarillo --}}
    <h1 class="text-warning fw-bold border-bottom border-warning pb-2 mb-4 text-center">
        Detalle de la Profesión
    </h1>

    {{-- Contenedor con borde amarillo institucional --}}
    <div class="card border-warning shadow-sm">
        <div class="card-body text-dark">

            <form>
                {{-- Campo nombre --}}
                <div class="mb-3">
                    <label for="nombre_profesion" class="form-label fw-semibold text-dark">Profesión</label>
                    <input type="text" name="nombre_profesion" id="nombre_profesion"
                           class="form-control border border-warning shadow-sm"
                           value="{{ $profesion->nombre_profesion }}" readonly>
                </div>

                {{-- Campo descripción --}}
                <div class="mb-3">
                    <label for="descripcion" class="form-label fw-semibold text-dark">Descripción</label>
                    <input type="text" name="descripcion" id="descripcion"
                           class="form-control border border-warning shadow-sm"
                           value="{{ $profesion->descripcion }}" readonly>
                </div>

                {{-- Campo rol quirúrgico --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark">Rol en Quirófano</label>
                    <input type="text"
                           class="form-control border border-warning shadow-sm"
                           value="{{ $profesion->get_rol->rol ?? 'Sin asignar' }}" readonly>
                </div>

                {{-- Botón de volver --}}
                <div class="text-center mt-4">
                    <a href="{{ route('profesion.index') }}" class="btn btn-outline-warning fw-semibold px-4">
                        ← Volver al listado
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
