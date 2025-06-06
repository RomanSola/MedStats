@extends('layouts.app')
@section('titulo', 'Ver Procedimiento')
@section('contenido')
<h1 class="mb-4">Ver Procedimiento</h1>
<form action="{{ route('procedimientos.show', $procedimiento) }}">
    <div class="mb-3">
        <label for="nombre_procedimiento" class="form-label">Profesión</label>
        <input type="text" name="nombre_procedimiento" id="nombre_procedimiento" class="form-control" value="{{ $procedimiento->nombre_procedimiento }}" readonly>
        <label for="desripcion" class="form-label">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $procedimiento->descripcion }}" readonly>
    </div>
</form>
<a href="{{ route('procedimientos.index') }}" class="btn btn-primary mb-3">Volver</a>
@endsection