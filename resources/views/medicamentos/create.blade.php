@extends('layouts.app')

@section('title', 'Agregar Nuevo Medicamento')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4 text-blue-600 md:text-green-600 ">Agregar Nuevo Medicamento</h2>

    <div class="card border-success">
        <div class="card-body">
            <form action="{{ route('medicamentos.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del medicamento</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Agregar</button>
                <a href="{{ route('medicamentos.index') }}" class="btn btn-outline-success">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
