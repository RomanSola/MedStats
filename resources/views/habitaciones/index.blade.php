@extends('layouts.app')
@section('titulo', 'Lista de Habitaciones')
@section('contenido')
<h1 class="mb-4">Gestor de Habitaciones</h1>
<a href="{{ route('habitaciones.create') }}" class="btn btn-primary mb-3">Agregar Nueva Habitación</a>
<table class="table table-hover table-bordered shadow-sm text-center rounded">
    <thead>
        <tr>
            <th>Habitación</th>
            <th>Sala</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($habitaciones as $habitacion)
        <tr>
            <td>{{ $habitacion->numero }}</td>
            <td>{{ $habitacion->get_sala->nombre }} - {{ $habitacion->get_sala->descripcion }}</td>
            <td>
                <!-- Botón Editar -->
                <a href="{{ route('habitaciones.edit', $habitacion) }}" class="btn btn-secondary btn-sm mr-1">Editar</a>
                <form action="{{ route('habitaciones.destroy', $habitacion) }}" method="POST" class="d-inline">
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