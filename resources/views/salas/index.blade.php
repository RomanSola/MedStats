@extends('layouts.app')

@section('titulo', 'Lista de Salas')

@section('contenido')
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container mt-4">

        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="flex justify-between items-center mb-6">
                <h1
                    class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2 px-2">
                    Gestor de Salas</h1>
                <a href="{{ route('salas.create') }}"
                    class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                    style="text-decoration: none;">
                    Agregar Nueva Sala
                </a>
            </div>

    {{-- Contenedor principal con borde celeste --}}
            <div class="card border-secondary shadow-sm mb-4">
                <div class="card-body">

            <p class="mb-3 text-secondary fw-semibold">
                Desde aquí podés administrar las salas del establecimiento y su capacidad.
            </p>

            {{-- Tabla de salas --}}
            <div class="table-responsive">
                <table class="table table-hover table-bordered shadow-sm text-center rounded">
                    <thead>
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
                                @if (!$sala->habitaciones()->exists())
                                <form action="{{ route('salas.destroy', $sala) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de que querés eliminar esta sala?')">
                                        Eliminar
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-outline-secondary btn-sm" disabled title="Esta sala no se puede eliminar">
                                    No eliminable
                                </button>
                            @endif
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
</div>
@endsection
