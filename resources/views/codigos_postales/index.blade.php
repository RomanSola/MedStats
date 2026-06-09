@extends('layouts.app')

@section('title', 'Lista de Códigos Postales')

@section('contenido')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
                Gestor de Códigos Postales
            </h1>
            <a href="{{ route('codigos_postales.create') }}"
                class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                style="text-decoration: none;">
                Agregar Nuevo C.P.
            </a>
        </div>

        <div class="card border">
            <div class="card-body">

                <p class="mb-3 text-secondary fw-semibold">
                    Visualizá, editá o eliminá códigos postales del sistema.
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
                                <th>Código</th>
                                <th>Localidad</th>
                                <th>Provincia</th>
                                <th>País</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($codigos as $cp)
                                <tr>
                                    <td>{{ $cp->codigo }}</td>
                                    <td>{{ $cp->localidad }}</td>
                                    <td>{{ optional($cp->provincia)->nombre }}</td>
                                    <td>{{ optional($cp->pais)->nombre }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('codigos_postales.edit', $cp->id) }}"
                                            class="btn btn-outline-warning btn-sm me-1">Editar</a>
                                        <form action="{{ route('codigos_postales.destroy', $cp->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de que querés eliminar este código postal?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        No hay códigos postales registrados aún.
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
