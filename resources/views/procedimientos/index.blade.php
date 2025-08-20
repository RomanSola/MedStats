@extends('layouts.app')

@section('title', 'Lista de Procedimientos')

@section('contenido')
<div class="container py-4">

    {{-- Título institucional rojo --}}
    <h2 class="text-danger fw-bold border-bottom border-danger pb-2 mb-4">
        Gestor de Procedimientos Quirúrgicos
    </h2>

    {{-- Contenedor principal con borde rojo institucional --}}
    <div class="card border-danger shadow-sm">
        <div class="card-body text-dark">

            <p class="mb-3 fw-semibold">
                Visualizá, editá o eliminá procedimientos quirúrgicos del sistema.
            </p>

            {{-- Botón de acción --}}
            <a href="{{ route('procedimientos.create') }}" class="btn btn-outline-danger fw-semibold mb-3">
                Agregar Nuevo Procedimiento
            </a>

            {{-- Tabla de procedimientos --}}
            <div class="table-responsive">
                <table class="table table-bordered border-danger align-middle">
                    <thead class="table-danger text-dark">
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
                                <a href="{{ route('procedimientos.show', $procedimiento) }}" class="btn btn-outline-danger btn-sm me-1">
                                    Ver
                                </a>
                                <a href="{{ route('procedimientos.edit', $procedimiento) }}" class="btn btn-outline-danger btn-sm me-1">
                                    Editar
                                </a>
                                <form action="{{ route('procedimientos.destroy', $procedimiento) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de que querés eliminar este procedimiento?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                No hay procedimientos registrados.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
