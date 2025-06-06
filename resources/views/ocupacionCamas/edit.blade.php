@extends('layouts.app')
@section('titulo', 'Editar Ocupación')
@section('contenido')
    <h1 class="mb-4">Editar Ocupación de Cama</h1>
    <form action="{{ route('ocupacionCamas.update', $oc_cama) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <!-- ComboBox Cama-->
            <label for="cama_id" class="form-label">Cama</label>
            <select id="cama_id" name="cama_id" class="form-control">
                <option value="">Seleccione una Cama</option>
                @foreach ($camas as $cama)
                    <option value="{{ $cama->id }}"
                        {{ old('cama_id', $oc_cama->cama_id ?? '') == $cama->id ? 'selected' : '' }}>{{ $cama->codigo }}
                    </option>
                @endforeach
            </select>

            <!-- ComboBox Paciente-->
            <label for="paciente_id" class="form-label">Paciente</label>
            <select id="paciente_id" name="paciente_id" class="form-control">
                <option value="">Seleccione un Paciente</option>
                @foreach ($pacientes as $paciente)
                    <option value="{{ $paciente->id }}"
                        {{ old('paciente_id', $oc_cama->paciente_id ?? '') == $paciente->id ? 'selected' : '' }}>
                        {{ $paciente->nombre }} {{ $paciente->apellido }} DNI: {{ $paciente->dni }}
                    </option>
                @endforeach
            </select>

            <label for="fecha_ingreso" class="form-label">Fecha de egreso</label>
            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control"
                value="{{ $oc_cama->fecha_ingreso }}" required>

            <label for="fecha_egreso" class="form-label">Fecha de ingreso</label>
            <input type="date" name="fecha_egreso" id="fecha_egreso" class="form-control"
                value="{{ $oc_cama->fecha_egreso }}">
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observación</label>
            <input type="text" name="observaciones" id="observaciones" class="form-control"
                value="{{ $oc_cama->observaciones }}">
        </div>

        <button class="btn btn-primary">Guardar</button>
    </form>
@endsection
