@extends('layouts.app')
@section('titulo', 'Ver Historial Stock')
@section('contenido')
<h1 class="mb-4">Ver Historial Stock</h1>
<form action="{{ route('stocks.show', $hist_item, $stock) }}">
<table class="table">
    <thead>
        <tr>
            <th>Medicamento</th>
            <th>Lote</th>
            <th>Cantidad</th>
            <th>Fecha</th>
            <th>Médico</th>
            <th>Paciente</th>
            <th>Comentario</th>
            <th>Usuario</th>
        </tr>
    </thead>
    <tbody>
        @foreach($hist_item as $item)
        <tr>
            <td>{{ $stock->get_medicamento->nombre }}</td>
            <td>{{ $stock->lote }}</td>
            <td>{{ $item->cantidad }}</td>
            <td>{{ $item->fecha }}</td>
            @if($item->get_empleado != null)
            <td>{{ $item->get_empleado->nombre }} {{ $item->get_empleado->apellido }} DNI {{ $item->get_empleado->dni }}</td>
            @else
            <td></td>
            @endif
            @if($item->get_paciente != null)
            <td>{{ $item->get_paciente->nombre }} {{ $item->get_empleado->apellido }} DNI {{ $item->get_empleado->dni }}</td>
            @else
            <td></td>
            @endif
            <td>{{ $item->comentario }}</td>
            <!-- FALTA AGREGAR EL USUARIO CUANDO ESTÉ HECHA LA TABLA DE USUARIOS-->
            <td></td>
        </tr>
        @endforeach
        {{ $hist_item->links() }}
    </tbody>
</table>
</form>
<a href="{{ route('stocks.index') }}" class="btn btn-primary mb-3">Volver</a>
@endsection