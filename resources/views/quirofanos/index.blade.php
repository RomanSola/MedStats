@extends('layouts.app')

@section('title', 'Lista de Quirofanos')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Gestor de Quirofanós</h2>

    <div class="card border-info">
        <div class="card-body">
            <p class="card-text">Visualizá, editá o eliminá quirofanos del sistema.</p>
            <a href="{{ route('quirofanos.create') }}" class="btn btn-info mb-3">Agregar Nuevo Quirofano</a>

            <div class="table-responsive">
                <table class="table table-hover table-bordered shadow-sm text-center rounded">
                    <thead class="table-info">
                        <tr>
                            <th>Quirófano</th>
                            <th>Descripción</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quirofanos as $quirofano)
                        <tr>
                            <td>{{ $quirofano->nombre }}</td>
                            <td>{{ $quirofano->descripcion }}</td>
                            <td class="text-center">
                                <a href="{{ route('quirofanos.show', $quirofano) }}" class="btn btn-outline-primary btn-sm me-1">Ver</a>
                                <a href="{{ route('quirofanos.edit', $quirofano) }}" class="btn btn-outline-info btn-sm me-1">Editar</a>
                                <form action="{{ route('quirofanos.destroy', $quirofano) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de que querés eliminar este Quirofano?')">
                                        Eliminar
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No hay Quirófanos registrados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
