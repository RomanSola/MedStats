@extends('layouts.app')

@section('title', 'Gestión de Empleados')

@section('contenido')
<div class="container mt-4">

    {{-- Título institucional amarillo --}}
    <h2 class="text-warning fw-bold border-bottom border-warning pb-2 mb-4">
        Gestor de Empleados
    </h2>

    {{-- Contenedor principal con borde amarillo --}}
    <div class="card border-warning shadow-sm mb-4">
        <div class="card-body">

            <p class="mb-3  fw-semibold">
                Administrá los empleados registrados en el sistema. Podés ver detalles, editarlos o eliminarlos.
            </p>

            {{-- Botón de acción --}}
            <a href="{{ route('empleados.create') }}" class="btn btn-outline-warning fw-semibold mb-3">
                Agregar Nuevo Empleado
            </a>

            {{-- Tabla de empleados --}}
            <div class="table-responsive">
                <table class="table table-bordered border-warning align-middle">
                    <thead class="table-warning text-dark">
                        <tr>
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Teléfono</th>
                            <th>Profesión</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->dni }}</td>
                            <td>{{ $empleado->nombre }}</td>
                            <td>{{ $empleado->apellido }}</td>
                            <td>{{ $empleado->telefono }}</td>
                            <td>{{ $empleado->get_profesion->nombre_profesion }}</td>
                            <td class="text-center">
                                <a href="{{ route('empleados.show', $empleado) }}" class="btn btn-outline-success btn-sm me-1">
                                    Ver
                                </a>
                                <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-outline-warning btn-sm me-1">
                                    Editar
                                </a>
                                <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de que querés eliminar este empleado?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No hay empleados registrados aún.
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
