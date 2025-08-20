@extends('layouts.app')

@section('titulo', 'Lista de Habitaciones')

@section('contenido')
<div class="container mt-4">

    {{-- Título institucional gris con degradado sutil --}}
    <h2 class="text-3xl fw-bold bg-gradient-to-r from-gray-700 via-gray-500 to-gray-700 text-transparent bg-clip-text drop-shadow mb-4">
         Gestor de Habitaciones
    </h2>

    {{-- Contenedor principal con borde gris institucional --}}
    <div class="card border-secondary shadow-sm mb-4">
        <div class="card-body">

            <p class="mb-3 text-secondary fw-semibold">
                Visualizá, editá o eliminá habitaciones del sistema.
            </p>

            {{-- Botón de acción --}}
            <a href="{{ route('habitaciones.create') }}"
               class="btn btn-outline-secondary fw-semibold mb-3">
                 Agregar Nueva Habitación
            </a>

            {{-- Tabla de habitaciones --}}
            <div class="table-responsive">
                <table class="table table-bordered border-secondary align-middle">
                    <thead class="table-secondary text-dark">
                        <tr>
                            <th>Número de Habitación</th>
                            <th>Sala</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($habitaciones as $habitacion)
                        <tr>
                            <td class="fw-medium">{{ $habitacion->numero }}</td>
                            <td>{{ $habitacion->get_sala->nombre }} – {{ $habitacion->get_sala->descripcion }}</td>
                            <td class="text-center">
                                <a href="{{ route('habitaciones.edit', $habitacion) }}"
                                   class="btn btn-outline-warning btn-sm me-1">
                                     Editar
                                </a>
                                <form action="{{ route('habitaciones.destroy', $habitacion) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de que querés eliminar esta habitación?')">
                                         Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                No hay habitaciones registradas.
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
