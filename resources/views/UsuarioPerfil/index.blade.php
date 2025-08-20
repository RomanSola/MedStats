@extends('layouts.app')

@section('titulo', 'Lista de Perfiles')

@section('contenido')
<div class="container py-4">

    {{-- Título institucional negro --}}
    <h1 class="text-dark fw-bold border-bottom border-dark pb-2 mb-4">
        Gestor de Perfiles de Usuario
    </h1>

    {{-- Contenedor principal con borde negro institucional --}}
    <div class="card border-dark shadow-sm">
        <div class="card-body text-dark">

            {{-- Botón de acción --}}
            <a href="{{ route('UsuarioPerfil.create') }}" class="btn btn-outline-dark fw-semibold mb-3">
                Agregar Nuevo Perfil
            </a>

            {{-- Tabla de perfiles --}}
            <table class="table table-bordered border-dark align-middle">
                <thead class="table-dark text-white">
                    <tr>
                        <th>Perfil</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($perfiles as $perfil)
                    <tr>
                        <td>{{ $perfil->perfil }}</td>
                        <td class="text-center">
                            <a href="{{ route('UsuarioPerfil.edit', $perfil) }}" class="btn btn-outline-dark btn-sm me-1">
                                Editar
                            </a>
                            <form action="{{ route('UsuarioPerfil.destroy', $perfil) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
