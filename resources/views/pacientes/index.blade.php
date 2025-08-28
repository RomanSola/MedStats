@extends('layouts.app')

@section('titulo', 'Gestión de Pacientes')

@section('contenido')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360]
           text-transparent bg-clip-text drop-shadow-md mb-6">Pacientes Registrados</h1>
            <a href="{{ route('pacientes.create') }}"
                class="bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow">
                + Ingresar Nuevo Paciente
            </a>
        </div>
        <!--Buscador -->
        <form action="{{ route('pacientes.index') }}" method="GET" class="mb-4 flex space-x-2">
            <input type="text" name="buscar" value="{{ request('buscar') }}"
                placeholder="Buscar paciente por DNI, nombre o apellido"
                class="border border-gray-300 rounded px-3 py-2 w-1/3">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Buscar
            </button>
        </form>
        
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
            <table class="min-w-full text-sm text-gray-800 table-auto">
                <thead class="bg-gray-100 text-gray-700 font-semibold">
                    <tr>
                        <th class="px-4 py-2 border">DNI</th>
                        <th class="px-4 py-2 border">Nombre</th>
                        <th class="px-4 py-2 border">Apellido</th>
                        <th class="px-4 py-2 border">Teléfono</th>
                        <th class="px-4 py-2 border">Género</th>
                        <th class="px-4 py-2 border">Habitación</th>
                        <th class="px-4 py-2 border">Cama</th>
                        <th class="px-4 py-2 border text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pacientes as $paciente)
                        <tr class="hover:bg-gray-50">
                            <td class="table-cell">{{ $paciente->dni }}</td>
                            <td class="table-cell">{{ $paciente->nombre }}</td>
                            <td class="table-cell">{{ $paciente->apellido }}</td>
                            <td class="table-cell">{{ $paciente->telefono }}</td>
                            <td class="table-cell">{{ $paciente->genero }}</td>
                            <td class="table-cell">{{ $paciente->habitacion?->numero ?? '—' }}</td>
                            <td class="table-cell">{{ $paciente->cama?->codigo ?? '—' }}</td>
                            <td class="table-cell text-center flex justify-center gap-1">

                                {{-- Ver --}}
                                <a href="{{ route('pacientes.show', $paciente) }}" class="btn-outline-secondary text-sm">
                                    Ver
                                </a>

                                {{-- Editar --}}
                                <a href="{{ route('pacientes.edit', $paciente) }}" class="btn-outline-warning text-sm">
                                    Editar
                                </a>

                                {{-- Dar de alta o Asignar --}}
                                @if ($paciente->cama_id)
                                    <form action="{{ route('pacientes.darDeAlta', $paciente) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit" class="btn-outline-primary text-sm">
                                            Dar de alta
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('pacientes.asignar', $paciente) }}" method="GET"
                                        class="inline">
                                        <button type="submit" class="btn-outline-primary text-sm">
                                            Asignar
                                        </button>
                                    </form>
                                @endif

                                {{-- Eliminar --}}
                                <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-outline-danger text-sm"
                                        onclick="return confirm('¿Estás seguro de que querés eliminar este paciente?')">
                                        Eliminar
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="table-empty">No hay pacientes registrados.</td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
        </div>
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
    </style>

    <!-- SCRIPT PARA MANEJAR LOS MODALES -->
    <script src="{{ asset('js/modal.js') }}">
    /*
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modal-confirmacion');
            const mensaje = document.getElementById('modal-mensaje');
            const btnCancelar = document.getElementById('modal-cancelar');
            const btnConfirmar = document.getElementById('modal-confirmar');


                        document.addEventListener('DOMContentLoaded', function() {
                            const modal = document.getElementById('modal-confirmacion');
                            const mensaje = document.getElementById('modal-mensaje');
                            const btnCancelar = document.getElementById('modal-cancelar');
                            const btnConfirmar = document.getElementById('modal-confirmar');

                            let formularioActual = null;

                            // Abre el modal con el mensaje deseado y referencia al formulario
                            function abrirModal(texto, form) {
                                mensaje.textContent = texto;
                                formularioActual = form;
                                modal.style.display = 'block';
                            }

                            // Cierra el modal si el usuario cancela
                            btnCancelar.addEventListener('click', () => {
                                modal.style.display = 'none';
                                formularioActual = null;
                            });

                            // Envía el formulario si el usuario confirma
                            btnConfirmar.addEventListener('click', () => {
                                if (formularioActual) formularioActual.submit();
                            });

                            // CONFIRMACIÓN PARA DAR DE ALTA
                            document.querySelectorAll('.form-dar-de-alta').forEach(form => {
                                form.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    abrirModal(
                                        '¿Estás seguro que querés dar de alta a este paciente? Esta acción liberará la cama asignada.',
                                        form);
                                });
                            });

                            // CONFIRMACIÓN PARA ELIMINAR
                            document.querySelectorAll('.form-eliminar').forEach(form => {
                                form.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    abrirModal(
                                        '¿Seguro que querés eliminar este paciente? Esta acción no se puede deshacer.',
                                        form);
                                });
                            });

                            // CONFIRMACIÓN PARA ASIGNAR
                            document.querySelectorAll('.form-asignar').forEach(form => {
                                form.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    abrirModal('¿Querés asignar una cama a este paciente?', form);
                                });
                            });

                            // Cierra el modal si se hace clic fuera del contenido
                            window.onclick = function(event) {
                                if (event.target == modal) {
                                    modal.style.display = "none";
                                    formularioActual = null;
                                }
                            };
                        });

                    */
    </script>
@endsection
