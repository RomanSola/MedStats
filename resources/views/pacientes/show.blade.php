@extends('layouts.app')
@section('titulo', 'Ver Paciente')
@section('contenido')
<h1 class="mb-4">Ver Paciente</h1>
<form action="{{ route('pacientes.show', $paciente) }}">

    <div class="mb-3">
            <label for="dni" class="form-label">DNI</label>
            <input type="text" name="dni" id="dni" class="form-control" value="{{ $paciente->dni }}" readonly>
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $paciente->nombre }}" readonly>
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" value="{{ $paciente->apellido }}" readonly>
            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ $paciente->fecha_nacimiento }}" readonly>
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $paciente->telefono }}" readonly>
            <label for="genero" class="form-label">Género</label>
            <input type="text" name="genero" id="genero" class="form-control" value="{{ $paciente->genero }}" readonly>
        
            <label for="pais" class="form-label">País</label>
            <input type="text" name="pais_id" id="pais" class="form-control" value="{{ $paciente->get_pais->nombre }}" readonly>
            <label for="provincia" class="form-label">Província</label>
            <input type="text" name="provincia_id" id="provincia" class="form-control" value="{{ $paciente->get_provincia->nombre }}" readonly>
            <label for="codigo_postal" class="form-label">Código postal</label>
            @if($paciente->cod_postal_id != null)
            <input type="text" name="cod_postal_id" id="codigo_postal" class="form-control" value="{{ $paciente->get_codigo_postal->codigo }} - {{ $paciente->get_codigo_postal->localidad }}" readonly>
            @else
            <input type="text" name="cod_postal_id" id="codigo_postal" class="form-control" value="" readonly>
            @endif
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ $paciente->direccion }}" readonly>
            
        </div>
</form>
<a href="{{ route('pacientes.index') }}" class="btn btn-primary mb-3">Volver</a>
@endsection