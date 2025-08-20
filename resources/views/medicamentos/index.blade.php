@extends('layouts.app')

@section('title', 'Gestión de Medicamentos')

@section('contenido')
<div class="container mt-4">

    {{-- Título institucional verde con degradado --}}
    <h2 class="text-3xl fw-bold bg-gradient-to-r from-green-600 via-green-400 to-green-600 text-transparent bg-clip-text drop-shadow mb-4">
         Gestor de Medicamentos
    </h2>

    {{-- Contenedor principal con borde verde --}}
    <div class="card border-success shadow-sm mb-4">
        <div class="card-body">

            <p class="mb-3 text-success fw-semibold">
                Desde aquí podés administrar los medicamentos disponibles en el sistema.
            </p>

            {{-- Botón de acción --}}
            <a href="{{ route('medicamentos.create') }}"
               class="btn btn-outline-success fw-semibold mb-3">
                 Agregar Nuevo Medicamento
            </a>

            {{-- Tabla de medicamentos --}}
            <div class="table-responsive">
                <table class="table table-bordered border-success align-middle">
                    <thead class="table-success text-dark">
                        <tr>
                            <th>Nombre del Medicamento</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($medicamentos as $medicamento)
                        <tr>
                            <td class="fw-medium">{{ $medicamento->nombre }}</td>
                            <td class="text-center">
                                <a href="{{ route('medicamentos.edit', $medicamento) }}"
                                   class="btn btn-outline-warning btn-sm me-1">
                                     Editar
                                </a>
                                <form action="{{ route('medicamentos.destroy', $medicamento) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de que querés eliminar este medicamento?')">
                                         Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted">
                                No hay medicamentos cargados aún.
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
