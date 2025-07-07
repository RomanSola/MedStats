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
                            <label for="pais" class="form-label">Paciente</label>
                            <select name="paciente_id" id="paciente_id" class="form-control">
                                <option value="">Seleccione el Paciente</option>
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}"
                                        {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
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
                                        {{ old('procedimiento_id') == $procedimiento->id ? 'selected' : '' }}>
                                        {{ $procedimiento->nombre_procedimiento }} {{ $procedimiento->descripcion }}
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
                                        {{ old('quirofano_id') == $quirofano->id ? 'selected' : '' }}>
                                        {{ $quirofano->nombre }} {{ $quirofano->descripcion }}
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
                                <option value="">Seleccione el cirujano</option>
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}"
                                        {{ old('cirujano_id') == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }} DNI: {{ $empleado->dni }}
                                    </option>
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
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}"
                                        {{ old('ayudante_1_id') == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }} DNI: {{ $empleado->dni }}
                                    </option>
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
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}"
                                        {{ old('ayudante_2_id') == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }} DNI: {{ $empleado->dni }}
                                    </option>
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
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}"
                                        {{ old('ayudante_3_id') == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }} DNI: {{ $empleado->dni }}
                                    </option>
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
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}"
                                        {{ old('anestesista_id') == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }} DNI: {{ $empleado->dni }}
                                    </option>
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
                            <label for="pais" class="form-label">Instrumentador</label>
                            <select name="instrumentador_id" id="instrumentador_id" class="form-control">
                                <option value="">Seleccione el Instrumentador</option>
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}"
                                        {{ old('instrumentador_id') == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{ $empleado->apellido }} DNI: {{ $empleado->dni }}
                                    </option>
                                @endforeach
                            </select>
                            @error('instrumentador_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="urgencia" class="form-label">Urgencia</label>
                            <input type="checkbox" name="urgencia" id="urgencia" class="form-control" >
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
@endsection
