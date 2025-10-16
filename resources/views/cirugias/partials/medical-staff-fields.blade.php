<!-- Personal Médico - Campos generados dinámicamente -->
@php
    $staffFields = [
        'cirujano_id' => [1, 'Cirujano'],
        'ayudante_1_id' => [2, 'Ayudante 1'],
        'ayudante_2_id' => [2, 'Ayudante 2'], 
        'ayudante_3_id' => [2, 'Ayudante 3'],
        'anestesista_id' => [3, 'Anestesista'],
        'instrumentador_id' => [4, 'Instrumentador'],
        'instrumentador_2_id' => [4, 'Instrumentador 2'],
        'enfermero_id' => [5, 'Enfermero'],
        'enfermero_2_id' => [5, 'Enfermero 2']
    ];
@endphp

@foreach($staffFields as $fieldName => [$rolId, $label])
<div class="col-md-4">
    <label for="{{ $fieldName }}" class="form-label">{{ $label }}</label>
    <select name="{{ $fieldName }}" id="{{ $fieldName }}" class="form-control select2">
        <option value="">Seleccione {{ strtolower($label) }}</option>
        @foreach ($empleados as $empleado)
            @if ($empleado->get_profesion->rol_id == $rolId)
                <option value="{{ $empleado->id }}" {{ old($fieldName) == $empleado->id ? 'selected' : '' }}>
                    {{ $empleado->nombre }} {{ $empleado->apellido }}
                </option>
            @endif
        @endforeach
    </select>
    @error($fieldName)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
@endforeach

<!-- Tipos de Anestesia -->
<div class="col-md-4">
    <label for="tipo_anestesia_id" class="form-label">Tipo de Anestesia</label>
    <select name="tipo_anestesia_id" id="tipo_anestesia_id" class="form-control select2">
        <option value="">Seleccione el Tipo de Anestesia</option>
        @foreach ($tipoAnestesias as $tipoAnestesia)
            <option value="{{ $tipoAnestesia->id }}" {{ old('tipo_anestesia_id') == $tipoAnestesia->id ? 'selected' : '' }}>
                {{ $tipoAnestesia->nombre }}
            </option>
        @endforeach
    </select>
    @error('tipo_anestesia_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="col-md-4">
    <label for="tipo_anestesia_2_id" class="form-label">Tipo de Anestesia 2</label>
    <select name="tipo_anestesia_2_id" id="tipo_anestesia_2_id" class="form-control select2">
        <option value="">Seleccione el Tipo de Anestesia</option>
        @foreach ($tipoAnestesias as $tipoAnestesia)
            <option value="{{ $tipoAnestesia->id }}" {{ old('tipo_anestesia_2_id') == $tipoAnestesia->id ? 'selected' : '' }}>
                {{ $tipoAnestesia->nombre }}
            </option>
        @endforeach
    </select>
    @error('tipo_anestesia_2_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>