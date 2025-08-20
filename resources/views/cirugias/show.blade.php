@extends('layouts.app')

@section('title', 'Ver Cirugía')

@section('contenido')
<div class="container py-4">
    {{-- Título institucional rojo --}}
    <h2 class="text-danger fw-bold border-bottom border-danger pb-2 mb-4 text-center">
        Detalle de la cirugía
    </h2>

    {{-- Contenedor con borde rojo institucional --}}
    <div class="card border-danger shadow-sm">
        <div class="card-body text-dark">
            <form>

                {{-- Paciente --}}
                <div class="row g-3 mt-2 justify-content-center">
                    <div class="col-md-4">
                        <label class="form-label">Paciente</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ $cirugia->get_paciente->nombre }} {{ $cirugia->get_paciente->apellido }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">DNI</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ $cirugia->get_paciente->dni }}" readonly>
                    </div>
                </div>

                {{-- Procedimiento --}}
                <div class="row g-3 mt-2 justify-content-center">
                    <div class="col-md-4">
                        <label class="form-label">Procedimiento</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ $cirugia->get_procedimiento->nombre_procedimiento }} - {{ $cirugia->get_procedimiento->descripcion }}" readonly>
                    </div>
                    <div class="col-md-4"></div>
                </div>

                {{-- Quirofano --}}
                <div class="row g-3 mt-2 justify-content-center">
                    <div class="col-md-4">
                        <label class="form-label">Quirofano</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ $cirugia->get_quirofano->nombre }} - {{ $cirugia->get_quirofano->descripcion }}" readonly>
                    </div>
                    <div class="col-md-4"></div>
                </div>

                {{-- Cirujano --}}
                <div class="row g-3 mt-2 justify-content-center">
                    <div class="col-md-4">
                        <label class="form-label">Cirujano</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ $cirugia->get_cirujano->nombre }} {{ $cirugia->get_cirujano->apellido }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">DNI</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ $cirugia->get_cirujano->dni }}" readonly>
                    </div>
                </div>

                {{-- Ayudantes --}}
                @foreach ([1,2,3] as $i)
                <div class="row g-3 mt-2 justify-content-center">
                    <div class="col-md-4">
                        <label class="form-label">Ayudante {{ $i }}</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ optional($cirugia->{'get_ayudante'.$i})->nombre }} {{ optional($cirugia->{'get_ayudante'.$i})->apellido }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">DNI</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ optional($cirugia->{'get_ayudante'.$i})->dni }}" readonly>
                    </div>
                </div>
                @endforeach

                {{-- Anestesista --}}
                <div class="row g-3 mt-2 justify-content-center">
                    <div class="col-md-4">
                        <label class="form-label">Anestesista</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ $cirugia->get_anestesista->nombre }} {{ $cirugia->get_anestesista->apellido }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">DNI</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ $cirugia->get_anestesista->dni }}" readonly>
                    </div>
                </div>

                {{-- Tipo de anestesia --}}
                <div class="row g-3 mt-2 justify-content-center">
                    <div class="col-md-4">
                        <label class="form-label">Tipo de Anestesia</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ $cirugia->get_tipo_anestesia->nombre }}" readonly>
                    </div>
                    <div class="col-md-4"></div>
                </div>

                {{-- Instrumentador --}}
                <div class="row g-3 mt-2 justify-content-center">
                    <div class="col-md-4">
                        <label class="form-label">Instrumentador</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ $cirugia->get_instrumentador->nombre }} {{ $cirugia->get_instrumentador->apellido }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">DNI</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ $cirugia->get_instrumentador->dni }}" readonly>
                    </div>
                </div>

                {{-- Enfermero --}}
                <div class="row g-3 mt-2 justify-content-center">
                    <div class="col-md-4">
                        <label class="form-label">Enfermero</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ $cirugia->get_enfermero->nombre }} {{ $cirugia->get_enfermero->apellido }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">DNI</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ $cirugia->get_enfermero->dni }}" readonly>
                    </div>
                </div>

                {{-- Urgencia --}}
                <div class="row g-3 mt-2 justify-content-center">
                    <div class="col-md-4">
                        <label class="form-label">Urgencia</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ $cirugia->urgencia ? 'Sí' : 'No' }}" readonly>
                    </div>
                    <div class="col-md-4"></div>
                </div>

                {{-- Botón de volver --}}
                <div class="text-center mt-4">
                    <a href="{{ route('cirugias.index') }}" class="btn btn-outline-danger fw-semibold px-4">
                        Volver al listado
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
