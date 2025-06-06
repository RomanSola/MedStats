@extends('layouts.app')
@section('titulo', 'Editar Profesión')
@section('contenido')
<h1 class="mb-4">Editar profesión</h1>
<form action="{{ route('profesion.update', $profesion) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nombre_profesion" class="form-label">Profesión</label>
        <input type="text" name="nombre_profesion" id="nombre_profesion" class="form-control" value="{{ $profesion->nombre_profesion }}" required>
        <label for="descripcion" class="form-label">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $profesion->descripcion }}" >
    </div>
    <button class="btn btn-primary">Guardar</button>
</form>
@endsection