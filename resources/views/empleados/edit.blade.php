@extends('layouts.app')

@section('title', 'Editar Empleado')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Editar Empleado</h2>

    <div class="card border-warning">
        <div class="card-body">
            <form action="{{ route('empleados.update', $empleado) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" name="dni" id="dni" class="form-control" value="{{ $empleado->dni }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $empleado->nombre }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" value="{{ $empleado->apellido }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ $empleado->fecha_nacimiento }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $empleado->telefono }}">
                    </div>
                    <div class="col-md-4">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{ $empleado->direccion }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="pais" class="form-label">País</label>
                        <select id="pais" name="pais_id" class="form-control">
                            <option value="">Seleccione un país</option>
                            @foreach ($paises as $pais)
                            <option value="{{ $pais->id }}" {{ old('pais_id', $empleado->pais_id ?? '') == $pais->id ? 'selected' : '' }}>
                                {{ $pais->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="provincia" class="form-label">Provincia</label>
                        <select id="provincia" name="provincia_id" class="form-control"></select>
                    </div>

                    <div class="col-md-4">
                        <label for="codigo_postal" class="form-label">Código Postal</label>
                        <select id="codigo_postal" name="cod_postal_id" class="form-control"></select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="profesion" class="form-label">Profesión</label>
                    <select name="profesion_id" id="profesion" class="form-control">
                        @foreach ($profesiones as $profesion)
                        <option value="{{ $profesion->id }}" {{ $empleado->profesion_id == $profesion->id ? 'selected' : '' }}>
                            {{ $profesion->nombre_profesion }}
                        </option>
                        @endforeach
                    </select>
                    @error('profesion_id')
                    <small class="text-danger"> {{ $message }} </small>
                    @enderror
                </div>

                <button class="btn btn-warning">Guardar Cambios</button>
                <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<script>
    const paisSelect = document.getElementById('pais');
    const provinciaSelect = document.getElementById('provincia');
    const codigoPostalSelect = document.getElementById('codigo_postal');

    const selectedPais = "{{ old('pais_id', $empleado->pais_id ?? '') }}";
    const selectedProvincia = "{{ old('provincia_id', $empleado->provincia_id ?? '') }}";
    const selectedCodPostal = "{{ old('cod_postal_id', $empleado->cod_postal_id ?? '') }}";


    function cargarProvincias(paisId, selectedProv = null) {
        fetch(`/api/provincias/${paisId}`)
            .then(res => res.json())
            .then(data => {
                provinciaSelect.innerHTML = '<option value="">Seleccione una provincia</option>';
                data.forEach(prov => {
                    provinciaSelect.innerHTML += `<option value="${prov.id}" ${prov.id == selectedProv ? 'selected' : ''}>${prov.nombre}</option>`;
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
                    codigoPostalSelect.innerHTML += `<option value="${cp.id}" ${cp.id == selectedCp ? 'selected' : ''}>${nombre}</option>`;
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
@endsection