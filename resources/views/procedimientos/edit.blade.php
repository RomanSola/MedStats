@extends('layouts.app')

@section('title', 'Editar Procedimiento')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    <div class="flex justify-between items-center mb-6">
        <h1
            class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
            Editar Procedimiento
        </h1>
    </div>

    <div class="card border">
        <div class="card-body">
            <form action="{{ route('procedimientos.update', $procedimiento) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre_procedimiento" class="form-label">Procedimiento</label>
                    <input type="text" name="nombre_procedimiento" id="nombre_procedimiento" class="form-control"
                        value="{{ old('nombre_procedimiento', $procedimiento->nombre_procedimiento) }}" >
                    @error('nombre_procedimiento')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control"
                        value="{{ old('descripcion', $procedimiento->descripcion) }}">
                    @error('descripcion')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror
                </div>

                <div class="flex justify-between pt-4">
                    <a href="{{ route('procedimientos.index') }}"
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
