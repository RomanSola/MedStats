@extends('layouts.app')

@section('title', 'Ver Empleado')

@section('contenido')
    <div class="max-w-5xl mx-auto px-4 py-4">

        
        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2 px-2">
                Detalle del Empleado</h1>
        </div>

        {{-- Contenedor institucional --}}
        <div class="card border shadow-sm">
            <div class="card-body text-dark">

                <form>
                    {{-- Datos personales --}}
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">DNI</label>
                            <input type="text" class="form-control border  shadow-sm"
                                value="{{ $empleado->dni }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control border  shadow-sm"
                                value="{{ $empleado->nombre }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Apellido</label>
                            <input type="text" class="form-control border  shadow-sm"
                                value="{{ $empleado->apellido }}" readonly>
                        </div>
                    </div>

                    {{-- Contacto y nacimiento --}}
                    <div class="row g-3 mt-2">
                        <div class="col-md-4">
                            <label class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control border  shadow-sm"
                                value="{{ $empleado->fecha_nacimiento }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control border  shadow-sm"
                                value="{{ $empleado->telefono }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dirección</label>
                            <input type="text" class="form-control border  shadow-sm"
                                value="{{ $empleado->direccion }}" readonly>
                        </div>
                    </div>

                    {{-- Ubicación --}}
                    <div class="row g-3 mt-2">
                        <div class="col-md-4">
                            <label class="form-label">País</label>
                            <input type="text" class="form-control  shadow-sm"
                                value="{{ $empleado->get_pais->nombre }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Provincia</label>
                            <input type="text" class="form-control border shadow-sm"
                                value="{{ $empleado->get_provincia->nombre }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Código Postal</label>
                            <input type="text" class="form-control border  shadow-sm"
                                value="{{ $empleado->cod_postal_id ? $empleado->get_codigo_postal->codigo . ' - ' . $empleado->get_codigo_postal->localidad : '' }}"
                                readonly>
                        </div>
                    </div>

                    {{-- Profesión --}}
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Profesión</label>
                            <input type="text" class="form-control border  shadow-sm"
                                value="{{ $empleado->get_profesion->nombre_profesion }}" readonly>
                        </div>
                    </div>

                    
                </form>

            </div>
        </div>
    </div>
@endsection
