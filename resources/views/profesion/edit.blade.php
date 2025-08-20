@extends('layouts.app')

@section('titulo', 'Editar Profesión')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    {{-- Título institucional amarillo --}}
    <h1 class="text-warning fw-bold border-bottom border-warning pb-2 mb-4">
        Editar Profesión
    </h1>

    {{-- Contenedor con borde amarillo institucional --}}
    <div class="card border-warning shadow-sm">
        <div class="card-body text-dark">

            <form action="{{ route('profesion.update', $profesion) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Campo nombre --}}
                <div>
                    <label for="nombre_profesion" class="form-label fw-semibold text-dark">
                        Profesión
                    </label>
                    <input type="text" name="nombre_profesion" id="nombre_profesion"
                           class="form-control border border-warning shadow-sm"
                           value="{{ $profesion->nombre_profesion }}" required>
                </div>

                {{-- Campo descripción --}}
                <div>
                    <label for="descripcion" class="form-label fw-semibold text-dark">
                        Descripción
                    </label>
                    <input type="text" name="descripcion" id="descripcion"
                           class="form-control border border-warning shadow-sm"
                           value="{{ $profesion->descripcion }}">
                </div>

                {{-- Botones --}}
                <div class="pt-2 d-flex justify-content-between">
                    <button type="submit" class="btn btn-outline-warning fw-semibold px-4">
                        Guardar Cambios
                    </button>
                    <a href="{{ route('profesion.index') }}" class="btn btn-outline-warning fw-semibold px-4">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
