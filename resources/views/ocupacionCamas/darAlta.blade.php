@extends('layouts.app')
@section('titulo', 'Dar de Alta')
@section('contenido')
    <h1 class="mb-4">Dar de alta al paciente</h1>
    <form action="{{ route('ocupacionCamas.update', $oc_cama) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">

            <label for="cama_id" class="form-label">Cama</label>
            <input type="text" class="form-control" value="{{ $oc_cama->get_cama->codigo }}" readonly>
            <input type="hidden" name="cama_id" value="{{ $oc_cama->cama_id }}">

            <label for="paciente_id" class="form-label">Paciente</label>
            <input type="text" class="form-control"
                value="{{ $oc_cama->get_paciente->nombre }} {{ $oc_cama->get_paciente->apellido }}" readonly>
            <input type="hidden" name="paciente_id" value="{{ $oc_cama->paciente_id }}">

            <label for="dni" class="form-label">DNI</label>
            <input type="text" name="dni" id="dni" class="form-control"
                value="{{ $oc_cama->get_paciente->dni }}" readonly>

            <label for="fecha_ingreso" class="form-label">Fecha de ingreso</label>
            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control"
                value="{{ substr($oc_cama->fecha_ingreso, 0, 10) }}" readonly>

            <label for="fecha_egreso" class="form-label">Fecha de egreso</label>
            <input type="date" name="fecha_egreso" id="fecha_egreso" class="form-control"
                value="{{ old('fecha_egreso', date('Y-m-d')) }}" required>

            <label for="observaciones" class="form-label">Observación</label>
            <input type="text" name="observaciones" id="observaciones" class="form-control"
                value="{{ $oc_cama->observaciones }}" readonly>
        </div>

        <button class="btn btn-primary mb-3">Guardar</button>
        <a href="{{ route('ocupacionCamas.index') }}" class="btn btn-primary mb-3">Volver</a>
    </form>
    </br>
@endsection
