@extends('layouts.app')
@section('titulo', 'Gestión de Pacientes')
@section('contenido')
   <!-- <div class="flex min-h-screen bg-gray-100 transition-all duration-300 ease-in-out">-->

        <!-- Main -->
        <main class="flex-1 p-5 max-w-full">
            <div class="flex justify-between items-center mb-6">
                <h1
                    class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2 px-2">
                    Pacientes Registrados</h1>
                <a href="{{ route('pacientes.create') }}"
                    class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                    style="text-decoration: none;">
                    Ingresar Nuevo Paciente
                </a>
            </div>

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
                <table id="tablaPacientes" class="table table-hover table-bordered shadow-sm text-center rounded">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">DNI</th>
                            <th class="px-4 py-2 border">Nombre</th>
                            <th class="px-4 py-2 border">Apellido</th>
                            <th class="px-4 py-2 border">Alergias</th>
                            <th class="px-4 py-2 border">Género</th>
                            <th class="px-4 py-2 border">Habitación</th>
                            <th class="px-4 py-2 border">Cama</th>
                            <th class="px-4 py-2 border text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pacientes as $paciente)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $paciente->dni }}</td>
                                <td class="px-4 py-2 border">{{ $paciente->nombre }}</td>
                                <td class="px-4 py-2 border">{{ $paciente->apellido }}</td>
                                <td class="px-4 py-2 border">{{ $paciente->alergias ?? '—' }}</td>
                                <td class="px-4 py-2 border">{{ $paciente->genero }}</td>
                                <td class="px-4 py-2 border">{{ $paciente->habitacion?->numero ?? '—' }}</td>
                                <td class="px-4 py-2 border">{{ $paciente->cama?->codigo ?? '—' }}</td>
                                <td class="px-4 py-2 border text-center">
                                    <a href="{{ route('pacientes.show', $paciente) }}"
                                        class="btn btn-outline-primary btn-sm me-1 btn-acciones">Ver</a>
                                    <a href="{{ route('pacientes.edit', $paciente) }}"
                                        class="btn btn-outline-warning btn-sm me-1 btn-acciones">Editar</a>
                                    @if ($paciente->cama_id)
                                        <form action="{{ route('pacientes.darDeAlta', $paciente) }}" method="POST"
                                            class="inline-block form-dar-de-alta">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-outline-success btn-sm me-1 btn-acciones">Dar de
                                                alta</button>
                                        </form>
                                    @else
                                        <form action="{{ route('pacientes.asignar', $paciente) }}" method="GET"
                                            class="inline-block form-asignar">
                                            <button type="submit"
                                                class="btn btn-outline-secondary btn-sm me-1 btn-acciones"> Asignar
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST"
                                        class="inline-block form-eliminar">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-outline-danger btn-sm me-1 btn-acciones">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-2 text-center text-gray-500">No hay pacientes registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </main>
    </div>

    <!-- MODAL DE CONFIRMACIÓN PERSONALIZADO -->
    <div id="modal-confirmacion" class="modal">
        <div class="modal-content">
            <p id="modal-mensaje">¿Estás seguro?</p>
            <div class="botones">
                <button id="modal-cancelar">Cancelar</button>
                <button id="modal-confirmar">Confirmar</button>
            </div>
        </div>
    </div>

    <!-- ESTILOS DEL MODAL -->
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        }

        .botones {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
        }

        .botones button {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #modal-cancelar {
            background-color: #ccc;
            color: #333;
        }

        #modal-confirmar {
            background-color: #d9534f;
            color: white;
        }

        .btn-acciones {
            min-width: 110px;
            /* ajusta hasta que quede igual al "Dar de alta" */
            text-align: center;
        }
    </style>
    @push('scripts')
        <!-- SCRIPT PARA MANEJAR LOS MODALES -->
        <script src="{{ asset('js/modal.js') }}">

        </script>
        <script>
            $(document).ready(function() {
                $('#tablaPacientes').DataTable({
                    dom: '<"top-controls"Blf>rt<"bottom-controls"ip>',
                    buttons: [{
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
                            customize: function(doc) {
                                doc.defaultStyle.fontSize = 8;
                            }
                        }
                    ],
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                        search: "Buscar paciente:",
                        lengthMenu: "Mostrar _MENU_ pacientes por página",
                        info: "Mostrando _START_ a _END_ de _TOTAL_ pacientes",
                        infoEmpty: "No hay pacientes para mostrar",
                        infoFiltered: "(filtrado de _MAX_ pacientes en total)"
                    },
                    order: [
                        [1, 'asc']
                    ], // Orden por nombre
                    columnDefs: [{
                            orderable: false,
                            targets: [7]
                        } // Desactiva orden en columna Acciones
                    ]
                });
            });
        </script>
    @endpush
@endsection
