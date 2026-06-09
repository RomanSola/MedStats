@extends('layouts.app')

@section('title', 'Lista de Países')

@section('contenido')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
                Gestor de Países
            </h1>
            <a href="{{ route('paises.create') }}"
                class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                style="text-decoration: none;">
                Agregar Nuevo País
            </a>
        </div>

        <div class="card border">
            <div class="card-body">

                <p class="mb-3 text-secondary fw-semibold">
                    Visualizá, editá o eliminá países del sistema.
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
                                <th>País</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paises as $pais)
                                <tr>
                                    <td>{{ $pais->nombre }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('paises.edit', $pais) }}"
                                            class="btn btn-outline-warning btn-sm me-1">Editar</a>
                                        @if (!$pais->provincias()->exists())
                                            <form action="{{ route('paises.destroy', $pais) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('¿Estás seguro de que querés eliminar este país?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-outline-secondary btn-sm" disabled
                                                title="No se puede eliminar: tiene provincias asociadas.">
                                                No eliminable
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">
                                        No hay países registrados aún.
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
