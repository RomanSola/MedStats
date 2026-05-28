@extends('layouts.app')

@section('titulo', 'Editar Tipo de Anestesia')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    <div class="flex justify-between items-center mb-6">
        <h1
            class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
            Editar Tipo de Anestesia
        </h1>
    </div>

    <div class="card border shadow-sm">
        <div class="card-body">

            <form action="{{ route('tipoAnestesias.update', $anestesia) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="nombre" class="form-label fw-semibold text-secondary">
                        Tipo de Anestesia
                    </label>
                    <input type="text" name="nombre" id="nombre"
                        class="form-control border shadow-sm"
                        value="{{ $anestesia->nombre }}">
                    @error('nombre')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex justify-between pt-4">
                    <a href="{{ route('tipoAnestesias.index') }}"
                        class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                        style="text-decoration: none;">
                        Guardar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
