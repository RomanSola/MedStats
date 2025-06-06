@extends('layouts.app')
@section('titulo', 'Medicamentos en Stock')
@section('contenido')
<h1 class="mb-4">Medicamentos en Stock</h1>
<a href="{{ route('stocks.create') }}" class="btn btn-primary mb-3">Ingresar Nuevo Medicamento al Stock</a>
<table class="table">
    <thead>
        <tr>
            <th>Medicamento</th>
            <th>Lote</th>
            <th>Fecha de vencimiento</th>
            <th>Cantidad Actual</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stock as $item)
        <tr>
            <td>{{ $item->get_medicamento->nombre }}</td>
            <td>{{ $item->lote }}</td>
            <td>{{ $item->fecha_vencimiento }}</td>
            <td>{{ $item->cantidad_act }}</td>
            <td>
                <!-- Botón Mostrar -->
                <a href="{{ route('stocks.show', $item) }}" class="btn btn-primary btn-sm mr-1">Ver Historial</a>
                <!-- Botón Editar -->
                <a href="{{ route('stocks.edit', $item) }}" class="btn btn-secondary btn-sm mr-1">Editar</a>
                <!-- Boton Delete
                <form action="{ route('stocks.destroy', $item) }}" method="POST" class="d-inline">
                    csrf
                    method('DELETE')
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </form>
                -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection