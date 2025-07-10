@extends('layouts.app')
@section('titulo', 'Lista de Profesiones')
@section('contenido')
<div class="max-w-7xl mx-auto px-4 py-8">

<h1 class="mb-4">Gestor de Profesiones</h1>
<a href="{{ route('profesion.create') }}" class="btn btn-primary mb-3">Agregar Nueva Profesión</a>
<table class="table">
    <thead>
        <tr>
            <th>Profesión</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($profesiones as $profesion)
        <tr>
            <td>{{ $profesion->nombre_profesion }}</td>
            <td>{{ $profesion->descripcion }}</td>
            <td>
                <!-- Botón Mostrar -->
                <a href="{{ route('profesion.show', $profesion) }}" class="btn btn-primary btn-sm mr-1">Ver</a>
                <!-- Botón Editar -->
                <a href="{{ route('profesion.edit', $profesion) }}" class="btn btn-secondary btn-sm mr-1">Editar</a>
                <form action="{{ route('profesion.destroy', $profesion) }}" method="POST" class="d-inline">
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