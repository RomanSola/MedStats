@extends('layouts.app')

@section('titulo', 'Lista de Habitaciones')

@section('contenido')
    <div class="container mt-4">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="flex justify-between items-center mb-6">
                <h1
                    class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2 px-2">
                    Gestor de Habitaciones</h1>
                <a href="{{ route('habitaciones.create') }}"
                    class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                    style="text-decoration: none;">
                    Agregar Nueva Habitación
                </a>
            </div>

            {{-- Contenedor principal con borde gris institucional --}}
            <div class="card border-secondary shadow-sm mb-4">
                <div class="card-body">

                    <p class="mb-3 text-secondary fw-semibold">
                        Visualizá, editá o eliminá habitaciones del sistema.
                    </p>

                    <table class="table table-hover table-bordered shadow-sm text-center rounded">
                        <thead>
                            <tr>
                                <th>Habitación</th>
                                <th>Sala</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($habitaciones as $habitacion)
                                <tr>
                                    <td>{{ $habitacion->numero }}</td>
                                    <td>{{ $habitacion->get_sala->nombre }} - {{ $habitacion->get_sala->descripcion }}</td>
                                    <td>
                                        <!-- Botón Editar -->
                                        <a href="{{ route('habitaciones.edit', $habitacion) }}"
                                            class="btn btn-outline-warning btn-sm me-1">Editar</a>
                                        <form action="{{ route('habitaciones.destroy', $habitacion) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de que querés eliminar esta habitación?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Tabla de habitaciones --}}
                    <div class="table-responsive">

                    </div>

                </div>
            </div>
        </div>
    @endsection
