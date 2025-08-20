@extends('layouts.app')

@section('titulo', 'Editar Perfil')

@section('contenido')
<div class="max-w-xl mx-auto px-4 py-4">

    {{-- Título institucional negro --}}
    <h1 class="text-dark fw-bold border-bottom border-dark pb-2 mb-4">
        Editar Perfil
    </h1>

    {{-- Contenedor con borde negro institucional --}}
    <div class="card border-dark shadow-sm">
        <div class="card-body text-dark">

            <form action="{{ route('UsuarioPerfil.update', $perfil) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Campo perfil --}}
                <div>
                    <label for="perfil" class="form-label fw-semibold text-dark">
                        Perfil
                    </label>
                    <input type="text" name="perfil" id="perfil"
                           class="form-control border border-dark shadow-sm"
                           value="{{ $perfil->perfil }}" required>
                </div>

                {{-- Botón --}}
                <div class="pt-2">
                    <button type="submit" class="btn btn-outline-dark fw-semibold px-4">
                        Guardar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
