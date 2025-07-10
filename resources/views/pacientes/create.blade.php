@extends('layouts.app')

@section('titulo', 'Ingresar Paciente')

@section('contenido')
<div class="max-w-4xl mx-auto px-4 py-8">

    <h1 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2">Registrar Nuevo Paciente</h1>

    <form action="{{ route('pacientes.store') }}" method="POST" class="bg-white shadow rounded-lg p-6 border border-gray-200 space-y-6">
        @csrf

        <!-- Datos personales -->
        <div>
    <label for="dni" class="block text-sm font-semibold text-gray-700 mb-1">DNI</label>
    <input type="text" name="dni" id="dni" maxlength="8" pattern="\d{6,8}"
           class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500 @error('dni') is-invalid @enderror"
           value="{{ old('dni') }}" required title="Debe tener entre 6 y 8 dígitos">
           @error('dni')
                <div class="invalid-feedback">{{ $message }}</div>
           @enderror
</div>

            <div>
                <label for="fecha_nacimiento" class="block text-sm font-semibold text-gray-700 mb-1">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                       class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500"
                       value="{{ old('fecha_nacimiento') }}" required>
                @error('fecha_nacimiento')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" id="nombre"
                       class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500"
                       value="{{ old('nombre') }}" required>
                @error('apellido')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="apellido" class="block text-sm font-semibold text-gray-700 mb-1">Apellido</label>
                <input type="text" name="apellido" id="apellido"
                       class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500"
                       value="{{ old('apellido') }}" required>
                @error('apellido')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="telefono" class="block text-sm font-semibold text-gray-700 mb-1">Teléfono</label>
                <input type="text" name="telefono" id="telefono"
                       class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500"
                       value="{{ old('telefono') }}">
                @error('telefono')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
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
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="provincia" class="block text-sm font-semibold text-gray-700 mb-1">Provincia</label>
                <select name="provincia_id" id="provincia"
                        class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </select>
                @error('provincia_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="codigo_postal" class="block text-sm font-semibold text-gray-700 mb-1">Código Postal</label>
                <select name="cod_postal_id" id="codigo_postal"
                        class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </select>
                @error('cod_postal_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
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
            <a href="{{ route('pacientes.index') }}" class="text-blue-700 hover:text-blue-900 font-medium">← Cancelar</a>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-full shadow transition">
                💾 Registrar Paciente
            </button>
        </div>
    </form>
</div>

<!-- Scripts para combos dinámicos -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#pais').on('change', function () {
        let paisId = $(this).val();
        fetch(`/api/provincias/${paisId}`)
            .then(res => res.json())
            .then(data => {
                let provincia = $('#provincia');
                provincia.html('<option value="">Seleccione una provincia</option>');
                data.forEach(p => {
                    provincia.append(`<option value="${p.id}">${p.nombre}</option>`);
                });
            });
    });

    $('#provincia').on('change', function () {
        let paisId = $('#pais').val();
        let provinciaId = $(this).val();
        fetch(`/api/cod_postal/${paisId}/${provinciaId}`)
            .then(res => res.json())
            .then(data => {
                let codigos = $('#codigo_postal');
                codigos.html('<option value="">Seleccione un código postal</option>');
                data.forEach(c => {
                    let texto = `${c.codigo}${c.localidad ? ' - ' + c.localidad : ''}`;
                    codigos.append(`<option value="${c.id}">${texto}</option>`);
                });
            });
    });
</script>

</div>
@endsection
