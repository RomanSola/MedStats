@extends('layouts.app')
@section('titulo', 'Crear Tipo Anestesia')
@section('contenido')
<h1 class="mb-4">Agregar Nuevo Tipo Anestesia</h1>
<form action="{{ route( 'tipoAnestesias.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Tipo Anestesia</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
    </div>
    <button class="btn btn-primary">Agregar</button>
</form>
@endsection