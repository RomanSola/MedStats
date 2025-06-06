@extends('layouts.app')
@section('titulo', 'Crear Sala')
@section('contenido')
<h1 class="mb-4">Agregar Nueva Sala</h1>
<form action="{{ route( 'salas.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Sala</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
        
        <label for="descripcion" class="form-label">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" class="form-control">
    </div>
    <button class="btn btn-primary">Agregar</button>
</form>
@endsection