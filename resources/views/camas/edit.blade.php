@extends('layouts.app')
@section('titulo', 'Editar Cama')
@section('contenido')
<h1 class="mb-4">Editar Cama</h1>
<form action="{{ route('camas.update', $cama) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="codigo" class="form-label">Código de Cama</label>
        <input type="text" name="codigo" id="codigo" class="form-control" value="{{ $cama->codigo }}" required>
        
        <label for="habitacion_id" class="form-label">Numero de habitación</label>
        <select name="habitacion_id" id="habitacion_id" class="form-control">
            @foreach($habitaciones as $habitacion)
            <option value="{{ $habitacion->id }}"
                {{ $cama->sala_id == $habitacion->id ? 'selected' : '' }}>
                {{ $habitacion->numero }}
            </option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-primary">Guardar</button>
</form>
@endsection