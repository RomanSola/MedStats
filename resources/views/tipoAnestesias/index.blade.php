@extends('layouts.app')
@section('titulo', 'Lista de Tipos de Anestesias')
@section('contenido')
<div class="container mt-4 bg-light border p-4 rounded">
<h1 class="mb-4">Gestor de Tipos de Anestesias</h1>
<a href="{{ route('tipoAnestesias.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Procedimiento</a>
<table class="table table-hover table-bordered shadow-sm text-center rounded">
    <thead>
        <tr>
            <th>Tipo de Anestesia</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($anestesias as $anestesia)
        <tr>
            <td>{{ $anestesia->nombre }}</td>
            <td>
                <!-- Botón Editar -->
                <a href="{{ route('tipoAnestesias.edit', $anestesia) }}" class="btn btn-secondary btn-sm mr-1">Editar</a>
                <form action="{{ route('tipoAnestesias.destroy', $anestesia) }}" method="POST" class="d-inline">
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