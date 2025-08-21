@extends('layouts.app')

@section('titulo', 'Crear Profesión')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    {{-- Título institucional amarillo --}}
    <h1 class="text-warning fw-bold border-bottom border-warning pb-2 mb-4">
        Agregar Nueva Profesión
    </h1>

    {{-- Contenedor con borde amarillo institucional --}}
    <div class="card border-warning shadow-sm">
        <div class="card-body text-dark">

            <form action="{{ route('profesion.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Campo nombre --}}
                <div>
                    <label for="nombre_profesion" class="form-label fw-semibold text-dark">
                        Profesión
                    </label>
                    <input type="text" name="nombre_profesion" id="nombre_profesion"
                           class="form-control border border-warning shadow-sm"
                           required>
                </div>

                {{-- Campo descripción --}}
                <div>
                    <label for="descripcion" class="form-label fw-semibold text-dark">
                        Descripción
                    </label>
                    <input type="text" name="descripcion" id="descripcion"
                           class="form-control border border-warning shadow-sm">
                </div>

                {{-- Campo rol_id --}}
                <div>
                    <label for="rol_id" class="form-label fw-semibold text-dark">
                        Rol en Quirófano
                    </label>
                    <select name="rol_id" id="rol_id"
                            class="form-control border border-warning shadow-sm">
                        <option value="">Seleccione un Rol</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}" {{ old('rol_id') == $rol->id ? 'selected' : '' }}>
                                {{ $rol->rol }}
                            </option>
                        @endforeach
                    </select>
                    @error('rol_id')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror
                </div>

                {{-- Botones --}}
                <div class="pt-2 d-flex justify-content-between">
                    <button type="submit" class="btn btn-outline-warning fw-semibold px-4">
                        Agregar
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
