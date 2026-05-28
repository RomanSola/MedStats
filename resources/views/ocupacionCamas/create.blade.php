@extends('layouts.app')
@section('titulo', 'Agregar Ingreso a Cama')
@section('contenido')
    <h1 class="mb-4">Agregar Ingreso a Cama</h1>
    <form action="{{ route('ocupacionCamas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <!-- ComboBox Cama-->
        <div class="mb-3">
            <label for="cama_id" class="form-label">Código de cama</label>
            <select name="cama_id" id="cama_id" class="form-control">
                <option value="">Seleccione una Cama</option>
                @foreach ($camas as $cama)
                    <option value="{{ $cama->id }}" {{ old('cama_id') == $cama->id ? 'selected' : '' }}>
                        {{ $cama->codigo }}
                    </option>
                @endforeach
            </select>
            @error('cama_id')
                <small class="text-danger"> {{ $message }} </small>
            @enderror
            <!-- ComboBox Paciente-->
        <div class="mb-3">
            <label for="paciente_id" class="form-label">Paciente</label>
            <select name="paciente_id" id="paciente_id" class="form-control">
                <option value="">Seleccione un Paciente</option>
                @foreach ($pacientes as $paciente)
                    <option value="{{ $paciente->id }}" {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                        {{ $paciente->nombre }} {{ $paciente->apellido }} - DNI: {{ $paciente->dni }}
                    </option>
                @endforeach
            </select>
            @error('paciente_id')
                <small class="text-danger"> {{ $message }} </small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="fecha_ingreso" class="form-label">Fecha de ingreso</label>
            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" required>
            <label for="observaciones" class="form-label">Observación</label>
            <input type="text" name="observaciones" id="observaciones" class="form-control">
        </div>
        <button class="btn btn-primary">Agregar</button>
    </form>
@endsection
