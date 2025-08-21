@extends('layouts.app')

@section('titulo', 'Editar Sala')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    {{-- Título institucional celeste --}}
    <h1 class="text-info fw-bold border-bottom border-info pb-2 mb-4">
        Editar Sala
    </h1>

    {{-- Contenedor con borde celeste institucional --}}
    <div class="card border-info shadow-sm">
        <div class="card-body">

            <form action="{{ route('salas.update', $sala) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Campo nombre --}}
                <div>
                    <label for="nombre" class="form-label fw-semibold text-info">
                        Sala
                    </label>
                    <input type="text" name="nombre" id="nombre"
                           class="form-control border border-info shadow-sm"
                           value="{{ $sala->nombre }}" required>
                </div>

                {{-- Campo descripción --}}
                <div>
                    <label for="descripcion" class="form-label fw-semibold text-info">
                        Descripción
                    </label>
                    <input type="text" name="descripcion" id="descripcion"
                           class="form-control border border-info shadow-sm"
                           value="{{ $sala->descripcion }}">
                </div>

                {{-- Botón --}}
                <div class="pt-2">
                    <button class="btn btn-outline-info fw-semibold px-4">
                        Guardar Cambios
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
