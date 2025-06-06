@extends('layouts.app')
@section('titulo', 'Lista de Procedimientos')
@section('contenido')
<h1 class="mb-4">Gestor de Procedimientos</h1>
<a href="{{ route('procedimientos.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Procedimiento</a>
<table class="table">
    <thead>
        <tr>
            <th>Procedimiento</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($procedimientos as $procedimiento)
        <tr>
            <td>{{ $procedimiento->nombre_procedimiento }}</td>
            <td>{{ $procedimiento->descripcion }}</td>
            <td>
                <!-- Botón Mostrar -->
                <a href="{{ route('procedimientos.show', $procedimiento) }}" class="btn btn-primary btn-sm mr-1">Ver</a>
                <!-- Botón Editar -->
                <a href="{{ route('procedimientos.edit', $procedimiento) }}" class="btn btn-secondary btn-sm mr-1">Editar</a>
                <form action="{{ route('procedimientos.destroy', $procedimiento) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection