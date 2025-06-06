@extends('layouts.app')
@section('titulo', 'Crear Habitación')
@section('contenido')
<h1 class="mb-4">Agregar Nueva Habitación</h1>
<form action="{{ route('habitaciones.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="numero" class="form-label">Número de habitación</label>
        <input type="text" name="numero" id="numero" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="sala_id" class="form-label">Sala</label>
        <select name="sala_id" id="sala_id" class="form-control">
            <option value="">Seleccione una habitación</option>
            @foreach($salas as $sala)
            <option value="{{ $sala->id }}"
                {{ old('sala_id') == $sala->id ? 'selected' : '' }}>
                {{ $sala->nombre }} - {{ $sala->descripcion }}
            </option>
            @endforeach
        </select>
        @error('sala_id')
        <small class="text-danger"> {{ $message }} </small>
        @enderror
    </div>
    <button class="btn btn-primary">Agregar</button>
</form>
@endsection