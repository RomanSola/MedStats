@extends('layouts.app')

@section('title', 'Crear Procedimiento')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Agregar Nuevo Procedimiento</h2>

    <div class="card border-info">
        <div class="card-body">
            <form action="{{ route('procedimientos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nombre_procedimiento" class="form-label">Procedimiento</label>
                    <input type="text" name="nombre_procedimiento" id="nombre_procedimiento" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control">
                </div>

                <button type="submit" class="btn btn-info">Agregar</button>
                <a href="{{ route('procedimientos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            </form>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mt-3">← Volver atrás</a>

        </div>
    </div>
</div>
@endsection
