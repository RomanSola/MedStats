@extends('layouts.app')

@section('title', 'Crear Empleado')

@section('contenido')

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2 px-2">
                Agregar Nuevo Empleado</h1>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('empleados.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" name="dni" id="dni" class="form-control" maxlength="8"
                                value="{{ old('dni') }}" pattern="\d{6,8}"
                                title="Debe tener entre 6 y 8 dígitos numéricos">
                            <div id="dni-error-js" class="form-text text-danger"></div>
                            @error('dni')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control"
                                value="{{ old('nombre') }}">
                            @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" name="apellido" id="apellido" class="form-control"
                                value="{{ old('apellido') }}">
                            @error('apellido')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                                value="{{ old('fecha_nacimiento') }}">
                            @error('fecha_nacimiento')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" maxlength="15"
                                pattern="^\d{1,15}$" inputmode="numeric" autocomplete="tel" value="{{ old('telefono') }}">
                            @error('telefono')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="form-control"
                                value="{{ old('direccion') }}">
                        </div>
                    </div>
                    <!-- Ubicación -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="pais" class="block text-sm font-semibold text-gray-700 mb-1">País</label>
                            <select name="pais_id" id="pais"
                                class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500">
                                <option value="">Seleccione un país</option>
                                @foreach ($paises as $pais)
                                    <option value="{{ $pais->id }}"
                                        {{ old('pais_id') == $pais->id ? 'selected' : '' }}>
                                        {{ $pais->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pais_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <label for="provincia" class="block text-sm font-semibold text-gray-700 mb-1">Provincia</label>
                            <select name="provincia_id" id="provincia"
                                class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500">
                            </select>
                            @error('provincia_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <label for="codigo_postal" class="block text-sm font-semibold text-gray-700 mb-1">Código
                                Postal</label>
                            <select name="cod_postal_id" id="codigo_postal"
                                class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500">
                            </select>
                            @error('cod_postal_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="profesion" class="form-label">Profesión</label>
                        <select name="profesion_id" id="profesion" class="form-control">
                            <option value="">Seleccione una Profesión</option>
                            @foreach ($profesiones as $profesion)
                                <option value="{{ $profesion->id }}"
                                    {{ old('profesion_id') == $profesion->id ? 'selected' : '' }}>
                                    {{ $profesion->nombre_profesion }}
                                </option>
                            @endforeach
                        </select>
                        @error('profesion_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="matricula" class="form-label">Matrícula <span class="text-muted">(opcional)</span></label>
                        <input type="number" name="matricula" id="matricula" class="form-control"
                            value="{{ old('matricula') }}" placeholder="Ingrese la matrícula profesional">
                        @error('matricula')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex justify-between pt-4">
                        <a href="{{ route('empleados.index') }}"
                            class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                            style="text-decoration: none;">
                            Agregar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Scripts para combos dinámicos -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let oldPaisId = "{{ old('pais_id') }}";
            let oldProvinciaId = "{{ old('provincia_id') }}";
            let oldCodPostalId = "{{ old('cod_postal_id') }}";

            function cargarProvincias(paisId, selectedProvinciaId = null, callback = null) {
                fetch(`/medstats-api/provincias/${paisId}`)
                    .then(res => res.json())
                    .then(data => {
                        let provincia = $('#provincia');
                        provincia.html('<option value="">Seleccione una provincia</option>');

                        data.forEach(p => {
                            let selected = (selectedProvinciaId == p.id) ? 'selected' : '';
                            provincia.append(
                                `<option value="${p.id}" ${selected}>${p.nombre}</option>`);
                        });

                        if (callback) callback();
                    });
            }

            function cargarCodPostales(paisId, provinciaId, selectedCodPostalId = null) {
                fetch(`/medstats-api/cod_postal/${paisId}/${provinciaId}`)
                    .then(res => res.json())
                    .then(data => {
                        let codigos = $('#codigo_postal');
                        codigos.html('<option value="">Seleccione un código postal</option>');

                        data.forEach(c => {
                            let texto = `${c.codigo}${c.localidad ? ' - ' + c.localidad : ''}`;
                            let selected = (selectedCodPostalId == c.id) ? 'selected' : '';
                            codigos.append(`<option value="${c.id}" ${selected}>${texto}</option>`);
                        });
                    });
            }

            // Evento cuando cambia el país
            $('#pais').on('change', function() {
                let paisId = $(this).val();
                $('#provincia').html('<option value="">Cargando...</option>');
                $('#codigo_postal').html('<option value="">Seleccione un código postal</option>');
                if (paisId) {
                    cargarProvincias(paisId);
                }
            });

            // Evento cuando cambia la provincia
            $('#provincia').on('change', function() {
                let paisId = $('#pais').val();
                let provinciaId = $(this).val();
                $('#codigo_postal').html('<option value="">Cargando...</option>');
                if (paisId && provinciaId) {
                    cargarCodPostales(paisId, provinciaId);
                }
            });

            // Restaurar valores si hay datos viejos
            if (oldPaisId) {
                $('#pais').val(oldPaisId);
                cargarProvincias(oldPaisId, oldProvinciaId, function() {
                    if (oldProvinciaId) {
                        cargarCodPostales(oldPaisId, oldProvinciaId, oldCodPostalId);
                    }
                });
            }
        });
    </script>
@endsection
