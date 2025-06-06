@extends('layouts.app')
@section('titulo', 'Editar Medicamento')
@section('contenido')
<h1 class="mb-4">Editar Medicamento</h1>
<form action="{{ route('medicamentos.update', $medicamento) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del medicamento</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $medicamento->nombre }}" required>
    </div>
    <button class="btn btn-primary">Guardar</button>
</form>
@endsection