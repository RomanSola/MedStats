@extends('layouts.app')
@section('titulo', 'Editar Procedimiento')
@section('contenido')
<h1 class="mb-4">Editar procedimiento</h1>
<form action="{{ route('procedimientos.update', $procedimiento) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nombre_procedimiento" class="form-label">Profesión</label>
        <input type="text" name="nombre_procedimiento" id="nombre_procedimiento" class="form-control" value="{{ $procedimiento->nombre_procedimiento }}" required>
        <label for="descripcion" class="form-label">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $procedimiento->descripcion }}" >
    </div>
    <button class="btn btn-primary">Guardar</button>
</form>
@endsection