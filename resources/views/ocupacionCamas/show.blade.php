@extends('layouts.app')
@section('titulo', 'Ver Ocupación de cama')
@section('contenido')
<h1 class="mb-4">Ver Ocupación de cama</h1>
<form action="{{ route('ocupacionCamas.show', $oc_cama) }}">
        <div class="mb-3">
            
            <label for="cama_id" class="form-label">Cama</label>
            <input type="text" name="cama_id" id="cama_id" class="form-control"
                value="{{ $oc_cama->get_cama->codigo }}" readonly>
            
            <label for="paciente_id" class="form-label">Paciente</label>
            <input type="text" name="paciente_id" id="paciente_id" class="form-control"
                value="{{ $oc_cama->get_paciente->nombre }} {{ $oc_cama->get_paciente->apellido }}" readonly>

            <label for="dni" class="form-label">DNI</label>
            <input type="text" name="dni" id="dni" class="form-control"
                value="{{ $oc_cama->get_paciente->dni }}" readonly>

            <label for="fecha_ingreso" class="form-label">Fecha de ingreso</label>
            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control"
                value="{{ substr($oc_cama->fecha_ingreso, 0, 10) }}" readonly>

            <label for="fecha_egreso" class="form-label">Fecha de egreso</label>
            <input type="date" name="fecha_egreso" id="fecha_egreso" class="form-control"
                value="{{ $oc_cama->fecha_egreso ? substr($oc_cama->fecha_egreso, 0, 10) : '' }}" readonly>

            <label for="observaciones" class="form-label">Observación</label>
            <input type="text" name="observaciones" id="observaciones" class="form-control" value="{{ $oc_cama->observaciones }}" readonly>
        </div>
</form>
<a href="{{ route('ocupacionCamas.index') }}" class="btn btn-primary mb-3">Volver</a>
@endsection