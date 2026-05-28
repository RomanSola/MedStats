@extends('layouts.app')

@section('title', 'Agregar Nuevo Medicamento')

@section('contenido')
    <div class="max-w-xl mx-auto px-4 py-4">

        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2 px-2">
                Agregar Nuevo Medicamento</h1>
        </div>

        {{-- Contenedor con borde verde institucional --}}
        <div class="card  shadow-sm">
            <div class="card-body">

                <form action="{{ route('medicamentos.store') }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- Nombre del medicamento --}}
                    <div>
                        <label for="nombre" class="form-label fw-semibold ">
                            Nombre del medicamento
                        </label>
                        <input type="text" name="nombre" id="nombre" class="form-control border  shadow-sm">
                        @error('nombre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Lote --}}
                    <div>
                        <label for="lote" class="form-label fw-semibold ">
                            Lote
                        </label>
                        <input type="text" name="lote" id="lote"
                            class="form-control border shadow-sm"
                            value="{{ old('lote') }}">
                        @error('lote')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Botones --}}
                    <div class="flex justify-between pt-4">

                        <a href="{{ route('medicamentos.index') }}"
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
