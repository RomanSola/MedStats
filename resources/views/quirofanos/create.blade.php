@extends('layouts.app')

@section('title', 'Crear Quirofano')

@section('contenido')
    <div class="container mt-4">
        <h2 class="mb-4">Agregar Nuevo Quirofano</h2>

        <div class="card border-info">
            <div class="card-body">
                <form action="{{ route('quirofanos.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Quirofano</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    @error('nombre')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control">
                    </div>
                    @error('descripcion')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror

                    <button type="submit" class="btn btn-info">Agregar</button>
                    <a href="{{ route('quirofanos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </form>
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mt-3">← Volver atrás</a>

            </div>
        </div>
    </div>
@endsection
