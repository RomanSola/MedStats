@extends('layouts.app')
@section('titulo', 'Editar Habitación')
@section('contenido')
<h1 class="mb-4">Editar Habitación</h1>
<form action="{{ route('habitaciones.update', $habitacion) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        
        <label for="numero" class="form-label">Número de Habitación</label>
        <input type="text" name="numero" id="numero" class="form-control" value="{{ $habitacion->numero }}" required>
        
        <label for="sala_id" class="form-label">Sala</label>
        <select name="sala_id" id="sala_id" class="form-control">
            @foreach($salas as $sala)
            <option value="{{ $sala->id }}"
                {{ $habitacion->sala_id == $sala->id ? 'selected' : '' }}>
                {{ $sala->nombre }} - {{ $sala->descripcion }}
            </option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-primary">Guardar</button>
</form>
@endsection