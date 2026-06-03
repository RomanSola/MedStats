@extends('layouts.app')
@section('title', 'Registrar Nueva Cirugía')
@section('contenido')
    <!--<div class="container mt-4">-->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
                Agregar Nueva Cirugía
            </h1>
        </div>

        {{-- Contenedor --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('cirugias.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        {{-- Paciente --}}
                        <div class="col-md-4">
                            <label for="paciente_id" class="form-label">Paciente</label>
                            <select name="paciente_id" id="paciente_id" class="form-control select2">
                                <option value="">Seleccione el Paciente</option>
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}"
                                        {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                                        {{ $paciente->nombre }} {{ $paciente->apellido }}
                                        DNI: {{ $paciente->dni }}
                                        {{ $paciente->fecha_nacimiento ? ' - ' . \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age . ' años' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('paciente_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Especialidad --}}
                        <div class="col-md-4">
                            <label for="especialidad" class="form-label">Especialidad</label>
                            <select name="especialidad_id" id="especialidad" class="form-control select2">
                                <option value="">Seleccione la especialidad</option>
                                @foreach ($especialidades as $especialidad)
                                    <option value="{{ $especialidad->id }}"
                                        {{ old('especialidad_id') == $especialidad->id ? 'selected' : '' }}>
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

                        {{-- Quirofano --}}
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
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Cirujano --}}
                        <div class="col-md-4">
                            <label for="cirujano_id" class="form-label">Cirujano</label>
                            <select name="cirujano_id" id="cirujano_id" class="form-control select2">
                                <option value="">Seleccione el Cirujano</option>
                                @php $profesionesPermitidas = [1,2]; @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
                                        <option value="{{ $empleado->id }}"
                                            {{ old('cirujano_id') == $empleado->id ? 'selected' : '' }}>
                                            {{ $empleado->nombre }} {{ $empleado->apellido }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('cirujano_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Ayudante 1 --}}
                        <div class="col-md-4">
                            <label for="ayudante_1_id" class="form-label">Ayudante 1</label>
                            <select name="ayudante_1_id" id="ayudante_1_id" class="form-control select2">
                                <option value="">Seleccione el Ayudante 1</option>
                                @php $profesionesPermitidas = [1, 2]; @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
                                        <option value="{{ $empleado->id }}"
                                            {{ old('ayudante_1_id') == $empleado->id ? 'selected' : '' }}>
                                            {{ $empleado->nombre }} {{ $empleado->apellido }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('ayudante_1_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Ayudante 2 --}}
                        <div class="col-md-4">
                            <label for="ayudante_2_id" class="form-label">Ayudante 2</label>
                            <select name="ayudante_2_id" id="ayudante_2_id" class="form-control select2">
                                <option value="">Seleccione el Ayudante 2</option>
                                @php $profesionesPermitidas = [1, 2]; @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
                                        <option value="{{ $empleado->id }}"
                                            {{ old('ayudante_2_id') == $empleado->id ? 'selected' : '' }}>
                                            {{ $empleado->nombre }} {{ $empleado->apellido }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('ayudante_2_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Ayudante 3 --}}
                        <div class="col-md-4">
                            <label for="ayudante_3_id" class="form-label">Ayudante 3</label>
                            <select name="ayudante_3_id" id="ayudante_3_id" class="form-control select2">
                                <option value="">Seleccione el Ayudante 3</option>
                                @php $profesionesPermitidas = [1, 2]; @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
                                        <option value="{{ $empleado->id }}"
                                            {{ old('ayudante_3_id') == $empleado->id ? 'selected' : '' }}>
                                            {{ $empleado->nombre }} {{ $empleado->apellido }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('ayudante_3_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Anestesista --}}
                        <div class="col-md-4">
                            <label for="anestesista_id" class="form-label">Anestesista</label>
                            <select name="anestesista_id" id="anestesista_id" class="form-control select2">
                                <option value="">Seleccione el Anestesista</option>
                                @php $profesionesPermitidas = [3]; @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
                                        <option value="{{ $empleado->id }}"
                                            {{ old('anestesista_id') == $empleado->id ? 'selected' : '' }}>
                                            {{ $empleado->nombre }} {{ $empleado->apellido }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('anestesista_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Tipo de Anestesia --}}
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
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Tipo de Anestesia 2 --}}
                        <div class="col-md-4">
                            <label for="tipo_anestesia_2_id" class="form-label">Tipo de Anestesia 2</label>
                            <select name="tipo_anestesia_2_id" id="tipo_anestesia_2_id" class="form-control select2">
                                <option value="">Seleccione el Tipo de Anestesia</option>
                                @foreach ($tipoAnestesias as $tipoAnestesia)
                                    <option value="{{ $tipoAnestesia->id }}"
                                        {{ old('tipo_anestesia_2_id') == $tipoAnestesia->id ? 'selected' : '' }}>
                                        {{ $tipoAnestesia->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_anestesia_2_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Instrumentador --}}
                        <div class="col-md-4">
                            <label for="instrumentador_id" class="form-label">Instrumentador</label>
                            <select name="instrumentador_id" id="instrumentador_id" class="form-control select2">
                                <option value="">Seleccione el Instrumentador</option>
                                @php $profesionesPermitidas = [4]; @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
                                        <option value="{{ $empleado->id }}"
                                            {{ old('instrumentador_id') == $empleado->id ? 'selected' : '' }}>
                                            {{ $empleado->nombre }} {{ $empleado->apellido }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('instrumentador_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Instrumentador 2 --}}
                        <div class="col-md-4">
                            <label for="instrumentador_2_id" class="form-label">Instrumentador 2</label>
                            <select name="instrumentador_2_id" id="instrumentador_2_id" class="form-control select2">
                                <option value="">Seleccione el Instrumentador</option>
                                @php $profesionesPermitidas = [4]; @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
                                        <option value="{{ $empleado->id }}"
                                            {{ old('instrumentador_2_id') == $empleado->id ? 'selected' : '' }}>
                                            {{ $empleado->nombre }} {{ $empleado->apellido }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('instrumentador_2_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Enfermero --}}
                        <div class="col-md-4">
                            <label for="enfermero_id" class="form-label">Enfermero</label>
                            <select name="enfermero_id" id="enfermero_id" class="form-control select2">
                                <option value="">Seleccione el Enfermero</option>
                                @php $profesionesPermitidas = [5]; @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
                                        <option value="{{ $empleado->id }}"
                                            {{ old('enfermero_id') == $empleado->id ? 'selected' : '' }}>
                                            {{ $empleado->nombre }} {{ $empleado->apellido }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('enfermero_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Enfermero 2 --}}
                        <div class="col-md-4">
                            <label for="enfermero_2_id" class="form-label">Enfermero 2</label>
                            <select name="enfermero_2_id" id="enfermero_2_id" class="form-control select2">
                                <option value="">Seleccione el Enfermero</option>
                                @php $profesionesPermitidas = [5]; @endphp
                                @foreach ($empleados as $empleado)
                                    @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
                                        <option value="{{ $empleado->id }}"
                                            {{ old('enfermero_2_id') == $empleado->id ? 'selected' : '' }}>
                                            {{ $empleado->nombre }} {{ $empleado->apellido }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('enfermero_2_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Fecha cirugía --}}
                        <div class="col-md-4">
                            <label for="fecha_cirugia" class="form-label">Fecha de la cirugía</label>
                            <input type="date" name="fecha_cirugia" id="fecha_cirugia" class="form-control"
                                value="{{ old('fecha_cirugia') }}">
                            @error('fecha_cirugia')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Hora cirugía --}}
                        <div class="col-md-4">
                            <label for="hora_cirugia" class="form-label">Hora de la cirugía</label>
                            <input type="time" name="hora_cirugia" id="hora_cirugia" class="form-control"
                                value="{{ old('hora_cirugia') }}">
                            @error('hora_cirugia')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Duración cirugía (horas y minutos) --}}
                        {{-- <div class="col-md-4">
                            <label for="duracion" class="form-label">Duración de la cirugía</label>
                            {{-- Usamos input type="time" para horas:minutos; alternativa: dos selects
                            {{-- <input type="time" name="duracion" id="duracion" class="form-control"
                                step="60" value="{{ old('duracion') }}">
                            <small class="form-text text-muted">Indique la duración (HH:MM)</small>
                            @error('duracion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div> --}}
                        
                        {{-- Duración cirugía (horas y minutos) --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-primary mb-1">Duración de la cirugía</label>

                            <div class="row gx-1 align-items-center">
                                <div class="col-6">
                                    <label for="duracion_horas" class="form-label mb-1 small">Horas</label>
                                    <input type="number" name="duracion_horas" id="duracion_horas"
                                        class="form-control form-control-sm py-0" min="0"
                                        value="{{ old('duracion_horas', 0) }}">
                                </div>
                                <div class="col-6">
                                    <label for="duracion_minutos" class="form-label mb-1 small">Minutos</label>
                                    <input type="number" name="duracion_minutos" id="duracion_minutos"
                                        class="form-control form-control-sm py-0" min="0" max="59"
                                        value="{{ old('duracion_minutos', 0) }}">
                                </div>
                            </div>
                            @error('duracion_horas')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                            @error('duracion_minutos')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>


                        {{-- Urgencia y Óbito juntos (alineados) --}}
                        <div class="col-md-4 d-flex align-items-center">
                            <div class="me-4 text-center">
                                <label class="form-label d-block mb-2">Urgencia</label>
                                <label class="switch switch-urgencia">
                                    <input type="checkbox" name="urgencia" id="urgencia"
                                        {{ old('urgencia') ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                
                                </label>
                                @error('urgencia')
                                    <div><small class="text-danger">{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="text-center">
                                <label class="form-label d-block mb-2">Óbito</label>
                                <label class="switch switch-obito">
                                    <input type="checkbox" name="obito" id="obito"
                                        {{ old('obito') ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                                @error('obito')
                                    <div><small class="text-danger">{{ $message }}</small></div>
                                @enderror
                            </div>
                        </div>
                    </div> {{-- end row --}}

                    <!-- Botones -->
                    <div class="flex justify-between pt-4 gap-2 flex-wrap">
                        <a href="{{ route('cirugias.index') }}"
                            class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                            Cancelar
                        </a>

                        <div class="flex gap-2">
                            <button type="submit" name="action" value="cargar_medicamentos"
                                class="inline-block bg-[#1B7D8F] hover:bg-[#15606e] text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300">
                                Registrar y Cargar Medicamentos
                            </button>
                            <button type="submit"
                                class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300">
                                Registrar Cirugía
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    @push('scripts')
    <!-- Select2 CSS/JS (mantener como estaba) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        /* Select2 styling */
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            height: 38px;
            padding: 5px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }

        /* Switch basic */
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

        /* Default checked color (urgencia) */
        .switch-urgencia input:checked+.slider {
            background-color: #13850bff;
        }

        .switch-urgencia input:focus+.slider {
            box-shadow: 0 0 1px #13850bff;
        }

        .switch-urgencia input:checked+.slider:before {
            transform: translateX(26px);
        }

        /* Óbito: checked color black */
        .switch-obito input:checked+.slider {
            background-color: #000;
        }

        .switch-obito input:focus+.slider {
            box-shadow: 0 0 1px #000;
        }

        .switch-obito input:checked+.slider:before {
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        /* Minor responsive tweak so the urgency/óbito area stacks on small screens */
        @media (max-width: 767px) {
            .d-flex {
                display: flex !important;
                flex-direction: column !important;
                gap: 0.75rem;
                align-items: center;
            }
        }
    </style>
    <script>
$(document).ready(function () {
    // Inicializar Select2
    $('.select2').select2({
        placeholder: "Seleccione una opción",
        allowClear: true,
        width: '100%'
    });

    // Restaurar valores antiguos
    const oldEspecialidadId = "{{ old('especialidad_id') }}";
    const oldProcedimientoId = "{{ old('procedimiento_id') }}";
    const oldProcedimiento2Id = "{{ old('procedimiento_2_id') }}";

    // Función genérica para cargar procedimientos
    function cargarProcedimientos(especialidadId, selector, selectedId = null) {
        fetch(`/medstats-api/procedimientos/${especialidadId}`)
            .then(res => res.json())
            .then(data => {
                const select = $(selector);
                select.html('<option value="">Seleccione un procedimiento</option>');
                data.forEach(p => {
                    const selected = (selectedId == p.id) ? 'selected' : '';
                    select.append(`<option value="${p.id}" ${selected}>${p.nombre_procedimiento}</option>`);
                });
                select.trigger('change'); // Refresca visualmente
            });
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

    const grupos = {
        enfermeros: ['#enfermero_id', '#enfermero_2_id'],
        procedimientos: ['#procedimiento', '#procedimiento2'],
        ayudantes: ['#ayudante_1_id', '#ayudante_2_id', '#ayudante_3_id'],
        instrumentadores: ['#instrumentador_id', '#instrumentador_2_id'],
        anestesias: ['#tipo_anestesia_id', '#tipo_anestesia_2_id']
    };

    // Función para deshabilitar opciones repetidas
    function actualizarOpcionesUnificadas(grupoSelectores) {
    if (grupoSelectores.length < 2) return;

    const valoresSeleccionados = grupoSelectores.map(id => $(id).val()).filter(val => val !== '');

    grupoSelectores.forEach(selector => {
        const select = $(selector);
        const valorActual = select.val();

        // Deshabilitar opciones duplicadas
        select.find('option').each(function () {
            const val = $(this).attr('value');
            if (!val) return;

            const debeDeshabilitar = val !== valorActual && valoresSeleccionados.includes(val);
            $(this).prop('disabled', debeDeshabilitar);
        });

        // Refrescar Select2 correctamente
        if (select.hasClass('select2')) {
            select.select2('destroy'); // Eliminar instancia actual
            select.select2({
                placeholder: "Seleccione una opción",
                allowClear: true,
                width: '100%'
            });
        }
    });
}

    // Activar deshabilitación dinámica en todos los grupos
    Object.values(grupos).forEach(grupo => {
        grupo.forEach(id => $(id).on('change', () => actualizarOpcionesUnificadas(grupo)));
        actualizarOpcionesUnificadas(grupo);
    });

    // Función para detectar duplicados
    function hayDuplicados(valores) {
        const filtrados = valores.filter(v => v !== '');
        return filtrados.some((v, i) => filtrados.indexOf(v) !== i);
    }

    // Validación al enviar el formulario
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
@endpush
@endsection