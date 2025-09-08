@extends('layouts.app')

@section('title', 'Editar Quirófano')

@section('contenido')
    <div class="max-w-xl mx-auto px-4 py-4">

        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="flex justify-between items-center mb-6">
                <h1
                    class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
                    Editar Quirófano
                </h1>
            </div>

            {{-- Contenedor con borde gris institucional --}}
            <div class="card border shadow-sm">
                <div class="card-body">

                    <form action="{{ route('quirofanos.update', $quirofano) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        {{-- Campo: Nombre del quirófano --}}
                        <div>
                            <label for="nombre" class="form-label fw-semibold">
                                Nombre del Quirófano
                            </label>
                            <input type="text" name="nombre" id="nombre"
                                   class="form-control border shadow-sm"
                                   value="{{ $quirofano->nombre }}" required>
                            @error('nombre')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        {{-- Campo: Descripción --}}
                        <div>
                            <label for="descripcion" class="form-label fw-semibold text-secondary">
                                Descripción
                            </label>
                            <input type="text" name="descripcion" id="descripcion"
                                   class="form-control border shadow-sm"
                                   value="{{ $quirofano->descripcion }}">
                            @error('descripcion')
                                <small class="text-danger"> {{ $message }} </small>
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
                                Guardar
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
