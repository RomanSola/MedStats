@extends('layouts.app')
@section('titulo', 'Ver Profesión')
@section('contenido')
<h1 class="mb-4">Ver Profesion</h1>
<form action="{{ route('profesion.show', $profesion) }}">
    <div class="mb-3">
        <label for="nombre_profesion" class="form-label">Profesión</label>
        <input type="text" name="nombre_profesion" id="nombre_profesion" class="form-control" value="{{ $profesion->nombre_profesion }}" readonly>
        <label for="desripcion" class="form-label">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $profesion->descripcion }}" readonly>
    </div>
</form>
<a href="{{ route('profesion.index') }}" class="btn btn-primary mb-3">Volver</a>
@endsection