@extends('layouts.app')

@section('titulo', 'Editar Paciente')

@section('contenido')
<div class="max-w-4xl mx-auto px-4 py-8">

    {{-- Título institucional --}}
    <h1 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md mb-6">
        Editar Paciente
    </h1>

    {{-- Formulario --}}
    <form action="{{ route('pacientes.update', $paciente) }}" method="POST"
        class="bg-white shadow rounded-lg p-6 border border-gray-200 space-y-6">
        @csrf
        @method('PUT')

        {{-- Datos personales --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ([
                ['dni', 'DNI', 'text'],
                ['fecha_nacimiento', 'Fecha de nacimiento', 'date'],
                ['nombre', 'Nombre', 'text'],
                ['apellido', 'Apellido', 'text'],
                ['telefono', 'Teléfono', 'text']
            ] as [$field, $label, $type])
                <div>
                    <label for="{{ $field }}" class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
                    <input type="{{ $type }}" name="{{ $field }}" id="{{ $field }}"
                        class="w-full rounded-md border-gray-300 px-4 py-2"
                        value="{{ old($field, $paciente->$field) }}" {{ $field !== 'telefono' ? 'required' : '' }}>
                    @error($field)
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach

            {{-- Género --}}
            <div>
                <label for="genero" class="block text-sm font-medium text-gray-700 mb-1">Género</label>
                <select name="genero" id="genero" class="w-full rounded-md border-gray-300 px-4 py-2">
                    <option value="">Seleccione el género</option>
                    @foreach (['Masculino', 'Femenino', 'X'] as $opcion)
                        <option value="{{ $opcion }}" {{ old('genero', $paciente->genero) == $opcion ? 'selected' : '' }}>
                            {{ $opcion }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Ubicación --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- País --}}
            <div>
                <label for="pais" class="block text-sm font-medium text-gray-700 mb-1">País</label>
                <select name="pais_id" id="pais" class="w-full rounded-md border-gray-300 px-4 py-2">
                    <option value="">Seleccione un país</option>
                    @foreach ($paises as $pais)
                        <option value="{{ $pais->id }}"
                            {{ old('pais_id', $paciente->pais_id) == $pais->id ? 'selected' : '' }}>
                            {{ $pais->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('pais_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Provincia --}}
            <div>
                <label for="provincia" class="block text-sm font-medium text-gray-700 mb-1">Provincia</label>
                <select name="provincia_id" id="provincia" class="w-full rounded-md border-gray-300 px-4 py-2">
                </select>
                @error('provincia_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Código Postal --}}
            <div>
                <label for="codigo_postal" class="block text-sm font-medium text-gray-700 mb-1">Código Postal</label>
                <select name="cod_postal_id" id="codigo_postal" class="w-full rounded-md border-gray-300 px-4 py-2">
                </select>
                @error('cod_postal_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Dirección --}}
            <div>
                <label for="direccion" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                <input type="text" name="direccion" id="direccion"
                    class="w-full rounded-md border-gray-300 px-4 py-2"
                    value="{{ old('direccion', $paciente->direccion) }}">
            </div>
        </div>

        {{-- Botones --}}
            <div class="flex justify-between pt-4">

                <a href="{{ route('pacientes.index') }}" class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                    Cancelar
                </a>
            <button type="submit"
                class="bg-neutral-700 hover:bg-neutral-800 text-white font-semibold px-6 py-2 rounded-full shadow-md transition">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>

{{-- Scripts para combos --}}
<script>
    const paisSelect = document.getElementById('pais');
    const provinciaSelect = document.getElementById('provincia');
    const codPostalSelect = document.getElementById('codigo_postal');

    const selectedPais = "{{ old('pais_id', $paciente->pais_id) }}";
    const selectedProv = "{{ old('provincia_id', $paciente->provincia_id) }}";
    const selectedCP = "{{ old('cod_postal_id', $paciente->cod_postal_id) }}";

    function cargarProvincias(paisId, selected = null) {
        fetch(`/api/provincias/${paisId}`)
            .then(res => res.json())
            .then(data => {
                provinciaSelect.innerHTML = '<option value="">Seleccione una provincia</option>';
                data.forEach(p => {
                    provinciaSelect.innerHTML +=
                        `<option value="${p.id}" ${p.id == selected ? 'selected' : ''}>${p.nombre}</option>`;
                });

                if (selected) cargarCodPost(paisId, selected, selectedCP);
            });
    }

    function cargarCodPost(paisId, provId, selected = null) {
        fetch(`/api/cod_postal/${paisId}/${provId}`)
            .then(res => res.json())
            .then(data => {
                codPostalSelect.innerHTML = '<option value="">Seleccione un código postal</option>';
                data.forEach(c => {
                    const texto = `${c.codigo}${c.localidad ? ' - ' + c.localidad : ''}`;
                    codPostalSelect.innerHTML +=
                        `<option value="${c.id}" ${c.id == selected ? 'selected' : ''}>${texto}</option>`;
                });
            });
    }

    paisSelect.addEventListener('change', () => {
        cargarProvincias(paisSelect.value);
        codPostalSelect.innerHTML = '<option value="">Seleccione un código postal</option>';
    });

    provinciaSelect.addEventListener('change', () => {
        cargarCodPost(paisSelect.value, provinciaSelect.value);
    });

    if (selectedPais) {
        cargarProvincias(selectedPais, selectedProv);
    }
</script>
@endsection
