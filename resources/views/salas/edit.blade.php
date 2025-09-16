@extends('layouts.app')

@section('titulo', 'Editar Sala')

@section('contenido')
    <div class="max-w-xl mx-auto px-4 py-4">

        {{-- Título institucional celeste --}}
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="flex justify-between items-center mb-6">
                <h1
                    class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2 px-2">
                    Editar Sala</h1>
            </div>

            {{-- Contenedor con borde celeste institucional --}}
            <div class="card border shadow-sm">
                <div class="card-body">

                    <form action="{{ route('salas.update', $sala) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        {{-- Campo nombre --}}
                        <div>
                            <label for="nombre" class="form-label fw-semibold ">
                                Sala
                            </label>
                            <input type="text" name="nombre" id="nombre"
                                class="form-control border  shadow-sm" value="{{ $sala->nombre }}" >
                            @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Campo descripción --}}
                        <div>
                            <label for="descripcion" class="form-label fw-semibold ">
                                Descripción
                            </label>
                            <input type="text" name="descripcion" id="descripcion"
                                class="form-control border  shadow-sm" value="{{ $sala->descripcion }}">
                        </div>

                        {{-- Botón --}}
                        <div class="flex justify-between pt-4">

                            <a href="{{ route('salas.index') }}" class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                                style="text-decoration: none;">
                                Guardar
                            </button>
                        </div>
                        <div class="pt-2">
                    </form>

                </div>
            </div>
        </div>
    @endsection
