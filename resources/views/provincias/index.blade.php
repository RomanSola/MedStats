@extends('layouts.app')

@section('title', 'Lista de Provincias')

@section('contenido')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
                Gestor de Provincias
            </h1>
            <a href="{{ route('provincias.create') }}"
                class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                style="text-decoration: none;">
                Agregar Nueva Provincia
            </a>
        </div>

        <div class="card border">
            <div class="card-body">

                <p class="mb-3 text-secondary fw-semibold">
                    Visualizá, editá o eliminá provincias del sistema.
                </p>

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

                <div class="bg-white shadow rounded-lg border border-gray-200 overflow-auto">
                    <table class="table table-hover table-bordered shadow-sm text-center rounded">
                        <thead>
                            <tr>
                                <th>Provincia</th>
                                <th>País</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($provincias as $provincia)
                                <tr>
                                    <td>{{ $provincia->nombre }}</td>
                                    <td>{{ optional($provincia->pais)->nombre }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('provincias.edit', $provincia) }}"
                                            class="btn btn-outline-warning btn-sm me-1">Editar</a>
                                        @php
                                            $hasCodigos = \App\Models\Codigo_postal::where('provincia_id', $provincia->id)->exists();
                                        @endphp
                                        @if (!$hasCodigos)
                                            <form action="{{ route('provincias.destroy', $provincia) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('¿Estás seguro de que querés eliminar esta provincia?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-outline-secondary btn-sm" disabled
                                                title="No se puede eliminar: tiene códigos postales asociados.">
                                                No eliminable
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        No hay provincias registradas aún.
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
