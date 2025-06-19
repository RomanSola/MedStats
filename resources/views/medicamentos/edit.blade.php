@extends('layouts.app')

@section('title', 'Editar Medicamento')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Editar Medicamento</h2>

    <div class="card border-secondary">
        <div class="card-body">
            <form action="{{ route('medicamentos.update', $medicamento) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del medicamento</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $medicamento->nombre }}" required>
                </div>

                <button type="submit" class="btn btn-success">Guardar Cambios</button>

                <a href="{{ route('medicamentos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
