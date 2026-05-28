@extends('layouts.app')

@section('titulo', 'Lista de Camas')

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


    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
                Gestor de Camas</h1>
            <a href="{{ route('camas.create') }}"
                class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                style="text-decoration: none;">
                Agregar Nueva Cama
            </a>
        </div>

        {{-- Contenedor principal con borde celeste --}}
        <div class="card border">
            <div class="card-body">

                <p class="mb-3 text-secondary fw-semibold">
                    Desde aquí podés administrar las camas del establecimiento y su disponibilidad.
                </p>

                {{-- Tabla de camas --}}
                <div class="table-responsive">
                    <table class="table table-hover table-bordered shadow-sm text-center rounded">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Habitación</th>
                                <th>Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($camas as $cama)
                            <tr>
                                <td class="fw-medium">{{ $cama->codigo }}</td>
                                <td>{{ $cama->get_habitacion->numero ?? 'Sin asignar' }}</td>
                                <td>
                                    <div class="mb-1">
                                        <span class="text-xs font-semibold text-white px-3 py-1 rounded-full inline-block
                                            {{ $cama->ocupada ? 'bg-red-500' : 'bg-green-500' }}">
                                            {{ $cama->ocupada ? 'OCUPADA' : 'LIBRE' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('camas.edit', $cama) }}" class="btn btn-outline-warning btn-sm me-1 btn-fixed-width">
                                        Editar
                                    </a>
                                    @if (!$cama->ocupada)
                                    <form action="{{ route('camas.destroy', $cama) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm me-1 btn-fixed-width"
                                                onclick="return confirm('¿Estás seguro de que querés eliminar esta cama?')">
                                            Eliminar
                                        </button>
                                    </form>
                                    @else
                                        <button class="btn btn-outline-secondary btn-sm" disabled title="Esta cama está ocupada">
                                            No eliminable
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    No hay camas registradas.
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
<style>
    .btn-fixed-width {
        min-width: 100px; /* Puedes ajustar este valor según lo que necesites */
        text-align: center;
    }
</style>
@endsection
