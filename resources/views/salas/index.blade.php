@extends('layouts.app')

@section('titulo', 'Lista de Salas')

@section('contenido')
<div class="container mt-4">

    {{-- Título institucional celeste --}}
    <h1 class="text-info fw-bold border-bottom border-info pb-2 mb-4">
        Gestor de Salas
    </h1>

    {{-- Contenedor principal con borde celeste --}}
    <div class="card border-info shadow-sm mb-4">
        <div class="card-body">

            <p class="mb-3 text-info fw-semibold">
                Desde aquí podés administrar las salas del establecimiento y su capacidad.
            </p>

            {{-- Botón de acción --}}
            <a href="{{ route('salas.create') }}" class="btn btn-outline-info fw-semibold mb-3">
                Agregar Nueva Sala
            </a>

            {{-- Tabla de salas --}}
            <div class="table-responsive">
                <table class="table table-bordered border-info align-middle">
                    <thead class="table-info text-dark">
                        <tr>
                            <th>Sala</th>
                            <th>Descripción</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($salas as $sala)
                        <tr>
                            <td class="fw-medium">{{ $sala->nombre }}</td>
                            <td>{{ $sala->descripcion }}</td>
                            <td class="text-center">
                                <a href="{{ route('salas.edit', $sala) }}" class="btn btn-outline-warning btn-sm me-1">
                                    Editar
                                </a>
                                <form action="{{ route('salas.destroy', $sala) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de que querés eliminar esta sala?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                No hay salas registradas.
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
