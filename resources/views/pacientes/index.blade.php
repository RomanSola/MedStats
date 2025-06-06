@extends('layouts.app')
@section('titulo', 'Lista de Pacientes')
@section('contenido')
<h1 class="mb-4">Gestor de Pacientes</h1>
<a href="{{ route('pacientes.create') }}" class="btn btn-primary mb-3">Ingresar Nuevo Paciente</a>
<table class="table">
    <thead>
        <tr>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Género</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pacientes as $paciente)
        <tr>
            <td>{{ $paciente->dni }}</td>
            <td>{{ $paciente->nombre }}</td>
            <td>{{ $paciente->apellido }}</td>
            <td>{{ $paciente->telefono }}</td>
            <td>{{ $paciente->genero }}</td>
            <td>
                <!-- Botón Mostrar -->
                <a href="{{ route('pacientes.show', $paciente) }}" class="btn btn-primary btn-sm mr-1">Ver</a>
                <!-- Botón Editar -->
                <a href="{{ route('pacientes.edit', $paciente) }}" class="btn btn-secondary btn-sm mr-1">Editar</a>
                <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST" class="d-inline">
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