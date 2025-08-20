@extends('layouts.app')

@section('title', 'Crear Empleado')

@section('contenido')
<div class="container mt-4">
    
     <h2 class="text-warning fw-bold border-bottom border-warning pb-2 mb-4">
        Agregar Nuevo Empleado
    </h2>

    <div class="card border-warning">
        <div class="card-body">
            <form action="{{ route('empleados.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" name="dni" id="dni" class="form-control" maxlength="8"
                            value="{{ old('dni') }}" required pattern="\d{6,8}" title="Debe tener entre 6 y 8 dígitos numéricos">
                        <div id="dni-error-js" class="form-text text-danger"></div>
                    </div>
                    @error('dni')
                    <small class="text-danger"> {{ $message }} </small>
                    @enderror
                    <div class="col-md-4">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    @error('nombre')
                    <small class="text-danger"> {{ $message }} </small>
                    @enderror
                    <div class="col-md-4">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" required>
                    </div>
                    @error('apellido')
                    <small class="text-danger"> {{ $message }} </small>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control"  maxlength="15" pattern="^\d{1,15}$" required inputmode="numeric" autocomplete="tel">
                        @error('telefono')
                        <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="pais" class="form-label">País</label>
                        <select name="pais_id" id="pais" class="form-control">
                            <option value="">Seleccione un País</option>
                            @foreach ($paises as $pais)
                            <option value="{{ $pais->id }}" {{ old('pais_id') == $pais->id ? 'selected' : '' }}>
                                {{ $pais->nombre }}
                            </option>
                            @endforeach
                        </select>
                        @error('pais_id')
                        <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="provincia" class="form-label">Provincia</label>
                        <select name="provincia_id" id="provincia" class="form-control"></select>
                        @error('provincia_id')
                        <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="codigo_postal" class="form-label">Código Postal</label>
                        <select name="cod_postal_id" id="codigo_postal" class="form-control"></select>
                        @error('cod_postal_id')
                        <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="profesion" class="form-label">Profesión</label>
                    <select name="profesion_id" id="profesion" class="form-control">
                        <option value="">Seleccione una Profesión</option>
                        @foreach ($profesiones as $profesion)
                        <option value="{{ $profesion->id }}" {{ old('profesion_id') == $profesion->id ? 'selected' : '' }}>
                            {{ $profesion->nombre_profesion }}
                        </option>
                        @endforeach
                    </select>
                    @error('profesion_id')
                    <small class="text-danger"> {{ $message }} </small>
                    @enderror
                </div>

                 <div class="pt-2 d-flex justify-content-between">
                    <button class="btn btn-outline-warning fw-semibold px-4">Agregar</button>
                    <a href="{{ route('empleados.index') }}" class="btn btn-outline-warning fw-semibold px-4">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts para combos dinámicos -->
<script>
    document.getElementById('pais').addEventListener('change', function() {
        let paisId = this.value;
        console.log('Pais id:', paisId);
        fetch('/api/provincias/' + paisId)
            .then(res => res.json())
            .then(data => {
                console.log('Datos recibidos:', data);
                const provinciaSelect = document.getElementById('provincia');
                provinciaSelect.innerHTML = '<option value="">Seleccione una provincia</option>';
                data.forEach(prov => {
                    provinciaSelect.innerHTML += `<option value="${prov.id}">${prov.nombre}</option>`;
                });
            });
    });

    document.getElementById('provincia').addEventListener('change', function() {
        const paisId = document.getElementById('pais').value;
        const provinciaId = this.value;
        fetch(`/api/cod_postal/${paisId}/${provinciaId}`)
            .then(res => res.json())
            .then(data => {
                const codigoPostalSelect = document.getElementById('codigo_postal');
                codigoPostalSelect.innerHTML = '<option value="">Seleccione un código postal</option>';
                data.forEach(cod => {
                    const nombre = cod.codigo + (cod.localidad ? ' - ' + cod.localidad : '');
                    codigoPostalSelect.innerHTML += `<option value="${cod.id}">${nombre}</option>`;
                });
            });
    });
</script>
@endsection