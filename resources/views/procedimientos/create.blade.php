@extends('layouts.app')
@section('titulo', 'Crear Procedimiento')
@section('contenido')
<h1 class="mb-4">Agregar Nuevo Procedimiento</h1>
<form action="{{ route( 'procedimientos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nombre_procedimiento" class="form-label">Procedimiento</label>
        <input type="text" name="nombre_procedimiento" id="nombre_procedimiento" class="form-control" required>
        
        <label for="descripcion" class="form-label">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion" class="form-control">
    </div>
    <button class="btn btn-primary">Agregar</button>
</form>
@endsection