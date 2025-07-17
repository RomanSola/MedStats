@extends('layouts.app')

@section('title', 'Ver Cirugía')

@section('contenido')
    <div class="container mt-4">
        <h2 class="mb-4">Detalle de la cirugía</h2>

        <div class="card border-warning">
            <div class="card-body">
                <form>

                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Paciente</label>
                            <input type="text" class="form-control"
                                value="{{ $cirugia->get_paciente->nombre }} {{ $cirugia->get_paciente->apellido }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">DNI</label>
                            <input type="text" class="form-control" value="{{ $cirugia->get_paciente->dni }}" readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Procedimiento</label>
                            <input type="text" class="form-control"
                                value="{{ $cirugia->get_procedimiento->nombre_procedimiento }} - {{ $cirugia->get_procedimiento->descripcion }}" readonly>
                        </div>
                        <div class="col-md-4"></div> {{-- columna vacía --}}
                    </div>

                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Quirofano</label>
                            <input type="text" class="form-control"
                                value="{{ $cirugia->get_quirofano->nombre }} - {{ $cirugia->get_quirofano->descripcion }}" readonly>
                        </div>
                        <div class="col-md-4"></div> {{-- columna vacía --}}
                    </div>

                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Cirujano</label>
                            <input type="text" class="form-control"
                                value="{{ $cirugia->get_cirujano->nombre }} {{ $cirugia->get_cirujano->apellido }}"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">DNI</label>
                            <input type="text" class="form-control" value="{{ $cirugia->get_cirujano->dni }}" readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Ayudante 1</label>
                            <input type="text" class="form-control"
                                value="{{ $cirugia->get_ayudante1->nombre ?? ''}} {{ $cirugia->get_ayudante1->apellido ?? ''}}"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">DNI</label>
                            <input type="text" class="form-control" value="{{ $cirugia->get_ayudante1->dni ?? '' }}" readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Ayudante 2</label>
                            <input type="text" class="form-control"
                                value="{{ $cirugia->get_ayudante2->nombre ?? '' }} {{ $cirugia->get_ayudante2->apellido ?? '' }}"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">DNI</label>
                            <input type="text" class="form-control" value="{{ $cirugia->get_ayudante2->dni ?? '' }}" readonly>
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
                            <input type="text" class="form-control" value="{{ $cirugia->get_ayudante3->dni ?? '' }}" readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Anestesista</label>
                            <input type="text" class="form-control"
                                value="{{ $cirugia->get_anestesista->nombre }} {{ $cirugia->get_anestesista->apellido }}"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">DNI</label>
                            <input type="text" class="form-control" value="{{ $cirugia->get_anestesista->dni }}"
                                readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Tipo de Anestesia</label>
                            <input type="text" class="form-control" value="{{ $cirugia->get_tipo_anestesia->nombre }}"
                                readonly>
                        </div>
                        <div class="col-md-4"></div> {{-- columna vacía --}}
                    </div>

                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Instrumentador</label>
                            <input type="text" class="form-control"
                                value="{{ $cirugia->get_instrumentador->nombre }} {{ $cirugia->get_instrumentador->apellido }}"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">DNI</label>
                            <input type="text" class="form-control" value="{{ $cirugia->get_instrumentador->dni }}"
                                readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label class="form-label">Enfermero</label>
                            <input type="text" class="form-control"
                                value="{{ $cirugia->get_enfermero->nombre }} {{ $cirugia->get_enfermero->apellido }}"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">DNI</label>
                            <input type="text" class="form-control" value="{{ $cirugia->get_enfermero->dni }}"
                                readonly>
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

                    <div class="text-center mt-4">
                        <a href="{{ route('cirugias.index') }}" class="btn btn-outline-secondary">← Volver al listado</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
