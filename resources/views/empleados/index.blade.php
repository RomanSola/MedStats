@extends('layouts.app')
@section('titulo', 'Lista de Empleados')
@section('contenido')
<h1 class="mb-4">Gestor de Empleados</h1>
<a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Empleado</a>
<table class="table">
    <thead>
        <tr>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Telefono</th>
            <th>Profesión</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empleados as $empleado)
        <tr>
            <td>{{ $empleado->dni }}</td>
            <td>{{ $empleado->nombre }}</td>
            <td>{{ $empleado->apellido }}</td>
            <td>{{ $empleado->telefono }}</td>
            <td>{{ $empleado->get_profesion->nombre_profesion }}</td>
            <td>
                <!-- Botón Mostrar -->
                <a href="{{ route('empleados.show', $empleado) }}" class="btn btn-primary btn-sm mr-1">Ver</a>
                <!-- Botón Editar -->
                <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-secondary btn-sm mr-1">Editar</a>
                <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="d-inline">
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