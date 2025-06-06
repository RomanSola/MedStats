@extends('layouts.app')
@section('titulo', 'Lista de Medicamentos')
@section('contenido')
<h1 class="mb-4">Gestor de Medicamentos</h1>
<a href="{{ route('medicamentos.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Medicamento</a>
<table class="table">
    <thead>
        <tr>
            <th>Nombre del medicamento</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($medicamentos as $medicamento)
        <tr>
            <td>{{ $medicamento->nombre }}</td>
            <td>
                <!-- Botón Editar -->
                <a href="{{ route('medicamentos.edit', $medicamento) }}" class="btn btn-secondary btn-sm mr-1">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection