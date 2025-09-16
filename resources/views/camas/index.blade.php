@extends('layouts.app')

@section('titulo', 'Gestión de Camas')

@section('contenido')
<div class="max-w-6xl mx-auto px-4 py-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
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
                    <div class="bg-white rounded-xl border border-gray-300 shadow p-4 text-center">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                            Habitación {{ $cama->get_habitacion->numero ?? 'Sin asignar' }}
                        </h3>

                        <div class="bg-gray-100 rounded-lg p-3 mb-2 shadow-inner">
                            <h5 class="text-md font-bold text-gray-800 mb-3">
                                Cama {{ $cama->codigo }}
                            </h5>

                            {{-- Datos del paciente --}}
                            @if ($cama->ocupada && $cama->paciente)
                                <div class="text-left text-sm bg-white border border-gray-200 rounded-lg px-3 py-2 mb-3 space-y-1">
                                    <p><strong>Nombre:</strong> {{ $cama->paciente->nombre }} {{ $cama->paciente->apellido }}</p>
                                    <p><strong>DNI:</strong> {{ $cama->paciente->dni }}</p>

                                    @php
                                        $fechaNacimiento = \Carbon\Carbon::parse($cama->paciente->fecha_nacimiento);
                                        $hoy = \Carbon\Carbon::now();
                                        $dias = $fechaNacimiento->diffInDays($hoy);
                                        $semanas = floor($dias / 7);
                                        $meses = $fechaNacimiento->diffInMonths($hoy);
                                        $anios = $fechaNacimiento->diffInYears($hoy);
                                        $mesesExtras = $meses - ($anios * 12);
                                    @endphp

                                    @if ($dias < 15)
                                        <p><strong>Edad:</strong> {{ $dias }} {{ $dias === 1 ? 'día' : 'días' }}</p>
                                    @elseif ($dias < 31)
                                        <p><strong>Edad:</strong> {{ $semanas }} {{ $semanas === 1 ? 'semana' : 'semanas' }}</p>
                                    @elseif ($anios < 1)
                                        <p><strong>Edad:</strong> {{ $meses }} {{ $meses === 1 ? 'mes' : 'meses' }}</p>
                                    @elseif ($anios < 3)
                                        <p><strong>Edad:</strong> {{ $anios }} {{ $anios === 1 ? 'año' : 'años' }}
                                            @if ($mesesExtras > 0)
                                                ({{ $mesesExtras }} {{ $mesesExtras === 1 ? 'mes' : 'meses' }})
                                            @endif
                                        </p>
                                    @else
                                        <p><strong>Edad:</strong> {{ $anios }} años</p>
                                    @endif

                                    <p><strong>Género:</strong> {{ $cama->paciente->genero }}</p>
                                    <p><strong>Teléfono:</strong> {{ $cama->paciente->telefono }}</p>
                                    <p><strong>Dirección:</strong> {{ $cama->paciente->direccion }}</p>
                                </div>
                            @endif

                            {{-- Estado --}}
                            <div class="mb-3">
                                <span class="text-xs font-semibold text-white px-3 py-1 rounded-full inline-block
                                    {{ $cama->ocupada == 'ocupada' ? 'bg-red-500' : 'bg-green-500' }}">
                                    {{ $cama->ocupada == 'ocupada' ? 'OCUPADA' : 'LIBRE' }}
                                </span>
                            </div>

                            {{-- Botones --}}
                            <div class="flex flex-col items-center space-y-2">
                                @if ($cama->ocupada && $cama->paciente)
                                    <form action="{{ route('pacientes.darDeAlta', ['paciente' => $cama->paciente->id, 'from' => 'camas.index']) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success btn-sm">
                                            Dar de Alta
                                        </button>
                                    </form>
                                @else
                                    <button type="button"
                                            class="btn btn-outline-secondary btn-sm"
                                            data-toggle="modal"
                                            data-target="#asignarPacienteModal"
                                            data-cama-id="{{ $cama->id }}">
                                        Asignar paciente
                                    </button>
                                @endif

                                <a href="{{ route('camas.edit', ['cama' => $cama->id]) }}"
                                   class="btn btn-outline-warning btn-sm">
                                    Editar cama
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="asignarPacienteModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Asignar paciente a cama</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="buscarPaciente" class="form-control mb-3" placeholder="Buscar paciente por nombre o DNI...">
        <div id="listaPacientes">
          <p class="text-muted">Escriba para buscar pacientes.</p>
        </div>
      </div>
    </div>
  </div>
</div>
{{--Modal Script--}}
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

{{-- Script --}}
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    let camaSeleccionada = null;
    let formPendiente = null;

    const inputBusqueda = document.getElementById('buscarPaciente');
    const listaPacientes = document.getElementById('listaPacientes');
    const csrfToken = "{{ csrf_token() }}";

    $('#asignarPacienteModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        camaSeleccionada = button.data('cama-id');
        inputBusqueda.value = "";
        listaPacientes.innerHTML = "<p class='text-muted'>Escriba para buscar pacientes.</p>";
    });

    inputBusqueda.addEventListener("keyup", function () {
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
                    listaPacientes.innerHTML = "<p class='text-danger'>No se encontraron pacientes.</p>";
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
                listaPacientes.innerHTML = "<p class='text-danger'>Error al buscar pacientes.</p>";
            });
    });

    window.confirmarReasignacion = function (form) {
        formPendiente = form;
        $('#confirmarReasignacionModal').modal('show');
    };

    document.getElementById('btnConfirmarReasignacion').addEventListener('click', function () {
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
