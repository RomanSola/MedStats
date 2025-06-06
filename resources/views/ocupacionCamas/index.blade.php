@extends('layouts.app')
@section('titulo', 'Lista de Ocupaciones de Camas')
@section('contenido')
<h1 class="mb-4">Gestor de Ocupaciones de Camas</h1>
<a href="{{ route('ocupacionCamas.create') }}" class="btn btn-primary mb-3">Ocupar Cama</a>
<table class="table">
    <thead>
        <tr>
            <th>Cama</th>
            <th>Paciente</th>
            <th>DNI</th>
            <th>Fecha Ingreso</th>
            <th>Fecha Egreso</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($oc_camas as $oc_cama)
        <tr>
            <td>{{ $oc_cama->get_cama->codigo }}</td>
            <td>{{ $oc_cama->get_paciente->nombre }} {{ $oc_cama->get_paciente->apellido }}</td>
            <td>{{ $oc_cama->get_paciente->dni }}</td>
            <td>{{ substr($oc_cama->fecha_ingreso, 0, 10) }}</td>
            <td>{{ $oc_cama->fecha_egreso ? substr($oc_cama->fecha_egreso, 0, 10) : '' }}</td>
            <td>
                <!-- Botón Mostrar -->
                <a href="{{ route('ocupacionCamas.show', $oc_cama) }}" class="btn btn-primary btn-sm mr-1">Ver</a>
                <!-- Botón Editar -->
                <a href="{{ route('ocupacionCamas.edit', $oc_cama) }}" class="btn btn-secondary btn-sm mr-1">Editar</a>
                <!-- Botón Dar de Alta -->
                @if ($oc_cama->fecha_egreso == null)
                    <a href="{{ route('ocupacionCamas.darAlta', $oc_cama) }}" class="btn btn-success btn-sm mr-1">Dar Alta</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection