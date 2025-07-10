@extends('layouts.app')
@section('titulo', 'Lista de Salas')
@section('contenido')
<div class="container mt-4 bg-light border p-4 rounded">
<h1 class="mb-4 ">Gestor de Salas</h1>
<a href="{{ route('salas.create') }}" class="btn btn-primary mb-3">Agregar Nueva Sala</a>
<table class="table">
    <thead>
        <tr>
            <th>Sala</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($salas as $sala)
        <tr>
            <td>{{ $sala->nombre }}</td>
            <td>{{ $sala->descripcion }}</td>
            <td>
                <!-- Botón Editar -->
                <a href="{{ route('salas.edit', $sala) }}" class="btn btn-secondary btn-sm mr-1">Editar</a>
                <form action="{{ route('salas.destroy', $sala) }}" method="POST" class="d-inline">
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