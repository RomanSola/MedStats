@extends('layouts.app')

@section('title', 'Editar C.P.')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    <div class="flex justify-between items-center mb-6">
        <h1
            class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
            Editar C.P.
        </h1>
    </div>

    <div class="card border">
        <div class="card-body">
            <form action="{{ route('codigos_postales.update', $codigo_postale->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="codigo" class="form-label">Código Postal</label>
                    <input type="text" name="codigo" id="codigo" class="form-control"
                        value="{{ old('codigo', $codigo_postale->codigo) }}" >
                    @error('codigo')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="localidad" class="form-label">Localidad</label>
                    <input type="text" name="localidad" id="localidad" class="form-control"
                        value="{{ old('localidad', $codigo_postale->localidad) }}" >
                    @error('localidad')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pais_id" class="form-label">País</label>
                    <select name="pais_id" id="pais_id" class="form-control">
                        <option value="">Seleccione un país (Opcional)...</option>
                        @foreach($paises as $pais)
                            <option value="{{ $pais->id }}" {{ old('pais_id', $codigo_postale->pais_id) == $pais->id ? 'selected' : '' }}>
                                {{ $pais->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('pais_id')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="provincia_id" class="form-label">Provincia</label>
                    <select name="provincia_id" id="provincia_id" class="form-control">
                        <option value="">Seleccione una provincia (Opcional)...</option>
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id }}" {{ old('provincia_id', $codigo_postale->provincia_id) == $provincia->id ? 'selected' : '' }}>
                                {{ $provincia->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('provincia_id')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror
                </div>

                <div class="flex justify-between pt-4">
                    <a href="{{ route('codigos_postales.index') }}"
                        class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="bg-neutral-700 hover:bg-neutral-800 text-white font-semibold px-6 py-2 rounded-full shadow-md transition">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
