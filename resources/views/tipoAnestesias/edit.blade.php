@extends('layouts.app')
@section('titulo', 'Editar Tipo de Anestesia')
@section('contenido')
<h1 class="mb-4">Editar Tipo de Anestesia</h1>
<form action="{{ route('tipoAnestesias.update', $anestesia) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nombre" class="form-label">Tipo de Anestesia</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $anestesia->nombre }}" required>
    </div>
    <button class="btn btn-primary">Guardar</button>
</form>
@endsection