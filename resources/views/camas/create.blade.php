@extends('layouts.app')
@section('titulo', 'Crear Cama')
@section('contenido')
<h1 class="mb-4">Agregar Nueva Cama</h1>
<form action="{{ route('camas.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="codigo" class="form-label">Código de Cama</label>
        <input type="text" name="codigo" id="codigo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="habitacion_id" class="form-label">Habitación</label>
        <select name="habitacion_id" id="habitacion_id" class="form-control">
            <option value="">Seleccione una Habitación</option>
            @foreach($habitaciones as $habitacion)
            <option value="{{ $habitacion->id }}"
                {{ old('habitacion_id') == $habitacion->id ? 'selected' : '' }}>
                {{ $habitacion->numero }}
            </option>
            @endforeach
        </select>
        @error('habitacion_id')
        <small class="text-danger"> {{ $message }} </small>
        @enderror
    </div>
    <button class="btn btn-primary">Agregar</button>
</form>
@endsection