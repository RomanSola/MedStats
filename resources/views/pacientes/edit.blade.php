@extends('layouts.app')
@section('titulo', 'Editar Paciente')
@section('contenido')
    <h1 class="mb-4">Editar Paciene</h1>
    <form action="{{ route('pacientes.update', $paciente) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="dni" class="form-label">DNI</label>
            <input type="text" name="dni" id="dni" class="form-control" value="{{ $paciente->dni }}" required>
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $paciente->nombre }}"
                required>
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" value="{{ $paciente->apellido }}"
                required>
            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                value="{{ $paciente->fecha_nacimiento }}" required>
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $paciente->telefono }}">
            <!-- ComboBox Género-->
            <label for="genero" class="form-label">Género</label>
            <select name="genero" id="genero" class="form-control">
                <option value="">Seleccione el Género</option>
                <option value="Masculino" {{ $paciente->genero == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ $paciente->genero == 'Femenino' ? 'selected' : '' }}>Femenino</option>
            </select>
            <div class="mb-3">
                <!-- ComboBox País-->
                <label for="pais" class="form-label">País</label>
                <select id="pais" name="pais_id" class="form-control">
                    <option value="">Seleccione un país</option>
                    @foreach ($paises as $pais)
                        <option value="{{ $pais->id }}"
                            {{ old('pais_id', $paciente->pais_id ?? '') == $pais->id ? 'selected' : '' }}>
                            {{ $pais->nombre }}
                        </option>
                    @endforeach
                </select>

                <!-- ComboBox Provincia-->
                <label for="provincia" class="form-label">Província</label>
                <select id="provincia" name="provincia_id" class="form-control">
                    <option value="">Seleccione una provincia</option>
                </select>

                <!-- ComboBox Codigo postal-->
                <label for="codigo_postal" class="form-label">Código Postal</label>
                <select id="codigo_postal" name="cod_postal_id" class="form-control">
                    <option value="">Seleccione un código postal</option>
                </select>

                <script>
                    const paisSelect = document.getElementById('pais');
                    const provinciaSelect = document.getElementById('provincia');
                    const codigoPostalSelect = document.getElementById('codigo_postal');

                    const selectedPais = '{{ old('pais_id', $paciente->pais_id ?? '') }}';
                    const selectedProvincia = '{{ old('provincia_id', $paciente->provincia_id ?? '') }}';
                    const selectedCodPostal = '{{ old('cod_postal_id', $paciente->cod_postal_id ?? '') }}';

                    function cargarProvincias(paisId, selectedProv = null) {
                        fetch(`/api/provincias/${paisId}`)
                            .then(res => res.json())
                            .then(data => {
                                provinciaSelect.innerHTML = '<option value="">Seleccione una provincia</option>';
                                data.forEach(prov => {
                                    provinciaSelect.innerHTML +=
                                        `<option value="${prov.id}" ${prov.id == selectedProv ? 'selected' : ''}>${prov.nombre}</option>`;
                                });

                                if (selectedProv) cargarCodigosPostales(paisId, selectedProv, selectedCodPostal);
                            });
                    }

                    function cargarCodigosPostales(paisId, provinciaId, selectedCp = null) {
                        fetch(`/api/cod_postal/${paisId}/${provinciaId}`)
                            .then(res => res.json())
                            .then(data => {
                                codigoPostalSelect.innerHTML = '<option value="">Seleccione un código postal</option>';
                                data.forEach(cp => {
                                    const nombre = cp.codigo + (cp.localidad ? ' - ' + cp.localidad : '');
                                    codigoPostalSelect.innerHTML +=
                                        `<option value="${cp.id}" ${cp.id == selectedCp ? 'selected' : ''}>${nombre}</option>`;
                                });
                            });
                    }

                    paisSelect.addEventListener('change', function() {
                        cargarProvincias(this.value);
                        codigoPostalSelect.innerHTML = '<option value="">Seleccione un código postal</option>';
                    });

                    provinciaSelect.addEventListener('change', function() {
                        cargarCodigosPostales(paisSelect.value, this.value);
                    });

                    if (selectedPais) {
                        cargarProvincias(selectedPais, selectedProvincia);
                    }
                </script>
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control"
                    value="{{ $paciente->direccion }}">
            </div>

            <button class="btn btn-primary">Guardar</button>
    </form>
@endsection
