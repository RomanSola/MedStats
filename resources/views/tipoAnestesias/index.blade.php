@extends('layouts.app')

@section('titulo', 'Lista de Tipos de Anestesias')

@section('contenido')

    <div class="container mt-4">

        {{-- Título institucional verde con degradado --}}
        <h2
            class="text-3xl fw-bold bg-gradient-to-r from-green-600 via-green-400 to-green-600 text-transparent bg-clip-text drop-shadow mb-4">
            Gestor de Tipos de Anestesias
        </h2>

        <div class="card border-success shadow-sm mb-4">
            <div class="card-body">

                <a href="{{ route('medicamentos.create') }}" class="btn btn-outline-success fw-semibold mb-3">
                    Agregar Nuevo Procedimiento
                </a>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered shadow-sm text-center rounded">
                        <thead>
                            <tr>
                                <th>Tipo de Anestesia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anestesias as $anestesia)
                                <tr>
                                    <td>{{ $anestesia->nombre }}</td>
                                    <td>
                                        <!-- Botón Editar -->
                                        <a href="{{ route('tipoAnestesias.edit', $anestesia) }}"
                                            class="btn btn-secondary btn-sm mr-1">Editar</a>
                                        <form action="{{ route('tipoAnestesias.destroy', $anestesia) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
