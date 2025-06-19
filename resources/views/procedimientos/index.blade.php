@extends('layouts.app')

@section('title', 'Lista de Procedimientos')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Gestor de Procedimientos</h2>

    <div class="card border-info">
        <div class="card-body">
            <p class="card-text">Visualizá, editá o eliminá procedimientos quirúrgicos del sistema.</p>
            <a href="{{ route('procedimientos.create') }}" class="btn btn-info mb-3">Agregar Nuevo Procedimiento</a>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-info">
                        <tr>
                            <th>Procedimiento</th>
                            <th>Descripción</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($procedimientos as $procedimiento)
                        <tr>
                            <td>{{ $procedimiento->nombre_procedimiento }}</td>
                            <td>{{ $procedimiento->descripcion }}</td>
                            <td class="text-center">
                                <a href="{{ route('procedimientos.show', $procedimiento) }}" class="btn btn-outline-primary btn-sm me-1">Ver</a>
                                <a href="{{ route('procedimientos.edit', $procedimiento) }}" class="btn btn-outline-info btn-sm me-1">Editar</a>
                                <form action="{{ route('procedimientos.destroy', $procedimiento) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de que querés eliminar este procedimiento?')">
                                        Eliminar
                                    </button>
                                </form>
                                
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No hay procedimientos registrados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
