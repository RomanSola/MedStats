@extends('layouts.app')

@section('titulo', 'Editar Paciente')

@section('contenido')
<div class="max-w-4xl mx-auto px-4 py-8">

    <h1 class="text-2xl font-bold text-blue-800 mb-6">Editar Paciente</h1>

    <form action="{{ route('pacientes.update', $paciente) }}" method="POST"
        class="bg-white shadow rounded-lg p-6 border border-gray-200 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="dni" class="block text-sm font-medium text-gray-700 mb-1">DNI</label>
                <input type="text" name="dni" id="dni" class="w-full rounded-md border-gray-300 px-4 py-2"
                    value="{{ old('dni', $paciente->dni) }}" required>
                @error('dni')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700 mb-1">Fecha de
                    nacimiento</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                    class="w-full rounded-md border-gray-300 px-4 py-2"
                    value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}" required>
                @error('fecha_nacimiento')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="w-full rounded-md border-gray-300 px-4 py-2"
                    value="{{ old('nombre', $paciente->nombre) }}" required>
                @error('nombre')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="apellido" class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="w-full rounded-md border-gray-300 px-4 py-2"
                    value="{{ old('apellido', $paciente->apellido) }}" required>
                @error('apellido')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="w-full rounded-md border-gray-300 px-4 py-2"
                    value="{{ old('telefono', $paciente->telefono) }}">
                @error('telefono')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="genero" class="block text-sm font-medium text-gray-700 mb-1">Género</label>
                <select name="genero" id="genero" class="w-full rounded-md border-gray-300 px-4 py-2">
                    <option value="">Seleccione el género</option>
                    <option value="Masculino" {{ old('genero', $paciente->genero) == 'Masculino' ? 'selected' : '' }}>
                        Masculino</option>
                    <option value="Femenino" {{ old('genero', $paciente->genero) == 'Femenino' ? 'selected' : '' }}>
                        Femenino</option>
                    <option value="X" {{ old('genero', $paciente->genero) == 'X' ? 'selected' : '' }}>X</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                @error('pais')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="provincia" class="block text-sm font-medium text-gray-700 mb-1">Provincia</label>
                <select name="provincia_id" id="provincia" class="w-full rounded-md border-gray-300 px-4 py-2">
                </select>
                @error('provincia_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="codigo_postal" class="block text-sm font-medium text-gray-700 mb-1">Código Postal</label>
                <select name="cod_postal_id" id="codigo_postal" class="w-full rounded-md border-gray-300 px-4 py-2">
                </select>
                @error('cod_postal_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="direccion" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                <input type="text" name="direccion" id="direccion"
                    class="w-full rounded-md border-gray-300 px-4 py-2"
                    value="{{ old('direccion', $paciente->direccion) }}">
            </div>
        </div>

        <div class="flex justify-between pt-4">
            <a href="{{ route('pacientes.index') }}" class="text-blue-700 hover:text-blue-900 font-medium">←
                Cancelar</a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-full shadow transition">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>

<!-- Scripts para combos -->
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