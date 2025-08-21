@extends('layouts.app')

@section('title', 'Ver Empleado')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Detalle del Empleado</h2>

    <div class="card border-warning">
        <div class="card-body">
            <form>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">DNI</label>
                        <input type="text" class="form-control" value="{{ $empleado->dni }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" value="{{ $empleado->nombre }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Apellido</label>
                        <input type="text" class="form-control" value="{{ $empleado->apellido }}" readonly>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-4">
                        <label class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" value="{{ $empleado->fecha_nacimiento }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" value="{{ $empleado->telefono }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control" value="{{ $empleado->direccion }}" readonly>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-4">
                        <label class="form-label">País</label>
                        <input type="text" class="form-control" value="{{ $empleado->get_pais->nombre }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Provincia</label>
                        <input type="text" class="form-control" value="{{ $empleado->get_provincia->nombre }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Código Postal</label>
                        <input type="text" class="form-control" 
                               value="{{ $empleado->cod_postal_id ? $empleado->get_codigo_postal->codigo . ' - ' . $empleado->get_codigo_postal->localidad : '' }}" 
                               readonly>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Profesión</label>
                        <input type="text" class="form-control" value="{{ $empleado->get_profesion->nombre_profesion }}" readonly>
                    </div>
                </div>

                <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary mt-4">← Volver al listado</a>
            </form>
            
        </div>
    </div>
</div>
@endsection
