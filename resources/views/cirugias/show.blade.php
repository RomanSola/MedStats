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


                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Procedimiento</label>
                            <input type="text" class="form-control"
                                value="{{ $cirugia->get_procedimiento->nombre_procedimiento }} - {{ $cirugia->get_procedimiento->descripcion }}"
                                readonly>
                        </div>
                        <div class="col-md-4"></div> {{-- columna vacía --}}

                    </div>
                    <div class="col-md-4"></div>
                </div>


                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Quirofano</label>
                            <input type="text" class="form-control"
                                value="{{ $cirugia->get_quirofano->nombre }} - {{ $cirugia->get_quirofano->descripcion }}"
                                readonly>
                        </div>
                        <div class="col-md-4"></div> {{-- columna vacía --}}

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


                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Ayudante 1</label>
                            <input type="text" class="form-control"
                                value="{{ $cirugia->get_ayudante1->nombre ?? '' }} {{ $cirugia->get_ayudante1->apellido ?? '' }}"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">DNI</label>
                            <input type="text" class="form-control" value="{{ $cirugia->get_ayudante1->dni ?? '' }}"
                                readonly>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <label class="form-label">DNI</label>
                        <input type="text" class="form-control border border-danger shadow-sm"
                               value="{{ optional($cirugia->{'get_ayudante'.$i})->dni }}" readonly>
                    </div>
                </div>
                @endforeach

                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Ayudante 2</label>
                            <input type="text" class="form-control"
                                value="{{ $cirugia->get_ayudante2->nombre ?? '' }} {{ $cirugia->get_ayudante2->apellido ?? '' }}"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">DNI</label>
                            <input type="text" class="form-control" value="{{ $cirugia->get_ayudante2->dni ?? '' }}"
                                readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Ayudante 3</label>
                            <input type="text" class="form-control"
                                value="{{ $cirugia->get_ayudante3->nombre ?? '' }} {{ $cirugia->get_ayudante3->apellido ?? '' }}"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">DNI</label>
                            <input type="text" class="form-control" value="{{ $cirugia->get_ayudante3->dni ?? '' }}"
                                readonly>
                        </div>

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

                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Fecha de la cirugia</label>
                            <input type="text" class="form-control" value="{{ $cirugia->fecha_cirugia }}" readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Hora de la cirugia</label>
                            <input type="text" class="form-control" value="{{ $cirugia->hora_cirugia }}" readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Urgencia</label>
                            <input type="text" class="form-control" value="{{ $cirugia->urgencia ? 'Sí' : 'No' }}"
                                readonly>
                        </div>
                        <div class="col-md-4"></div> {{-- columna vacía --}}
                    </div>


            </form>
        </div>
    </div>
</div>
@endsection
