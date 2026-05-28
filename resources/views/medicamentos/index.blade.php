@extends('layouts.app')
@section('title', 'Gestión de Medicamentos')
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
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2 px-2">
                Gestor de Medicamentos</h1>
            <a href="{{ route('medicamentos.create') }}"
                class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                style="text-decoration: none;">
                Agregar Nuevo Medicamento
            </a>
        </div>

    {{-- Contenedor principal con borde verde --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <p class="mb-3 text-secondary fw-semibold">
                Desde aquí podés administrar los medicamentos disponibles en el sistema.
            </p>
            {{-- Tabla de medicamentos --}}
        <div class="bg-white shadow rounded-lg border border-gray-200 overflow-auto">
            <table id="tablaMedicamentos" class="table table-hover table-bordered shadow-sm text-center rounded">
                <thead>
                        <tr>
                            <th>Nombre del Medicamento</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($medicamentos as $medicamento)
                        <tr>
                            <td class="fw-medium">{{ $medicamento->nombre }}</td>
                            <td class="text-center">
                                <a href="{{ route('medicamentos.edit', $medicamento) }}"
                                   class="btn btn-outline-warning btn-sm me-1 btn-acciones">
                                     Editar
                                </a>
                                @if (!$medicamento->stocks()->exists())
                                <form action="{{ route('medicamentos.destroy', $medicamento) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm btn-acciones"
                                            onclick="return confirm('¿Estás seguro de que querés eliminar este medicamento?')">
                                        Eliminar
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-outline-secondary btn-sm btn-acciones" disabled title="Este medicamento no se puede eliminar">
                                    No eliminable
                                </button>
                            @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted">
                                No hay medicamentos cargados aún.
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
@push('scripts')
<script>
$(document).ready(function () {
    $('#tablaMedicamentos').DataTable({
        dom: '<"top-controls"Blf>rt<"bottom-controls"ip>',
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Exportar a Excel',
                className: 'btn btn-success btn-sm'
            },
            {
                extend: 'pdfHtml5',
                text: 'Exportar a PDF',
                className: 'btn btn-danger btn-sm',
                orientation: 'landscape',
                pageSize: 'A4',
                customize: function (doc) {
                    doc.defaultStyle.fontSize = 8;
                }
            }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            search: "Buscar medicamento:",
            lengthMenu: "Mostrar _MENU_ medicamentos por página",
            info: "Mostrando _START_ a _END_ de _TOTAL_ medicamentos",
            infoEmpty: "No hay medicamentos para mostrar",
            infoFiltered: "(filtrado de _MAX_ medicamentos en total)"
        },
        order: [[0, 'asc']], // Orden por nombre del medicamento
        columnDefs: [
            { orderable: false, targets: [1] } // Desactiva orden en columna Acciones
        ]
    });
});
</script>
@endpush
<style>
    .btn-acciones {
    min-width: 110px;
    text-align: center;
    }
</style>