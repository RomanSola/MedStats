@extends('layouts.app')
@section('titulo', 'Editar Sala')
@section('contenido')
<h1 class="mb-4">Editar sala</h1>
<form action="{{ route('salas.update', $sala) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nombre" class="form-label">Sala</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $sala->nombre }}" required>
        <label for="descripcion" class="form-label">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $sala->descripcion }}" >
    </div>
    <button class="btn btn-primary">Guardar</button>
</form>
@endsection