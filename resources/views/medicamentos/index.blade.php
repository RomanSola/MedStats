@extends('layouts.app')

@section('title', 'Gestión de Medicamentos')

@section('contenido')
<div class="container mt-4">
    <div class="flex justify-between items-center mb-6">
        <h1
            class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
            Gestor de Medicamentos
        </h1>
        <a href="{{ route('medicamentos.create') }}"
            class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
            style="text-decoration: none;">
            Agregar Nuevo Medicamento
        </a>
    </div>

    <!-- Contenedor con texto descriptivo -->
    <div class="card border-secondary shadow-sm mb-4">
        <div class="card-body">
            <p class="mb-3 text-secondary fw-semibold">
                Desde aquí podés administrar los medicamentos disponibles en el sistema.
            </p>

            <!-- Tabla con medicamentos -->
            <div class="table-responsive">
                <table class="table table-bordered border-success align-middle">
                    <thead class="table-success text-white">
                        <tr>
                            <th>Nombre del Medicamento</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($medicamentos as $medicamento)
                            <tr>
                                <td>{{ $medicamento->nombre }}</td>
                                <td class="text-center">
                                    <a href="{{ route('medicamentos.edit', $medicamento) }}" class="btn btn-sm btn-outline-secondary">
                                        ✏️ Editar
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted">No hay medicamentos cargados aún.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
