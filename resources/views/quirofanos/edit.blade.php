@extends('layouts.app')

@section('title', 'Editar Quirofano')

@section('contenido')
    <div class="container mt-4">
        <h2 class="mb-4">Editar Quirofano</h2>

        <div class="card border-info">
            <div class="card-body">
                <form action="{{ route('quirofanos.update', $quirofano) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Quirofano</label>
                        <input type="text" name="nombre" id="nombre" class="form-control"
                            value="{{ $quirofano->nombre }}" required>
                    </div>
                    @error('nombre')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control"
                            value="{{ $quirofano->descripcion }}">
                    </div>
                    @error('descripcion')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror

                    <button type="submit" class="btn btn-info">Guardar Cambios</button>
                    <a href="{{ route('quirofanos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
