@extends('layouts.app')

@section('title', 'Editar Cirugía')

@section('contenido')
    <!--<div class="container mt-4">-->
    <div class="max-w-6xl mx-auto px-4 py-8">

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
                            <label for="paciente_id" class="form-label">Paciente</label>
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

                        {{-- Especialidad --}}
                        <div class="col-md-4">
                            <label for="especialidad" class="form-label">Especialidad</label>
                            <select name="especialidad_id" id="especialidad" class="form-control select2">
                                <option value="">Seleccione la especialidad</option>
                                @foreach ($especialidades as $especialidad)
                                    <option value="{{ $especialidad->id }}"
                                        {{ old('especialidad_id', $cirugia->especialidad_id) == $especialidad->id ? 'selected' : '' }}>
                                        {{ $especialidad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('especialidad_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Procedimiento --}}
                        <div class="col-md-4">
                            <label for="procedimiento" class="form-label">Procedimiento</label>
                            <select name="procedimiento_id" id="procedimiento" class="form-control select2">
                            </select>
                            @error('procedimiento_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        {{-- Procedimiento 2 --}}
                        <div class="col-md-4">
                            <label for="procedimiento2" class="form-label">Procedimiento 2</label>
                            <select name="procedimiento_2_id" id="procedimiento2" class="form-control select2">
                            </select>
                            @error('procedimiento_2_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="quirofano_id" class="form-label">Quirofano</label>
                            <select name="quirofano_id" id="quirofano_id" class="form-control select2">
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
                            <label for="cirujano_id" class="form-label">Cirujano</label>
                            <select name="cirujano_id" id="cirujano_id" class="form-control select2">
                                <option value="">Seleccione el Cirujano</option>
                                @php
                                    $profesionesPermitidas = [1,2]; //Solo Cirujanos
                                @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
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
                            <label for="ayudante_1_id" class="form-label">Ayudante 1</label>
                            <select name="ayudante_1_id" id="ayudante_1_id" class="form-control select2">
                                <option value="">Seleccione el Ayudante 1</option>
                                @php
                                    $profesionesPermitidas = [1,2]; //Solo Ayudantes
                                @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
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
                            <label for="ayudante_2_id" class="form-label">Ayudante 2</label>
                            <select name="ayudante_2_id" id="ayudante_2_id" class="form-control select2">
                                <option value="">Seleccione el Ayudante 2</option>
                                @php
                                    $profesionesPermitidas = [1,2]; //Solo Ayudantes
                                @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
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
                            <label for="ayudante_3_id" class="form-label">Ayudante 3</label>
                            <select name="ayudante_3_id" id="ayudante_3_id" class="form-control select2">
                                <option value="">Seleccione el Ayudante 3</option>
                                @php
                                    $profesionesPermitidas = [1,2]; //Solo Ayudantes
                                @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
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
                            <label for="anestesista_id" class="form-label">Anestesista</label>
                            <select name="anestesista_id" id="anestesista_id" class="form-control select2">
                                <option value="">Seleccione el Anestesista</option>
                                @php
                                    $profesionesPermitidas = [3]; //Solo Anestesistas
                                @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
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
                        {{-- Tipo Anestesia --}}
                        <div class="col-md-4">
                            <label for="tipo_anestesia_id" class="form-label">Tipo de Anestesia</label>
                            <select name="tipo_anestesia_id" id="tipo_anestesia_id" class="form-control select2">
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

                        {{-- Tipo Anestesia 2 --}}
                        <div class="col-md-4">
                            <label for="tipo_anestesia_2_id" class="form-label">Tipo de Anestesia 2</label>
                            <select name="tipo_anestesia_2_id" id="tipo_anestesia_2_id" class="form-control select2">
                                <option value="">Seleccione el Tipo de Anestesia</option>
                                @foreach ($tipoAnestesias as $tipoAnestesia)
                                    <option value="{{ $tipoAnestesia->id }}"
                                        {{ $cirugia->tipo_anestesia_2_id == $tipoAnestesia->id ? 'selected' : '' }}>
                                        {{ $tipoAnestesia->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_anestesia_2_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        {{-- Instrumentador --}}
                        <div class="col-md-4">
                            <label for="instrumentador_id" class="form-label">Instrumentador</label>
                            <select name="instrumentador_id" id="instrumentador_id" class="form-control select2">
                                <option value="">Seleccione el Instrumentador</option>
                                @php
                                    $profesionesPermitidas = [4]; //Solo Instrumentadores
                                @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
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

                        {{-- Instrumentador 2 --}}
                        <div class="col-md-4">
                            <label for="instrumentador_2_id" class="form-label">Instrumentador 2</label>
                            <select name="instrumentador_2_id" id="instrumentador_2_id" class="form-control select2">
                                <option value="">Seleccione el Instrumentador</option>
                                @php
                                    $profesionesPermitidas = [4]; //Solo Instrumentadores
                                @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
                                        <option value="{{ $empleado->id }}"
                                            {{ $cirugia->instrumentador_2_id == $empleado->id ? 'selected' : '' }}>
                                            {{ $empleado->nombre }} {{ $empleado->apellido }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('instrumentador_2_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        {{-- Enfermero --}}
                        <div class="col-md-4">
                            <label for="enfermero_id" class="form-label">Enfermero</label>
                            <select name="enfermero_id" id="enfermero_id" class="form-control select2">
                                <option value="">Seleccione el Enfermero</option>
                                @php
                                    $profesionesPermitidas = [5]; //Solo Enfermeros
                                @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
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

                        {{-- Enfermero 2 --}}
                        <div class="col-md-4">
                            <label for="enfermero_2_id" class="form-label">Enfermero 2</label>
                            <select name="enfermero_2_id" id="enfermero_2_id" class="form-control select2">
                                <option value="">Seleccione el Enfermero</option>
                                @php
                                    $profesionesPermitidas = [5]; //Solo Enfermeros
                                @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
                                        <option value="{{ $empleado->id }}"
                                            {{ $cirugia->enfermero_2_id == $empleado->id ? 'selected' : '' }}>
                                            {{ $empleado->nombre }} {{ $empleado->apellido }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('enfermero_2_id')
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

                        {{-- Duración cirugía (horas y minutos) --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-primary mb-1">Duración de la cirugía</label>

                            <div class="row gx-1 align-items-center">
                                <div class="col-6">
                                    <label for="duracion_horas" class="form-label mb-1 small">Horas</label>
                                    <input type="number" name="duracion_horas" id="duracion_horas"
                                        class="form-control form-control-sm py-0" min="0"
                                        value="{{ old('duracion_horas', intval(explode(':', $cirugia->duracion)[0] ?? 0)) }}">
                                </div>
                                <div class="col-6">
                                    <label for="duracion_minutos" class="form-label mb-1 small">Minutos</label>
                                    <input type="number" name="duracion_minutos" id="duracion_minutos"
                                        class="form-control form-control-sm py-0" min="0" max="59"
                                        value="{{ old('duracion_minutos', intval(explode(':', $cirugia->duracion)[1] ?? 0)) }}">
                                </div>
                            </div>
                            @error('duracion_horas')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                            @error('duracion_minutos')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>

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

                        <div class="col-md-4">
                            <label class="form-label d-block">Óbito</label>
                            <label class="switch">
                                <input type="checkbox" name="obito" id="obito" value="1"
                                    {{ $cirugia->obito ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        @error('obito')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>

                    <div class="flex justify-between pt-4 gap-2 flex-wrap">

                        <a href="{{ route('cirugias.index') }}"
                            class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                            Cancelar
                        </a>
                        <div class="flex gap-2">
                            <button type="submit" name="action" value="cargar_medicamentos"
                                class="bg-[#1B7D8F] hover:bg-[#15606e] text-white font-semibold px-6 py-2 rounded-full shadow-md transition">
                                Guardar y Cargar Medicamentos
                            </button>
                            <button type="submit"
                                class="bg-neutral-700 hover:bg-neutral-800 text-white font-semibold px-6 py-2 rounded-full shadow-md transition">
                                Guardar Cambios
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Select2 CSS/JS (mantener como estaba) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        /* Estilo para el checkbox */
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

    <!-- Scripts para combos dinámicos -->
<script>
    $(document).ready(function () {
        // Inicializar Select2
        $('.select2').select2({
            placeholder: "Seleccione una opción",
            allowClear: true,
            width: '100%'
        });

        // Valores antiguos (old() o $cirugia)
        const oldEspecialidadId = "{{ old('especialidad_id', $cirugia->especialidad_id ?? '') }}";
        const oldProcedimientoId = "{{ old('procedimiento_id', $cirugia->procedimiento_id ?? '') }}";
        const oldProcedimiento2Id = "{{ old('procedimiento_2_id', $cirugia->procedimiento_2_id ?? '') }}";

        // Función genérica para cargar procedimientos
        function cargarProcedimientos(especialidadId, selector, selectedId = null) {
            fetch(`/medstats-api/procedimientos/${especialidadId}`)
                .then(res => res.json())
                .then(data => {
                    const select = $(selector);
                    select.html('<option value="">Seleccione un procedimiento</option>');
                    data.forEach(p => {
                        const selected = (selectedId == p.id) ? 'selected' : '';
                        select.append(`<option value="${p.id}" ${selected}>${p.nombre_procedimiento} - ${p.descripcion}</option>`);
                    });
                    select.trigger('change');
                })
                .catch(err => console.error(`Error cargando ${selector}:`, err));
        }

        // Evento cambio de especialidad
        $('#especialidad').on('change', function () {
            const especialidadId = $(this).val();
            if (especialidadId) {
                cargarProcedimientos(especialidadId, '#procedimiento');
                cargarProcedimientos(especialidadId, '#procedimiento2');
            } else {
                $('#procedimiento, #procedimiento2').html('<option value="">Seleccione un procedimiento</option>');
            }
        });

        // Restaurar valores si hay datos viejos
        if (oldEspecialidadId) {
            $('#especialidad').val(oldEspecialidadId).trigger('change');
            cargarProcedimientos(oldEspecialidadId, '#procedimiento', oldProcedimientoId);
            cargarProcedimientos(oldEspecialidadId, '#procedimiento2', oldProcedimiento2Id);
        }

        // Grupos de selects que deben evitar duplicados
        const grupos = {
            enfermeros: ['#enfermero_id', '#enfermero_2_id'],
            procedimientos: ['#procedimiento', '#procedimiento2'],
            ayudantes: ['#ayudante_1_id', '#ayudante_2_id', '#ayudante_3_id'],
            instrumentadores: ['#instrumentador_id', '#instrumentador_2_id'],
            anestesias: ['#tipo_anestesia_id', '#tipo_anestesia_2_id']
        };

        // Deshabilitar opciones repetidas
        function actualizarOpcionesUnificadas(grupoSelectores) {
            if (grupoSelectores.length < 2) return;

            const valoresSeleccionados = grupoSelectores.map(id => $(id).val()).filter(val => val !== '');

            grupoSelectores.forEach(selector => {
                const select = $(selector);
                const valorActual = select.val();

                select.find('option').each(function () {
                    const val = $(this).attr('value');
                    if (!val) return;
                    const debeDeshabilitar = val !== valorActual && valoresSeleccionados.includes(val);
                    $(this).prop('disabled', debeDeshabilitar);
                });

                if (select.hasClass('select2')) {
                    select.select2('destroy').select2({
                        placeholder: "Seleccione una opción",
                        allowClear: true,
                        width: '100%'
                    });
                } else {
                    select.trigger('change');
                }
            });
        }

        // Activar deshabilitación dinámica
        Object.values(grupos).forEach(grupo => {
            grupo.forEach(id => $(id).on('change', () => actualizarOpcionesUnificadas(grupo)));
            actualizarOpcionesUnificadas(grupo);
        });

        // Validación al enviar el formulario
        function hayDuplicados(valores) {
            const filtrados = valores.filter(v => v !== '');
            return filtrados.some((v, i) => filtrados.indexOf(v) !== i);
        }

        $('form').on('submit', function (e) {
            for (const [nombreGrupo, grupo] of Object.entries(grupos)) {
                const seleccionados = grupo.map(id => $(id).val());
                if (hayDuplicados(seleccionados)) {
                    e.preventDefault();
                    alert(`Los valores seleccionados en "${nombreGrupo}" deben ser diferentes.`);
                    break;
                }
            }
        });
    });
</script>
@endsection