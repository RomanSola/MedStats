@extends('layouts.app')

@section('title', 'Gestión de Empleados')

@section('contenido')

    <div class="container mt-4 bg-light border p-4 rounded">
        <h2 class="mb-4">Gestor de Empleados</h2>

        <div class="card border-warning">
            <div class="card-body">
                <p class="card-text">Administrá los empleados registrados en el sistema. Podés ver detalles, editarlos o
                    eliminarlos.</p>
                <br>
                <a href="{{ route('empleados.create') }}" class="btn btn-warning mb-3">Agregar Nuevo Empleado</a>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-warning">
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
                                        <a href="{{ route('empleados.show', $empleado) }}"
                                            class="btn btn-outline-primary btn-sm me-1">Ver</a>
                                        <a href="{{ route('empleados.edit', $empleado) }}"
                                            class="btn btn-outline-warning btn-sm me-1">Editar</a>
                                        <form action="{{ route('empleados.destroy', $empleado) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de que querés eliminar este empleado?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No hay empleados registrados aún.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>


@endsection
