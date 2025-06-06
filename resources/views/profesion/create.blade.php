@extends('layouts.app')
@section('titulo', 'Crear Profesión')
@section('contenido')
<h1 class="mb-4">Agregar Nueva Profesión</h1>
<form action="{{ route( 'profesion.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nombre_profesion" class="form-label">Profesión</label>
        <input type="text" name="nombre_profesion" id="nombre_profesion" class="form-control" required>
        
        <label for="descripcion" class="form-label">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion" class="form-control">
    </div>
    <button class="btn btn-primary">Agregar</button>
</form>
@endsection