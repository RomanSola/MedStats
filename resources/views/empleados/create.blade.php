@extends('layouts.app')
@section('titulo', 'Crear Empleado')
@section('contenido')
    <h1 class="mb-4">Agregar Nuevo Empleado</h1>
    <form action="{{ route('empleados.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="dni" class="form-label">DNI</label>
            <input type="text" name="dni" id="dni" class="form-control" required>
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" required>
            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required>
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control">
        </div>
        <!-- ComboBox País-->
        <div class="mb-3">
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

        <!-- ComboBox Provincias-->
        <div class="mb-3">
            <label for="provincia" class="form-label">Provincia</label>
            <select name="provincia_id" id="provincia" class="form-control">
            </select>

            <!-- JS para el CB dinamico -->
            <script>
                document.getElementById('pais').addEventListener('change', function() {
                    let paisId = this.value;

                    fetch('/api/provincias/' + paisId)
                        .then(res => res.json())
                        .then(data => {
                            //console.log('Datos recibidos:', data); // 👈 log de prueba
                            const provinciaSelect = document.getElementById('provincia');
                            provinciaSelect.innerHTML = '<option value="">Seleccione una provincia</option>';

                            data.forEach(prov => {
                                provinciaSelect.innerHTML +=
                                    `<option value="${prov.id}">${prov.nombre}</option>`;
                            });
                        });
                });
            </script>
        </div>
        <!-- ComboBox Codigo postal-->
        <div class="mb-3">
            <label for="codigo_postal" class="form-label">Código Postal</label>
            <select name="cod_postal_id" id="codigo_postal" class="form-control">
            </select>
            <!-- Scrip para ComboBox dinamico de Provinicias -->
            <script>
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

            @error('cod_postal_id')
                <small class="text-danger"> {{ $message }} </small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control">
        </div>

        <!-- ComboBox Profesión-->
        <div class="mb-3">
            <label for="profesion" class="form-label">Profesion</label>
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
        <button class="btn btn-primary">Agregar</button>
    </form>
@endsection
