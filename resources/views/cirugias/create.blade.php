@extends('layouts.app')

@section('title', 'Registrar Nueva Cirugía')

@section('contenido')
    <div class="container mt-4">
        <h2 class="mb-4">Registrar Nueva Cirugía</h2>

        <div class="card border-warning">
            <div class="card-body">
                <form action="{{ route('cirugias.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">

                        <div class="col-md-4">
                            <label for="paciente_id" class="form-label">Paciente</label>
                            <select name="paciente_id" id="paciente_id" class="form-control select2">
                                <option value="">Seleccione el Paciente</option>
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}"
                                        {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                                        {{ $paciente->nombre }}
                                        {{ $paciente->apellido }}
                                        DNI: {{ $paciente->dni }}
                                        {{ $paciente->fecha_nacimiento ? ' - ' . \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age . ' años' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('paciente_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="procedimiento_id" class="form-label">Procedimiento</label>
                            <select name="procedimiento_id" id="procedimiento_id" class="form-control select2">
                                <option value="">Seleccione el procedimiento</option>
                                @foreach ($procedimientos as $procedimiento)
                                    <option value="{{ $procedimiento->id }}"
                                        {{ old('procedimiento_id') == $procedimiento->id ? 'selected' : '' }}>
                                        {{ $procedimiento->nombre_procedimiento }}
                                    </option>
                                @endforeach
                            </select>
                            @error('procedimiento_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="quirofano_id" class="form-label">Quirofano</label>
                            <select name="quirofano_id" id="quirofano_id" class="form-control select2">
                                <option value="">Seleccione el N° de Quirofano</option>
                                @foreach ($quirofanos as $quirofano)
                                    <option value="{{ $quirofano->id }}"
                                        {{ old('quirofano_id') == $quirofano->id ? 'selected' : '' }}>
                                        {{ $quirofano->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('quirofano_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="cirujano_id" class="form-label">Cirujano</label>
                            <select name="cirujano_id" id="cirujano_id" class="form-control select2">
                                <option value="">Seleccione el Cirujano</option>
                                @php
                                    $profesionesPermitidas = [1, 2, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14];
                                @endphp
                                @foreach ($empleados->filter(fn($e) => in_array($e->profesion_id, $profesionesPermitidas)) as $empleado)
                                    <option value="{{ $empleado->id }}"
                                        {{ old('cirujano_id') == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                                    </option>
                                @endforeach
                            </select>
                            @error('cirujano_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="ayudante_1_id" class="form-label">Ayudante 1</label>
                            <select name="ayudante_1_id" id="ayudante_1_id" class="form-control select2">
                                <option value="">Seleccione el Ayudante 1</option>
                                @php
                                    $profesionesPermitidas = [1, 2, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14];
                                @endphp
                                @foreach ($empleados->filter(fn($e) => in_array($e->profesion_id, $profesionesPermitidas)) as $empleado)
                                    <option value="{{ $empleado->id }}"
                                        {{ old('ayudante_1_id') == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ayudante_1_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="ayudante_2_id" class="form-label">Ayudante 2</label>
                            <select name="ayudante_2_id" id="ayudante_2_id" class="form-control select2">
                                <option value="">Seleccione el Ayudante 2</option>
                                @php
                                    $profesionesPermitidas = [1, 2, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14];
                                @endphp
                                @foreach ($empleados->filter(fn($e) => in_array($e->profesion_id, $profesionesPermitidas)) as $empleado)
                                    <option value="{{ $empleado->id }}"
                                        {{ old('ayudante_2_id') == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ayudante_2_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="ayudante_3_id" class="form-label">Ayudante 3</label>
                            <select name="ayudante_3_id" id="ayudante_3_id" class="form-control select2">
                                <option value="">Seleccione el Ayudante 3</option>
                                @php
                                    $profesionesPermitidas = [1, 2, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14];
                                @endphp
                                @foreach ($empleados->filter(fn($e) => in_array($e->profesion_id, $profesionesPermitidas)) as $empleado)
                                    <option value="{{ $empleado->id }}"
                                        {{ old('ayudante_3_id') == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ayudante_3_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="anestesista_id" class="form-label">Anestesista</label>
                            <select name="anestesista_id" id="anestesista_id" class="form-control select2">
                                <option value="">Seleccione el Anestesista</option>
                                @php
                                    $profesionesPermitidas = [4, 5];
                                @endphp
                                @foreach ($empleados->filter(fn($e) => in_array($e->profesion_id, $profesionesPermitidas)) as $empleado)
                                    <option value="{{ $empleado->id }}"
                                        {{ old('anestesista_id') == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                                    </option>
                                @endforeach
                            </select>
                            @error('anestesista_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="tipo_anestesia_id" class="form-label">Tipo de Anestesia</label>
                            <select name="tipo_anestesia_id" id="tipo_anestesia_id" class="form-control select2">
                                <option value="">Seleccione el Tipo de Anestesia</option>
                                @foreach ($tipoAnestesias as $tipoAnestesia)
                                    <option value="{{ $tipoAnestesia->id }}"
                                        {{ old('tipo_anestesia_id') == $tipoAnestesia->id ? 'selected' : '' }}>
                                        {{ $tipoAnestesia->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_anestesia_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="instrumentador_id" class="form-label">Instrumentador</label>
                            <select name="instrumentador_id" id="instrumentador_id" class="form-control select2">
                                <option value="">Seleccione el Instrumentador</option>
                                @php
                                    $profesionesPermitidas = [3];
                                @endphp
                                @foreach ($empleados->filter(fn($e) => in_array($e->profesion_id, $profesionesPermitidas)) as $empleado)
                                    <option value="{{ $empleado->id }}"
                                        {{ old('instrumentador_id') == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                                    </option>
                                @endforeach
                            </select>
                            @error('instrumentador_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="enfermero_id" class="form-label">Enfermero</label>
                            <select name="enfermero_id" id="enfermero_id" class="form-control select2">
                                <option value="">Seleccione el Enfermero</option>
                                @php
                                    $profesionesPermitidas = [4];
                                @endphp
                                @foreach ($empleados->filter(fn($e) => in_array($e->profesion_id, $profesionesPermitidas)) as $empleado)
                                    <option value="{{ $empleado->id }}"
                                        {{ old('enfermero_id') == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                                    </option>
                                @endforeach
                            </select>
                            @error('enfermero_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="fecha_cirugia" class="form-label">Fecha de la cirugía</label>
                            <input type="date" name="fecha_cirugia" id="fecha_cirugia" class="form-control" required>
                        </div>
                        @error('fecha_cirugia')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror

                        <div class="col-md-4">
                            <label for="hora_cirugia" class="form-label">Hora de la cirugia</label>
                            <input type="time" name="hora_cirugia" id="hora_cirugia" class="form-control" required>
                        </div>
                        @error('hora_cirugia')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror

                        <div class="col-md-4">
                            <label class="form-label d-block">Urgencia</label>
                            <label class="switch">
                                <input type="checkbox" name="urgencia" id="urgencia">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        @error('urgencia')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>
                    <button class="btn btn-warning">Agregar</button>
                    <a href="{{ route('cirugias.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Incluir Select2 CSS y JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <style>
        /* Estilo para los combos de búsqueda */
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            height: 38px;
            padding: 5px;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
        
        /* Estilo para el checkbox moderno */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
        }
        
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
        }
        
        input:checked + .slider {
            background-color: #ffc107;
        }
        
        input:focus + .slider {
            box-shadow: 0 0 1px #ffc107;
        }
        
        input:checked + .slider:before {
            transform: translateX(26px);
        }
        
        .slider.round {
            border-radius: 34px;
        }
        
        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    
    <script>
        $(document).ready(function() {
            // Inicializar Select2 en todos los selects con la clase 'select2'
            $('.select2').select2({
                placeholder: "Seleccione una opción",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
