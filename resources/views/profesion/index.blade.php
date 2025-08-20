@extends('layouts.app')

@section('titulo', 'Lista de Profesiones')

@section('contenido')
<div class="container py-4">

    {{-- Título institucional amarillo --}}
    <h1 class="text-warning fw-bold border-bottom border-warning pb-2 mb-4">
        Gestor de Profesiones
    </h1>

    {{-- Contenedor principal con borde amarillo institucional --}}
    <div class="card border-warning shadow-sm">
        <div class="card-body text-dark">

            {{-- Botón de acción --}}
            <a href="{{ route('profesion.create') }}" class="btn btn-outline-warning fw-semibold mb-3">
                Agregar Nueva Profesión
            </a>

            {{-- Tabla de profesiones --}}
            <table class="table table-bordered border-warning align-middle">
                <thead class="table-warning text-dark">
                    <tr>
                        <th>Profesión</th>
                        <th>Descripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profesiones as $profesion)
                    <tr>
                        <td>{{ $profesion->nombre_profesion }}</td>
                        <td>{{ $profesion->descripcion }}</td>
                        <td class="text-center">
                            <a href="{{ route('profesion.show', $profesion) }}" class="btn btn-outline-warning btn-sm me-1">
                                Ver
                            </a>
                            <a href="{{ route('profesion.edit', $profesion) }}" class="btn btn-outline-warning btn-sm me-1">
                                Editar
                            </a>
                            <form action="{{ route('profesion.destroy', $profesion) }}" method="POST" class="d-inline">
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
