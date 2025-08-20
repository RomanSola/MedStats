@extends('layouts.app')

@section('titulo', 'Crear Sala')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    {{-- Título institucional celeste --}}
    <h1 class="text-info fw-bold border-bottom border-info pb-2 mb-4">
        Agregar Nueva Sala
    </h1>

    {{-- Contenedor con borde celeste institucional --}}
    <div class="card border-info shadow-sm">
        <div class="card-body">

            <form action="{{ route('salas.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Campo nombre --}}
                <div>
                    <label for="nombre" class="form-label fw-semibold text-info">
                        Sala
                    </label>
                    <input type="text" name="nombre" id="nombre"
                           class="form-control border border-info shadow-sm"
                           required>
                </div>

                {{-- Campo descripción --}}
                <div>
                    <label for="descripcion" class="form-label fw-semibold text-info">
                        Descripción
                    </label>
                    <input type="text" name="descripcion" id="descripcion"
                           class="form-control border border-info shadow-sm">
                </div>

                {{-- Botones --}}
                <div class="pt-2 d-flex justify-content-between">
                    <button type="submit" class="btn btn-outline-info fw-semibold px-4">
                        Agregar
                    </button>
                    <a href="{{ route('salas.index') }}" class="btn btn-outline-info fw-semibold px-4">
                        Cancelar
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
