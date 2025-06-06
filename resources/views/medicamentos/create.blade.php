@extends('layouts.app')
@section('titulo', 'Crear Medicamento')
@section('contenido')
<h1 class="mb-4">Agregar Nuevo Medicamento</h1>
<form action="{{ route('medicamentos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del medicamento</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
    </div>
    <button class="btn btn-primary">Agregar</button>
</form>
@endsection