@extends('layouts.app')
@section('titulo', 'Gestión de Camas')
@section('contenido')
    {{-- <div class="max-w-7xl mx-auto px-4 py-8"> --}}
    <div class="relative z- max-w-7xl mx-auto px-4 py-0 mt-16 lg:ml-64 transition-all duration-300">
        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
                Listado de Camas
            </h1>
        </div>

        {{-- Filtro por sala --}}
        <form method="GET" action="{{ route('camas.index') }}" class="mb-4">
            <div class="flex items-center gap-2">
                <label for="sala" class="text-sm font-semibold text-gray-700">Filtrar por Sala:</label>
                <select name="sala_id" id="sala" onchange="this.form.submit()"
                    class="rounded-md border border-gray-300 shadow-sm px-3 py-1 focus:ring-2 focus:ring-green-500">
                    <option value="">Todas las salas</option>
                    @foreach ($salas as $sala)
                        <option value="{{ $sala->id }}" {{ request('sala_id') == $sala->id ? 'selected' : '' }}>
                            {{ $sala->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        {{-- Contenedor azul degradado --}}
        <div class="p-[1px] rounded-xl bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] shadow-md mb-4">
            <div class="bg-white rounded-xl p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($camas as $cama)
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 transform overflow-hidden group">
                            <!-- Cabecera de la tarjeta: Num de Habitación -->
                            <div class="bg-gray-50 px-4 py-3 border-b border-gray-100 flex justify-between items-center">
                                <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Habitación</span>
                                <span class="text-lg font-bold text-gray-800">{{ $cama->get_habitacion->numero ?? 'N/A' }}</span>
                            </div>

                            <div class="p-4">
                                <!-- Título de Cama y Badge de Estado -->
                                <div class="flex justify-between items-start mb-4">
                                    <div class="text-left">
                                        <h5 class="text-sm font-medium text-gray-500 mb-0.5">Cama</h5>
                                        <span class="text-xl font-bold text-gray-900">{{ $cama->codigo }}</span>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $cama->ocupada == 'ocupada' ? 'bg-red-50 text-red-700 border border-red-100' : 'bg-emerald-50 text-emerald-700 border border-emerald-100' }}">
                                        <span class="relative flex h-2 w-2">
                                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 {{ $cama->ocupada == 'ocupada' ? 'bg-red-400' : 'bg-emerald-400' }}"></span>
                                          <span class="relative inline-flex rounded-full h-2 w-2 {{ $cama->ocupada == 'ocupada' ? 'bg-red-500' : 'bg-emerald-500' }}"></span>
                                        </span>
                                        {{ $cama->ocupada == 'ocupada' ? 'Ocupada' : 'Libre' }}
                                    </span>
                                </div>

                                {{-- Datos del paciente --}}
                                @if ($cama->ocupada && $cama->paciente)
                                    <div class="text-left bg-blue-50/50 rounded-lg p-3 space-y-2 mb-4 border border-blue-100/50">
                                        <!-- Nombre y Edad -->
                                        <div>
                                            <p class="font-bold text-gray-900 text-sm truncate" title="{{ $cama->paciente->nombre }} {{ $cama->paciente->apellido }}">
                                                {{ $cama->paciente->nombre }} {{ $cama->paciente->apellido }}
                                            </p>
                                            
                                            @php
                                                $fechaNacimiento = \Carbon\Carbon::parse($cama->paciente->fecha_nacimiento);
                                                $hoy = \Carbon\Carbon::now();
                                                $dias = $fechaNacimiento->diffInDays($hoy);
                                                $semanas = floor($dias / 7);
                                                $meses = $fechaNacimiento->diffInMonths($hoy);
                                                $anios = $fechaNacimiento->diffInYears($hoy);
                                                
                                                $edadTexto = "";
                                                if ($dias < 15) $edadTexto = "$dias días";
                                                elseif ($dias < 31) $edadTexto = "$semanas semanas";
                                                elseif ($anios < 1) $edadTexto = "$meses meses";
                                                else $edadTexto = "$anios años";
                                            @endphp

                                            <p class="text-xs text-blue-600 font-medium flex items-center gap-1 mt-0.5">
                                                <i data-lucide="cake" class="w-3 h-3"></i> {{ $edadTexto }}
                                            </p>
                                        </div>

                                        <!-- Detalles: DNI, Género, Teléfono -->
                                        <div class="space-y-1.5 pt-1">
                                            <div class="flex items-center gap-2 text-xs text-gray-600">
                                                <i data-lucide="credit-card" class="w-3.5 h-3.5 text-gray-400"></i>
                                                <span>{{ $cama->paciente->dni }}</span>
                                            </div>
                                            <div class="flex items-center gap-2 text-xs text-gray-600">
                                                <i data-lucide="user" class="w-3.5 h-3.5 text-gray-400"></i>
                                                <span>{{ $cama->paciente->genero }}</span>
                                            </div>
                                            <div class="flex items-center gap-2 text-xs text-gray-600">
                                                <i data-lucide="phone" class="w-3.5 h-3.5 text-gray-400"></i>
                                                <span>{{ $cama->paciente->telefono ?? '-' }}</span>
                                            </div>
                                        </div>

                                        <!-- Alergias -->
                                        @if($cama->paciente->alergias && $cama->paciente->alergias != 'Sin alergias registradas')
                                            <div class="mt-2 pt-2 border-t border-blue-100">
                                                <div class="bg-red-50 border border-red-100 rounded-md p-2 flex gap-2 items-start">
                                                    <i data-lucide="alert-circle" class="w-4 h-4 text-red-500 flex-shrink-0 mt-0.5"></i>
                                                    <div class="text-xs text-red-700 leading-tight">
                                                        <span class="font-bold block mb-0.5">Alergias:</span>
                                                        {{ \Illuminate\Support\Str::limit($cama->paciente->alergias, 50) }}
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="mt-2 pt-2 border-t border-blue-100">
                                                <div class="flex items-center gap-1.5 text-xs text-gray-400">
                                                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i>
                                                    <span>Sin alergias conocidas</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="h-40 flex flex-col items-center justify-center text-gray-400 bg-gray-50/50 rounded-lg border border-dashed border-gray-200 mb-4">
                                        <i data-lucide="bed" class="w-10 h-10 mb-2 opacity-50"></i>
                                        <span class="text-sm">Disponible</span>
                                    </div>
                                @endif

                                {{-- Botones --}}
                                <div class="mt-auto pt-2">
                                    @if ($cama->ocupada && $cama->paciente)
                                        <form
                                            action="{{ route('pacientes.darDeAlta', ['paciente' => $cama->paciente->id, 'from' => 'camas.index']) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-white hover:bg-emerald-50 text-emerald-600 border border-emerald-200 hover:border-emerald-300 font-medium py-2 px-4 rounded-lg transition-colors text-sm shadow-sm">
                                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                                Dar de Alta
                                            </button>
                                        </form>
                                    @else
                                        <button type="button" 
                                            class="w-full flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800 text-white font-medium py-2 px-4 rounded-lg transition-colors text-sm shadow-md" 
                                            data-toggle="modal"
                                            data-target="#asignarPacienteModal" data-cama-id="{{ $cama->id }}"
                                            data-sala-id="{{ request('sala_id') }}">
                                            <i data-lucide="user-plus" class="w-4 h-4"></i>
                                            Asignar Paciente
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('modales')
        {{-- Modal Asignar Paciente --}}
        <div class="modal fade" id="asignarPacienteModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    {{-- El formulario se genera dinámicamente en JS --}}
                    <div class="modal-header">
                        <h5 class="modal-title">Asignar paciente a cama</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="buscarPaciente" class="form-control mb-3"
                            placeholder="Buscar paciente por nombre o DNI...">
                        <div id="listaPacientes">
                            <p class="text-muted">Escriba para buscar pacientes.</p>
                        </div>

                        {{-- Campos ocultos para cama y sala --}}
                        <input type="hidden" name="cama_id" id="hiddenCamaId">
                        <input type="hidden" name="sala_id" id="hiddenSalaId">
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Confirmar Reasignación --}}
        <div class="modal fade" id="confirmarReasignacionModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar reasignación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que querés reasignar a este paciente a otra cama?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="btnConfirmarReasignacion">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let camaSeleccionada = null;
                let salaSeleccionada = null;
                let formPendiente = null;

                const inputBusqueda = document.getElementById('buscarPaciente');
                const listaPacientes = document.getElementById('listaPacientes');
                const csrfToken = "{{ csrf_token() }}";

                $('#asignarPacienteModal').on('show.bs.modal', function(event) {
                    const button = $(event.relatedTarget);
                    camaSeleccionada = button.data('cama-id');
                    salaSeleccionada = button.data('sala-id');
                    document.getElementById('hiddenCamaId').value = camaSeleccionada;
                    document.getElementById('hiddenSalaId').value = salaSeleccionada;
                    inputBusqueda.value = "";
                    listaPacientes.innerHTML = "<p class='text-muted'>Escriba para buscar pacientes.</p>";
                });

                inputBusqueda.addEventListener("keyup", function() {
                    const q = this.value.trim();
                    if (q.length < 2) {
                        listaPacientes.innerHTML = "<p class='text-muted'>Escriba al menos 2 caracteres.</p>";
                        return;
                    }

                    fetch(`/pacientes/live-search?buscar=${encodeURIComponent(q)}`)
                        .then(res => res.json())
                        .then(data => {
                            listaPacientes.innerHTML = "";
                            if (data.length === 0) {
                                listaPacientes.innerHTML =
                                    "<p class='text-danger'>No se encontraron pacientes.</p>";
                                return;
                            }

                            data.forEach(p => {
                                const form = document.createElement("form");
                                form.method = "POST";
                                form.action = `/pacientes/${p.id}/asignar-directa`;

                                const yaAsignado = p.cama_id !== null;
                                form.innerHTML = `
<input type="hidden" name="_token" value="${csrfToken}">
<input type="hidden" name="cama_id" value="${camaSeleccionada}">
<input type="hidden" name="sala_id" value="${salaSeleccionada}">
<div class="border rounded p-2 mb-2 ${yaAsignado ? 'bg-light' : ''}">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <strong>${p.nombre} ${p.apellido}</strong> (DNI: ${p.dni})
            ${yaAsignado 
                ? `<br><span class="text-danger">⚠️ Este paciente ya tiene una cama asignada</span>` 
                : ''
            }
        </div>
        <div>
            ${yaAsignado
                ? `<button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmarReasignacion(this.form)">Reasignar</button>`
                : `<button type="submit" class="btn btn-sm btn-outline-success">Asignar</button>`
            }
        </div>
    </div>
</div>`;
                                listaPacientes.appendChild(form);
                            });
                        })
                        .catch(err => {
                            console.error(err);
                            listaPacientes.innerHTML =
                                "<p class='text-danger'>Error al buscar pacientes.</p>";
                        });
                });

                window.confirmarReasignacion = function(form) {
                    formPendiente = form;
                    $('#confirmarReasignacionModal').modal('show');
                };

                document.getElementById('btnConfirmarReasignacion').addEventListener('click', function() {
                    if (formPendiente) {
                        formPendiente.submit();
                        formPendiente = null;
                        $('#confirmarReasignacionModal').modal('hide');
                    }
                });
            });
        </script>
    @endpush
@endsection