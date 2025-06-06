@extends('layouts.app')
@section('titulo', 'Lista de Habitaciones')
@section('contenido')
<h1 class="mb-4">Gestor de Habitaciones</h1>
<a href="{{ route('camas.create') }}" class="btn btn-primary mb-3">Agregar Nueva Habitación</a>
<table class="table">
    <thead>
        <tr>
            <th>Cama</th>
            <th>Habitación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($camas as $cama)
        <tr>
            <td>{{ $cama->codigo }}</td>
            <td>{{ $cama->get_habitacion->numero }}</td>
            <td>
                <!-- Botón Editar -->
                <a href="{{ route('camas.edit', $cama) }}" class="btn btn-secondary btn-sm mr-1">Editar</a>
                <form action="{{ route('camas.destroy', $cama) }}" method="POST" class="d-inline">
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