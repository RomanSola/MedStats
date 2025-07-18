@extends('layouts.app')
@section('titulo', 'Lista de Perfiles')
@section('contenido')
<div class="container mt-4 bg-light border p-4 rounded">
<h1 class="mb-4">Gestor de Perfiles de Usuario</h1>
<a href="{{ route('UsuarioPerfil.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Perfil</a>
<table class="table table-hover table-bordered shadow-sm text-center rounded">
    <thead>
        <tr>
            <th>Perfil</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($perfiles as $perfil)
        <tr>
            <td>{{ $perfil->perfil }}</td>
            <td>
                <!-- Botón Editar -->
                <a href="{{ route('UsuarioPerfil.edit', $perfil) }}" class="btn btn-secondary btn-sm mr-1">Editar</a>
                <form action="{{ route('UsuarioPerfil.destroy', $perfil) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection