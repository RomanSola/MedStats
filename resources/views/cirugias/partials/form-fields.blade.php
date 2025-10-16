<div class="row mb-3">
    <!-- Paciente -->
    <div class="col-md-4">
        <label for="paciente_id" class="form-label">Paciente</label>
        <select name="paciente_id" id="paciente_id" class="form-control select2">
            <option value="">Seleccione el Paciente</option>
            @foreach ($pacientes as $paciente)
                <option value="{{ $paciente->id }}" {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
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

    <!-- Especialidad -->
    <div class="col-md-4">
        <label for="especialidad" class="form-label">Especialidad</label>
        <select name="especialidad_id" id="especialidad" class="form-control select2">
            <option value="">Seleccione la especialidad</option>
            @foreach ($especialidades as $especialidad)
                <option value="{{ $especialidad->id }}" {{ old('especialidad_id') == $especialidad->id ? 'selected' : '' }}>
                    {{ $especialidad->nombre }}
                </option>
            @endforeach
        </select>
        @error('especialidad_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Procedimientos -->
    <div class="col-md-4">
        <label for="procedimiento" class="block text-sm font-semibold text-gray-700 mb-1">Procedimiento</label>
        <select name="procedimiento_id" id="procedimiento" class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500">
            <option value="">Seleccione un procedimiento</option>
        </select>
        @error('procedimiento_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Procedimiento 2 -->
    <div class="col-md-4">
        <label for="procedimiento2" class="block text-sm font-semibold text-gray-700 mb-1">Procedimiento 2</label>
        <select name="procedimiento_2_id" id="procedimiento2" class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500">
            <option value="">Seleccione un procedimiento</option>
        </select>
        @error('procedimiento_2_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Quirófano -->
    <div class="col-md-4">
        <label for="quirofano_id" class="form-label">Quirófano</label>
        <select name="quirofano_id" id="quirofano_id" class="form-control select2">
            <option value="">Seleccione el N° de Quirófano</option>
            @foreach ($quirofanos as $quirofano)
                <option value="{{ $quirofano->id }}" {{ old('quirofano_id') == $quirofano->id ? 'selected' : '' }}>
                    {{ $quirofano->nombre }}
                </option>
            @endforeach
        </select>
        @error('quirofano_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Personal Médico - Usando componentes reutilizables -->
    @include('cirugias.partials.medical-staff-fields')
    
    <!-- Fecha y Hora -->
    <div class="col-md-4">
        <label for="fecha_cirugia" class="form-label">Fecha de la cirugía</label>
        <input type="date" name="fecha_cirugia" id="fecha_cirugia" class="form-control" value="{{ old('fecha_cirugia') }}">
        @error('fecha_cirugia')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="hora_cirugia" class="form-label">Hora de la cirugía</label>
        <input type="time" name="hora_cirugia" id="hora_cirugia" class="form-control" value="{{ old('hora_cirugia') }}">
        @error('hora_cirugia')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Duración + Urgencia y Óbito en la misma fila -->
    <div class="col-md-4">
        <div class="row">
            <!-- Duración -->
            <div class="col-6">
                <label class="form-label fw-semibold text-primary mb-1">Duración</label>
                <div class="row gx-1 align-items-center">
                    <div class="col-6">
                        <label for="duracion_horas" class="form-label mb-1 small">Horas</label>
                        <input type="number" name="duracion_horas" id="duracion_horas" class="form-control form-control-sm py-0" min="0" value="{{ old('duracion_horas') }}">
                        @error('duracion_horas')
                            <div><small class="text-danger">{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="duracion_minutos" class="form-label mb-1 small">Minutos</label>
                        <input type="number" name="duracion_minutos" id="duracion_minutos" class="form-control form-control-sm py-0" min="1" max="59" value="{{ old('duracion_minutos') }}">
                        @error('duracion_minutos')
                            <div><small class="text-danger">{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Urgencia y Óbito al lado derecho -->
            <div class="col-6">
                <div class="switches-group-compact">
                    <div class="switch-item">
                        <label class="switch switch-urgencia">
                            <input type="checkbox" name="urgencia" id="urgencia" {{ old('urgencia') ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                        <span class="switch-label">Urgencia</span>
                        @error('urgencia')
                            <div><small class="text-danger">{{ $message }}</small></div>
                        @enderror
                    </div>

                    <div class="switch-item">
                        <label class="switch switch-obito">
                            <input type="checkbox" name="obito" id="obito" {{ old('obito') ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                        <span class="switch-label">Óbito</span>
                        @error('obito')
                            <div><small class="text-danger">{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>