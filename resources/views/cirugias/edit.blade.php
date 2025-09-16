@extends('layouts.app')

@section('title', 'Editar Cirugía')

@section('contenido')
    <div class="container mt-4">

        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2 px-2">
                Editar Cirugía</h1>

        </div>


        <div class="card border">
            <div class="card-body">
                <form action="{{ route('cirugias.update', $cirugia) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="pais" class="form-label">Paciente</label>
                            <select name="paciente_id" id="paciente_id" class="form-control select2 ">
                                <option value="">Seleccione el Paciente</option>
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}"
                                        {{ $cirugia->paciente_id == $paciente->id ? 'selected' : '' }}>
                                        {{ $paciente->nombre }} {{ $paciente->apellido }} DNI: {{ $paciente->dni }}
                                    </option>
                                @endforeach
                            </select>
                            @error('paciente_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="pais" class="form-label">Procedimiento</label>
                            <select name="procedimiento_id" id="procedimiento_id" class="form-control">
                                <option value="">Seleccione el procedimiento</option>
                                @foreach ($procedimientos as $procedimiento)
                                    <option value="{{ $procedimiento->id }}"
                                        {{ $cirugia->procedimiento_id == $procedimiento->id ? 'selected' : '' }}>
                                        {{ $procedimiento->nombre_procedimiento }} - {{ $procedimiento->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('procedimiento_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="pais" class="form-label">Quirofano</label>
                            <select name="quirofano_id" id="quirofano_id" class="form-control">
                                <option value="">Seleccione el Quirofano</option>
                                @foreach ($quirofanos as $quirofano)
                                    <option value="{{ $quirofano->id }}"
                                        {{ $cirugia->quirofano_id == $quirofano->id ? 'selected' : '' }}>
                                        {{ $quirofano->nombre }} - {{ $quirofano->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('quirofano_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="pais" class="form-label">Cirujano</label>
                            <select name="cirujano_id" id="cirujano_id" class="form-control">
                                <option value="">Seleccione el Cirujano</option>
                                @php
                                    $profesionesPermitidas = [1]; //Solo Cirujanos
                                @endphp
                                @foreach ($empleados as $empleado)
                                    @if ( in_array( $empleado->get_profesion->rol_id, $profesionesPermitidas ) )
                                    <option value="{{ $empleado->id }}"
                                        {{ $cirugia->cirujano_id == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('cirujano_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="pais" class="form-label">Ayudante 1</label>
                            <select name="ayudante_1_id" id="ayudante_1_id" class="form-control">
                                <option value="">Seleccione el Ayudante 1</option>
                                @php
                                    $profesionesPermitidas = [2]; //Solo Ayudantes
                                @endphp
                                @foreach ($empleados as $empleado)
                                    @if ( in_array( $empleado->get_profesion->rol_id, $profesionesPermitidas ) )
                                    <option value="{{ $empleado->id }}"
                                        {{ $cirugia->ayudante_1_id == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('ayudante_1_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="pais" class="form-label">Ayudante 2</label>
                            <select name="ayudante_2_id" id="ayudante_2_id" class="form-control">
                                <option value="">Seleccione el Ayudante 2</option>
                                @php
                                    $profesionesPermitidas = [2]; //Solo Ayudantes
                                @endphp
                                @foreach ($empleados as $empleado)
                                    @if ( in_array( $empleado->get_profesion->rol_id, $profesionesPermitidas ) )
                                    <option value="{{ $empleado->id }}"
                                        {{ $cirugia->ayudante_2_id == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('ayudante_2_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="pais" class="form-label">Ayudante 3</label>
                            <select name="ayudante_3_id" id="ayudante_3_id" class="form-control">
                                <option value="">Seleccione el Ayudante 3</option>
                                @php
                                    $profesionesPermitidas = [2]; //Solo Ayudantes
                                @endphp
                                @foreach ($empleados as $empleado)
                                    @if ( in_array( $empleado->get_profesion->rol_id, $profesionesPermitidas ) )
                                    <option value="{{ $empleado->id }}"
                                        {{ $cirugia->ayudante_3_id == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('ayudante_3_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="pais" class="form-label">Anestesista</label>
                            <select name="anestesista_id" id="anestesista_id" class="form-control">
                                <option value="">Seleccione el Anestesista</option>
                                @php
                                    $profesionesPermitidas = [3]; //Solo Anestesistas
                                @endphp
                                @foreach ($empleados as $empleado)
                                    @if ( in_array( $empleado->get_profesion->rol_id, $profesionesPermitidas ) )
                                    <option value="{{ $empleado->id }}"
                                        {{ $cirugia->anestesista_id == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('anestesista_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="pais" class="form-label">Tipo de Anestesia</label>
                            <select name="tipo_anestesia_id" id="tipo_anestesia_id" class="form-control">
                                <option value="">Seleccione el Tipo de Anestesia</option>
                                @foreach ($tipoAnestesias as $tipoAnestesia)
                                    <option value="{{ $tipoAnestesia->id }}"
                                        {{ $cirugia->tipo_anestesia_id == $tipoAnestesia->id ? 'selected' : '' }}>
                                        {{ $tipoAnestesia->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_anestesia_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="pais" class="form-label">Instrumentador</label>
                            <select name="instrumentador_id" id="instrumentador_id" class="form-control">
                                <option value="">Seleccione el Instrumentador</option>
                                @php
                                    $profesionesPermitidas = [4]; //Solo Instrumentadores
                                @endphp
                                @foreach ($empleados as $empleado)
                                    @if ( in_array( $empleado->get_profesion->rol_id, $profesionesPermitidas ) )
                                    <option value="{{ $empleado->id }}"
                                        {{ $cirugia->instrumentador_id == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('instrumentador_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="pais" class="form-label">Enfermero</label>
                            <select name="enfermero_id" id="enfermero_id" class="form-control">
                                <option value="">Seleccione el Enfermero</option>
                            @php
                                $profesionesPermitidas = [5]; //Solo Enfermeros
                            @endphp
                            @foreach ($empleados as $empleado)
                                @if ( in_array( $empleado->get_profesion->rol_id, $profesionesPermitidas ) )
                                <option value="{{ $empleado->id }}"
                                    {{ $cirugia->enfermero_id == $empleado->id ? 'selected' : '' }}>
                                    {{ $empleado->nombre }} {{ $empleado->apellido }}
                                </option>
                                @endif
                            @endforeach
                            </select>
                            @error('enfermero_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">

                            <label for="fecha_cirugia" class="form-label">Fecha de la cirugía</label>
                            <input type="date" name="fecha_cirugia" id="fecha_cirugia" class="form-control"
                                value="{{ $cirugia->fecha_cirugia }}">
                        </div>
                        @error('fecha_cirugia')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror

                        <div class="col-md-4">
                            <label for="hora_cirugia" class="form-label">Hora de la cirugia</label>
                            <input type="time" name="hora_cirugia" id="hora_cirugia" class="form-control"
                                value="{{ $cirugia->hora_cirugia }}">
                        </div>
                        @error('hora_cirugia')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror


                        <div class="col-md-4">
                            <label class="form-label d-block">Urgencia</label>
                            <label class="switch">
                                <input type="checkbox" name="urgencia" id="urgencia" value="1"
                                    {{ $cirugia->urgencia ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                        </div>

                        @error('urgencia')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>

                    <div class="flex justify-between pt-4">

                        <a href="{{ route('cirugias.index') }}"
                            class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="bg-neutral-700 hover:bg-neutral-800 text-white font-semibold px-6 py-2 rounded-full shadow-md transition">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
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

        input:checked+.slider {
            background-color: #ffc107;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #ffc107;
        }

        input:checked+.slider:before {
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
            $('#paciente_id').select2({
                placeholder: "Seleccione un paciente",
                allowClear: true
            });
        });
    </script>
@endsection
