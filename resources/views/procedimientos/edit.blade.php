@extends('layouts.app')

@section('title', 'Editar Procedimiento')

@section('contenido')
    <div class="container mt-4">
        <h2 class="mb-4">Editar Procedimiento</h2>

        <div class="card border-info">
            <div class="card-body">
                <form action="{{ route('procedimientos.update', $procedimiento) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nombre_procedimiento" class="form-label">Procedimiento</label>
                        <input type="text" name="nombre_procedimiento" id="nombre_procedimiento" class="form-control"
                            value="{{ $procedimiento->nombre_procedimiento }}" required>
                    </div>
                    @error('nombre_procedimiento')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control"
                            value="{{ $procedimiento->descripcion }}">
                    </div>
                    @error('descripcion')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror

                    <button type="submit" class="btn btn-info">Guardar Cambios</button>
                    <a href="{{ route('procedimientos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
