@extends('layouts.app')

@section('titulo', 'Gestión de Tipos de Anestesias')

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
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
                Gestor de Tipos de Anestesias
            </h1>
            <a href="{{ route('tipoAnestesias.create') }}"
               class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
               style="text-decoration: none;">
                Agregar Nuevo Tipo de Anestesia
            </a>
        </div>

        {{-- Contenedor principal con borde y sombra --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <p class="mb-3 text-secondary fw-semibold">
                    Desde aquí podés administrar los tipos de anestesias disponibles en el sistema.
                </p>

                <div class="bg-white shadow rounded-lg border border-gray-200 overflow-auto">
                    <table class="table table-hover table-bordered shadow-sm text-center rounded">
                        <thead>
                            <tr>
                                <th>Tipo de Anestesia</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($anestesias as $anestesia)
                            <tr>
                                <td class="fw-medium">{{ $anestesia->nombre }}</td>
                                <td class="text-center">
                                    <a href="{{ route('tipoAnestesias.edit', $anestesia) }}"
                                       class="btn btn-outline-warning btn-sm me-1">
                                        Editar
                                    </a>
                                    <form action="{{ route('tipoAnestesias.destroy', $anestesia) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de que querés eliminar este tipo de anestesia?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted">
                                    No hay tipos de anestesias cargados aún.
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
