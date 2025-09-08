@extends('layouts.app')

@section('title', 'Crear Quirófano')

@section('contenido')
    <div class="max-w-xl mx-auto px-4 py-4">

        {{-- Título institucional con degradado celeste --}}
        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
                Agregar Nuevo Quirófano
            </h1>
        </div>

        {{-- Contenedor institucional --}}
        <div class="card border shadow-sm">
            <div class="card-body text-dark">

                <form action="{{ route('quirofanos.store') }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- Campo: Nombre --}}
                    <div>
                        <label for="nombre" class="form-label fw-semibold">
                            Nombre del Quirófano
                        </label>
                        <input type="text" name="nombre" id="nombre" class="form-control border shadow-sm" required>
                        @error('nombre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Campo: Descripción --}}
                    <div>
                        <label for="descripcion" class="form-label fw-semibold">
                            Descripción
                        </label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control border shadow-sm">
                        @error('descripcion')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Botones --}}
                    <div class="flex justify-between pt-4">
                        <a href="{{ route('quirofanos.index') }}"
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
