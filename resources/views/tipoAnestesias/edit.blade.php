@extends('layouts.app')

@section('titulo', 'Editar Tipo de Anestesia')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    {{-- Título institucional verde --}}
    <h1 class="text-success fw-bold border-bottom border-success pb-2 mb-4">
        Editar Tipo de Anestesia
    </h1>

    {{-- Contenedor con borde verde institucional --}}
    <div class="card border-success shadow-sm">
        <div class="card-body text-dark">

            <form action="{{ route('tipoAnestesias.update', $anestesia) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Campo nombre --}}
                <div>
                    <label for="nombre" class="form-label fw-semibold text-dark">
                        Tipo de Anestesia
                    </label>
                    <input type="text" name="nombre" id="nombre"
                           class="form-control border border-success shadow-sm"
                           value="{{ $anestesia->nombre }}" required>
                </div>

                {{-- Botón --}}
                <div class="pt-2">
                    <button type="submit" class="btn btn-outline-success fw-semibold px-4">
                        Guardar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
