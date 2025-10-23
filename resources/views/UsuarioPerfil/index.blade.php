@extends('layouts.app')

@section('titulo', 'Lista de Perfiles')

@section('contenido')

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
                Gestor de Perfiles de Usuario
            </h1>
            <a href="{{ route('UsuarioPerfil.create') }}"
                class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                style="text-decoration: none;">
                Agregar Nuevo Perfil
            </a>
        </div>

        {{-- Contenedor principal de perfiles --}}
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
                                        <form action="{{ route('UsuarioPerfil.destroy', $perfil) }}" method="POST"
                                            class="d-inline">
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

        {{-- Tabla de usuarios y roles --}}
        <br><br>
        <div class="card border-secondary shadow-sm mb-4">
            <div class="card-body">
                <h2 class="text-xl font-semibold mb-3 text-gray-700">Usuarios del Sistema</h2>
                <p class="mb-3 text-secondary fw-semibold">
                    A continuación se muestran todos los usuarios registrados y su rol actual. Podés asignar o cambiar su
                    rol
                    directamente desde esta tabla.
                </p>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white shadow rounded-lg border border-gray-200 overflow-auto">
                    <table class="table table-hover table-bordered shadow-sm text-center rounded align-middle">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol Actual</th>
                                <th>Asignar Nuevo Rol</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($usuarios as $usuario)
                                @foreach ($perfiles as $perfil)
                                    @if ($usuario->role == $perfil->id)
                                        {{ $rolActual = $perfil->perfil }}
                                        @break
                                    @endif
                                @endforeach
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>
                                        <span class="fw-semibold text-gray-700">
                                            {{ $rolActual ?? 'Sin rol asignado' }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('usuarios.actualizarRol', $usuario->id) }}" method="POST"
                                            class="d-flex align-items-center justify-content-center gap-2">
                                            @csrf
                                            <select name="role" id="role"
                                                class="form-select form-select-sm w-auto border-gray-300 rounded shadow-sm">
                                                @foreach ($perfiles as $perfil)
                                                    <option value="{{ $perfil->id }}"
                                                        {{ $usuario->role == $perfil->id ? 'selected' : '' }}>
                                                        {{ $perfil->perfil }}
                                                    </option>
                                                @endforeach
                                                @error('role')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </select>
                                    </td>
                                    <td>
                                        <button type="submit"
                                            class="bg-[#1B7D8F] hover:bg-[#146672] text-white text-sm px-3 py-1 rounded-full shadow transition duration-300">
                                            Guardar
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
@endsection
