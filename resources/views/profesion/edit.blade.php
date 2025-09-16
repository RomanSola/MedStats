@extends('layouts.app')

@section('title', 'Editar Profesión')

@section('contenido')
<div class="container mt-4">

    <div class="flex justify-between items-center mb-6">
        <h1
            class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
            Editar Profesión
        </h1>
    </div>

    <div class="card border">
        <div class="card-body">
            <form action="{{ route('profesion.update', $profesion) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre_profesion" class="form-label">Profesión</label>
                    <input type="text" name="nombre_profesion" id="nombre_profesion" class="form-control"
                           value="{{ old('nombre_profesion', $profesion->nombre_profesion) }}">
                    @error('nombre_profesion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control"
                           value="{{ old('descripcion', $profesion->descripcion) }}">
                    @error('descripcion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="rol_id" class="form-label">Rol en Quirófano</label>
                    <select name="rol_id" id="rol_id" class="form-control">
                        <option value="">Seleccione un Rol</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}" {{ old('rol_id', $profesion->rol_id) == $rol->id ? 'selected' : '' }}>
                                {{ $rol->rol }}
                            </option>
                        @endforeach
                    </select>
                    @error('rol_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-between pt-4">
                    <a href="{{ route('profesion.index') }}" class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="bg-neutral-700 hover:bg-neutral-800 text-white font-semibold px-6 py-2 rounded-full shadow-md transition">
                        Guardar
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
