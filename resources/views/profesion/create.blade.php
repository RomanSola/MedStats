@extends('layouts.app')
@section('titulo', 'Crear Profesión')
@section('contenido')

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="mb-4">Agregar Nueva Profesión</h1>
        <form action="{{ route('profesion.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre_profesion" class="form-label">Profesión</label>
                <input type="text" name="nombre_profesion" id="nombre_profesion" class="form-control" required>

                <label for="descripcion" class="form-label">Descripcion</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control">
            </div>

            <div class="mb-3">
                <label for="rol_id" class="form-label">Rol en Quirofano</label>
                <select name="rol_id" id="rol_id" class="form-control">
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

            <button class="btn btn-primary">Agregar</button>
        </form>
    </div>
@endsection
