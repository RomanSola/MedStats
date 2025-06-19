@extends('layouts.app')

@section('title', 'Gestión de Medicamentos')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Gestor de Medicamentos</h2>

    <!-- Tarjeta principal -->
    <div class="card border-success">
        <div class="card-body">
            <p class="card-text">Desde aquí podés administrar los medicamentos disponibles en el sistema.</p>
            <a href="{{ route('medicamentos.create') }}" class="btn btn-success mb-3">Agregar Nuevo Medicamento</a>

            <!-- Tabla con medicamentos -->
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-success">
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
