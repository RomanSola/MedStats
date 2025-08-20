@extends('layouts.app')

@section('titulo', 'Lista de Tipos de Anestesias')

@section('contenido')
<div class="container py-4">

    {{-- Título institucional verde --}}
    <h1 class="text-success fw-bold border-bottom border-success pb-2 mb-4">
        Gestor de Tipos de Anestesia
    </h1>

    {{-- Contenedor principal con borde verde institucional --}}
    <div class="card border-success shadow-sm">
        <div class="card-body text-dark">

            {{-- Botón de acción --}}
            <a href="{{ route('tipoAnestesias.create') }}" class="btn btn-outline-success fw-semibold mb-3">
                Agregar Nuevo Tipo de Anestesia
            </a>

            {{-- Tabla de anestesias --}}
            <table class="table table-bordered border-success align-middle">
                <thead class="table-success text-dark">
                    <tr>
                        <th>Tipo de Anestesia</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anestesias as $anestesia)
                    <tr>
                        <td>{{ $anestesia->nombre }}</td>
                        <td class="text-center">
                            <a href="{{ route('tipoAnestesias.edit', $anestesia) }}" class="btn btn-outline-success btn-sm me-1">
                                Editar
                            </a>
                            <form action="{{ route('tipoAnestesias.destroy', $anestesia) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
