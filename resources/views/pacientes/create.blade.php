@extends('layouts.app')

@section('titulo', 'Ingresar Paciente')

@section('contenido')
    <div class="max-w-4xl mx-auto px-4 py-8">

        <h1
            class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2">
            Registrar Nuevo Paciente</h1>
        <br>
        <form action="{{ route('pacientes.store') }}" method="POST"
            class="bg-white shadow rounded-lg p-6 border border-gray-200 space-y-6">
            @csrf

            <!--  Aviso de redirección a asignación de cama -->
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md my-4 shadow">
                <p class="font-semibold">Aviso:</p>
                <p>Después de registrar un nuevo paciente, será redirigido automáticamente a la pantalla para asignarle una
                    cama.</p>
            </div>

            <form action="{{ route('pacientes.store') }}" method="POST"
                class="bg-white shadow rounded-lg p-6 border border-gray-200 space-y-6">
                @csrf

                <!-- Datos personales -->
                <div>
                    <label for="dni" class="block text-sm font-semibold text-gray-700 mb-1">DNI</label>
                    <input type="text" name="dni" id="dni" maxlength="15"
                        class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500 @error('dni') is-invalid @enderror"
                        value="{{ old('dni') }}">
                    @error('dni')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label for="fecha_nacimiento" class="block text-sm font-semibold text-gray-700 mb-1">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                        class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500 @error('fecha_nacimiento') is-invalid @enderror"
                        value="{{ old('fecha_nacimiento') }}"
                        >
                    @error('fecha_nacimiento')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
                    <input type="text" name="nombre" id="nombre"
                        class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500"
                        value="{{ old('nombre') }}">
                    @error('apellido')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label for="apellido" class="block text-sm font-semibold text-gray-700 mb-1">Apellido</label>
                    <input type="text" name="apellido" id="apellido"
                        class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500"
                        value="{{ old('apellido') }}">
                    @error('apellido')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label for="telefono" class="block text-sm font-semibold text-gray-700 mb-1">Teléfono</label>
                    <input type="text" name="telefono" id="telefono"
                        class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500"
                        value="{{ old('telefono') }}">
                    @error('telefono')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label for="genero" class="block text-sm font-semibold text-gray-700 mb-1">Género</label>
                    <select name="genero" id="genero"
                        class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500">
                        <option value="">Seleccione un género</option>
                        <option value="Masculino" {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ old('genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="X" {{ old('genero') == 'X' ? 'selected' : '' }}>X</option>
                    </select>
                </div>




                <!-- Ubicación -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="pais" class="block text-sm font-semibold text-gray-700 mb-1">País</label>
                        <select name="pais_id" id="pais"
                            class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500">
                            <option value="">Seleccione un país</option>
                            @foreach ($paises as $pais)
                                <option value="{{ $pais->id }}" {{ old('pais_id') == $pais->id ? 'selected' : '' }}>
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

                    <div>
                        <label for="direccion" class="block text-sm font-semibold text-gray-700 mb-1">Dirección</label>
                        <input type="text" name="direccion" id="direccion"
                            class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500"
                            value="{{ old('direccion') }}">
                    </div>
                </div>

                <!-- Botón -->
                <div class="flex justify-between pt-4">


                    <a href="{{ route('pacientes.index') }}" class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                        ← Cancelar
                    </a>


                    <button type="submit"
                        class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                        style="text-decoration: none;">
                        Registrar Paciente
                    </button>
                </div>
            </form>
    </div>

    <!-- Scripts para combos dinámicos -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let oldPaisId = "{{ old('pais_id') }}";
            let oldProvinciaId = "{{ old('provincia_id') }}";
            let oldCodPostalId = "{{ old('cod_postal_id') }}";

            function cargarProvincias(paisId, selectedProvinciaId = null, callback = null) {
                fetch(`/api/provincias/${paisId}`)
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
                fetch(`/api/cod_postal/${paisId}/${provinciaId}`)
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

    </div>

@endsection
