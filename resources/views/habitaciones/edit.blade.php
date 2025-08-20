@extends('layouts.app')

@section('titulo', 'Editar Habitación')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    {{-- Título institucional gris --}}
    <h1 class="text-secondary fw-bold border-bottom border-secondary pb-2 mb-4">
        Editar Habitación
    </h1>

    {{-- Contenedor con borde gris institucional --}}
    <div class="card border-secondary shadow-sm">
        <div class="card-body">

            <form action="{{ route('habitaciones.update', $habitacion) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Número de habitación --}}
                <div>
                    <label for="numero" class="form-label fw-semibold text-secondary">
                        Número de Habitación
                    </label>
                    <input type="text" name="numero" id="numero"
                           class="form-control border border-secondary shadow-sm"
                           value="{{ $habitacion->numero }}" required>
                </div>

                {{-- Sala --}}
                <div>
                    <label for="sala_id" class="form-label fw-semibold text-secondary">
                        Sala
                    </label>
                    <select name="sala_id" id="sala_id"
                            class="form-select border border-secondary shadow-sm">
                        @foreach($salas as $sala)
                            <option value="{{ $sala->id }}"
                                {{ $habitacion->sala_id == $sala->id ? 'selected' : '' }}>
                                {{ $sala->nombre }} - {{ $sala->descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Botón --}}
                <div class="pt-2">
                    <button class="btn btn-outline-secondary fw-semibold px-4">
                        Guardar Cambios
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
