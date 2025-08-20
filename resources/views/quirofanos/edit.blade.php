@extends('layouts.app')

@section('title', 'Editar Quirófano')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    {{-- Título institucional celeste --}}
    <h2 class="text-info fw-bold border-bottom border-info pb-2 mb-4">
        Editar Quirófano
    </h2>

    {{-- Contenedor con borde celeste institucional --}}
    <div class="card border-info shadow-sm">
        <div class="card-body text-dark">

            <form action="{{ route('quirofanos.update', $quirofano) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Campo nombre --}}
                <div>
                    <label for="nombre" class="form-label fw-semibold text-dark">
                        Quirófano
                    </label>
                    <input type="text" name="nombre" id="nombre"
                           class="form-control border border-info shadow-sm"
                           value="{{ $quirofano->nombre }}" required>
                    @error('nombre')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror
                </div>

                {{-- Campo descripción --}}
                <div>
                    <label for="descripcion" class="form-label fw-semibold text-dark">
                        Descripción
                    </label>
                    <input type="text" name="descripcion" id="descripcion"
                           class="form-control border border-info shadow-sm"
                           value="{{ $quirofano->descripcion }}">
                    @error('descripcion')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror
                </div>

                {{-- Botones --}}
                <div class="pt-2 d-flex justify-content-between">
                    <button type="submit" class="btn btn-outline-info fw-semibold px-4">
                        Guardar Cambios
                    </button>
                    <a href="{{ route('quirofanos.index') }}" class="btn btn-outline-info fw-semibold px-4">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
