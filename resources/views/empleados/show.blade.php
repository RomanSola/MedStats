@extends('layouts.app')
@section('titulo', 'Ver Empleado')
@section('contenido')
<h1 class="mb-4">Ver Empleado</h1>
<form action="{{ route('empleados.show', $empleado) }}">

    <div class="mb-3">
            <label for="dni" class="form-label">DNI</label>
            <input type="text" name="dni" id="dni" class="form-control" value="{{ $empleado->dni }}" readonly>
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $empleado->nombre }}" readonly>
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" value="{{ $empleado->apellido }}" readonly>
            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ $empleado->fecha_nacimiento }}" readonly>
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $empleado->telefono }}" readonly>
            
            <label for="pais" class="form-label">País</label>
            <input type="text" name="pais_id" id="pais" class="form-control" value="{{ $empleado->get_pais->nombre }}" readonly>
            <label for="provincia" class="form-label">Província</label>
            <input type="text" name="provincia_id" id="provincia" class="form-control" value="{{ $empleado->get_provincia->nombre }}" readonly>
            <label for="codigo_postal" class="form-label">Código postal</label>
            @if($empleado->cod_postal_id != null)
            <input type="text" name="cod_postal_id" id="codigo_postal" class="form-control" value="{{ $empleado->get_codigo_postal->codigo }} - {{ $paciente->get_codigo_postal->localidad }}" readonly>
            @else
            <input type="text" name="cod_postal_id" id="codigo_postal" class="form-control" value="" readonly>
            @endif
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ $empleado->direccion }}" readonly>
            <label for="profesion" class="form-label">Profesión</label>
            <input type="text" name="profesion_id" id="profesion" class="form-control" value="{{ $empleado->get_profesion->nombre_profesion }}" readonly>
        
        </div>
</form>
<a href="{{ route('empleados.index') }}" class="btn btn-primary mb-3">Volver</a>
@endsection