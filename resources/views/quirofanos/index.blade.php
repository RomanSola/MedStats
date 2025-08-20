@extends('layouts.app')

@section('title', 'Lista de Quirófanos')

@section('contenido')
<div class="container py-4">

    {{-- Título institucional celeste --}}
    <h2 class="text-info fw-bold border-bottom border-info pb-2 mb-4">
        Gestor de Quirófanos
    </h2>

    {{-- Contenedor principal con borde celeste institucional --}}
    <div class="card border-info shadow-sm">
        <div class="card-body text-dark">

            <p class="mb-3 fw-semibold">
                Visualizá, editá o eliminá quirófanos del sistema.
            </p>

            {{-- Botón de acción --}}
            <a href="{{ route('quirofanos.create') }}" class="btn btn-outline-info fw-semibold mb-3">
                Agregar Nuevo Quirófano
            </a>

            {{-- Tabla de quirófanos --}}
            <div class="table-responsive">
                <table class="table table-bordered border-info align-middle">
                    <thead class="table-info text-dark">
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
                                <a href="{{ route('quirofanos.show', $quirofano) }}" class="btn btn-outline-info btn-sm me-1">
                                    Ver
                                </a>
                                <a href="{{ route('quirofanos.edit', $quirofano) }}" class="btn btn-outline-info btn-sm me-1">
                                    Editar
                                </a>
                                <form action="{{ route('quirofanos.destroy', $quirofano) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de que querés eliminar este quirófano?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                No hay quirófanos registrados.
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
