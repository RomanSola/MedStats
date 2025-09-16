@extends('layouts.app')

@section('titulo', 'Crear Perfil')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    {{-- Título institucional negro --}}
    <h1 class="text-dark fw-bold border-bottom border-dark pb-2 mb-4">
        Agregar Nuevo Perfil
    </h1>

    {{-- Contenedor con borde negro institucional --}}
    <div class="card border-dark shadow-sm">
        <div class="card-body text-dark">

            <form action="{{ route('UsuarioPerfil.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Campo perfil --}}
                <div>
                    <label for="perfil" class="form-label fw-semibold text-dark">
                        Perfil
                    </label>
                    <input type="text" name="perfil" id="perfil"
                           class="form-control border border-dark shadow-sm">
                    @error('perfil')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Botón --}}
                <div class="pt-2">
                    <button type="submit" class="btn btn-outline-dark fw-semibold px-4">
                        Agregar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
