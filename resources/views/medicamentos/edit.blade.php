@extends('layouts.app')

@section('title', 'Editar Medicamento')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    {{-- Título institucional verde con degradado --}}
    <h2 class="text-3xl fw-bold bg-gradient-to-r from-green-600 via-green-400 to-green-600 text-transparent bg-clip-text drop-shadow mb-4">
         Editar Medicamento
    </h2>

    {{-- Contenedor con borde verde institucional --}}
    <div class="card border-success shadow-sm">
        <div class="card-body">

            <form action="{{ route('medicamentos.update', $medicamento) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Campo nombre --}}
                <div>
                    <label for="nombre" class="form-label fw-semibold text-success">
                        Nombre del medicamento
                    </label>
                    <input type="text" name="nombre" id="nombre"
                           class="form-control border border-success shadow-sm"
                           value="{{ $medicamento->nombre }}" required>
                </div>

                {{-- Botones --}}
                <div class="pt-2 d-flex justify-content-between">
                    <button type="submit" class="btn btn-outline-success fw-semibold px-4">
                         Guardar Cambios
                    </button>
                    <a href="{{ route('medicamentos.index') }}" class="btn btn-outline-success fw-semibold px-4">
                        ← Cancelar
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
