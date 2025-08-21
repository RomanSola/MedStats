@extends('layouts.app')

@section('titulo', 'Crear Habitación')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    {{-- Título institucional gris --}}
    <h1 class="text-secondary fw-bold border-bottom border-secondary pb-2 mb-4">
        Agregar Nueva Habitación
    </h1>

    {{-- Contenedor con borde gris institucional --}}
    <div class="card border-secondary shadow-sm">
        <div class="card-body">

            <form action="{{ route('habitaciones.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Número de habitación --}}
                <div>
                    <label for="numero" class="form-label fw-semibold text-secondary">
                        Número de habitación
                    </label>
                    <input type="text" name="numero" id="numero"
                           class="form-control border border-secondary shadow-sm"
                           required>
                </div>

                {{-- Sala --}}
                <div>
                    <label for="sala_id" class="form-label fw-semibold text-secondary">
                        Sala
                    </label>
                    <select name="sala_id" id="sala_id"
                            class="form-select border border-secondary shadow-sm">
                        <option value="">Seleccione una Sala</option>
                        @foreach($salas as $sala)
                            <option value="{{ $sala->id }}"
                                {{ old('sala_id') == $sala->id ? 'selected' : '' }}>
                                {{ $sala->nombre }} - {{ $sala->descripcion }}
                            </option>
                        @endforeach
                    </select>
                    @error('sala_id')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror
                </div>

                {{-- Botón --}}
                <div class="pt-2">
                    <button class="btn btn-outline-secondary fw-semibold px-4">
                        Agregar Habitación
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
