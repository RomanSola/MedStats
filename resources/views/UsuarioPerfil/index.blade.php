@extends('layouts.app')

@section('titulo', 'Lista de Perfiles')

@section('contenido')
    <div class="container mt-4">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="flex justify-between items-center mb-6">
                <h1
                    class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
                    Gestor de Perfiles de Usuario</h1>
                <a href="{{ route('UsuarioPerfil.create') }}"
                    class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                    style="text-decoration: none;">
                    Agregar Nuevo Perfil
                </a>
            </div>

            {{-- Contenedor principal con borde gris institucional --}}
            <div class="card border-secondary shadow-sm mb-4">
                <div class="card-body">
                    <p class="mb-3 text-secondary fw-semibold">
                        Administrá los perfiles disponibles en el sistema. Podés editarlos o eliminarlos según corresponda.
                    </p>
                    <br>

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
                                    <th>Perfil</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($perfiles as $perfil)
                                    <tr>
                                        <td>{{ $perfil->perfil }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('UsuarioPerfil.edit', $perfil) }}"
                                                class="btn btn-outline-warning btn-sm me-1">Editar</a>
                                            <form action="{{ route('UsuarioPerfil.destroy', $perfil) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('¿Estás seguro de que querés eliminar este perfil?')">
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
        </div>
    </div>
@endsection
