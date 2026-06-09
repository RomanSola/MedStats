@extends('layouts.app')

@section('title', 'Agregar Nuevo C.P.')

@section('contenido')
    <div class="max-w-xl mx-auto px-4 py-4">

        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
                Agregar Nuevo C.P.
            </h1>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <form action="{{ route('codigos_postales.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="codigo" class="form-label fw-semibold">
                            Código Postal
                        </label>
                        <input type="text" name="codigo" id="codigo"
                               class="form-control border shadow-sm"
                               value="{{ old('codigo') }}">
                        @error('codigo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="localidad" class="form-label fw-semibold">
                            Localidad
                        </label>
                        <input type="text" name="localidad" id="localidad"
                               class="form-control border shadow-sm"
                               value="{{ old('localidad') }}">
                        @error('localidad')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="pais_id" class="form-label fw-semibold">
                            País
                        </label>
                        <select name="pais_id" id="pais_id" class="form-control border shadow-sm">
                            <option value="">Seleccione un país (Opcional)...</option>
                            @foreach($paises as $pais)
                                <option value="{{ $pais->id }}" {{ old('pais_id') == $pais->id ? 'selected' : '' }}>
                                    {{ $pais->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('pais_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="provincia_id" class="form-label fw-semibold">
                            Provincia
                        </label>
                        <select name="provincia_id" id="provincia_id" class="form-control border shadow-sm">
                            <option value="">Seleccione una provincia (Opcional)...</option>
                            @foreach($provincias as $provincia)
                                <option value="{{ $provincia->id }}" {{ old('provincia_id') == $provincia->id ? 'selected' : '' }}>
                                    {{ $provincia->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('provincia_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex justify-between pt-4">
                        <a href="{{ route('codigos_postales.index') }}"
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
@endsection
