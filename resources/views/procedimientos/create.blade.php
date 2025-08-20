@extends('layouts.app')

@section('title', 'Crear Procedimiento')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    {{-- Título institucional rojo --}}
    <h2 class="text-danger fw-bold border-bottom border-danger pb-2 mb-4">
        Agregar Nuevo Procedimiento
    </h2>

    {{-- Contenedor con borde rojo institucional --}}
    <div class="card border-danger shadow-sm">
        <div class="card-body text-dark">

            <form action="{{ route('procedimientos.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Campo nombre --}}
                <div>
                    <label for="nombre_procedimiento" class="form-label fw-semibold text-dark">
                        Procedimiento
                    </label>
                    <input type="text" name="nombre_procedimiento" id="nombre_procedimiento"
                           class="form-control border border-danger shadow-sm"
                           required>
                    @error('nombre_procedimiento')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror
                </div>

                {{-- Campo descripción --}}
                <div>
                    <label for="descripcion" class="form-label fw-semibold text-dark">
                        Descripción
                    </label>
                    <input type="text" name="descripcion" id="descripcion"
                           class="form-control border border-danger shadow-sm">
                    @error('descripcion')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror
                </div>

                {{-- Botones --}}
                <div class="pt-2 d-flex justify-content-between">
                    <button type="submit" class="btn btn-outline-danger fw-semibold px-4">
                        Agregar
                    </button>
                    <a href="{{ route('procedimientos.index') }}" class="btn btn-outline-danger fw-semibold px-4">
                        Cancelar
                    </a>
                </div>

                <div class="mt-3 text-center">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                        ← Volver atrás
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
