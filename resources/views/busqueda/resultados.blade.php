@extends('layouts.app')

@section('title', 'Búsqueda')

@section('contenido')
<div class="container mt-4">
    {{-- Título institucional --}}
    <h2 class="text-info fw-bold border-bottom border-info pb-2 mb-4">
        Búsqueda de Pacientes
    </h2>

    {{-- Formulario de búsqueda --}}
    <center>
        <form action="{{ route('buscar') }}" method="GET" autocomplete="off" class="mb-4">
            <input
                type="text"
                id="busqueda"
                name="busqueda"
                placeholder="Buscar por nombre, apellido o DNI"
                value="{{ old('busqueda', request('busqueda')) }}"
                required
                class="w-72 px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#1B7D8F]"
            >
            <button
                type="submit"
                class="px-4 py-2 rounded-md bg-[#1B7D8F] text-white hover:bg-[#176d7b] transition"
            >Buscar</button>
        </form>

        {{-- Si hay detalle de una persona --}}
        @if(isset($persona))
            {{-- Card del paciente --}}
            <div class="max-w-2xl mx-auto mb-6">
                <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">
                    {{-- Encabezado --}}
                    <div class="flex items-center bg-[#1B7D8F] text-white p-6">
                        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center mr-4 shadow">
                            {{-- Ícono de usuario --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#1B7D8F]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2V19.2c0-3.2-6.4-4.8-9.6-4.8z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold">{{ $persona->apellido }}, {{ $persona->nombre }}</h2>
                            <p class="text-sm opacity-90">DNI: {{ $persona->dni }}</p>
                        </div>
                    </div>

                    {{-- Datos personales --}}
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-700"><strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($persona->fecha_nacimiento)->format('d/m/Y') }}</p>
                            <p class="text-gray-700"><strong>Teléfono:</strong> {{ $persona->telefono }}</p>
                        </div>
                        <div>
                            <p class="text-gray-700"><strong>Dirección:</strong> {{ $persona->direccion }}</p>
                            @if ($persona->cama_id)
                                <p class="text-green-700 font-semibold">Paciente actualmente internado</p>
                            @else
                                <p class="text-gray-500">Sin cama asignada</p>
                            @endif
                        </div>
                    </div>

                    {{-- Acciones rápidas --}}
                    <div class="bg-gray-50 p-4 flex flex-wrap gap-3 justify-end">
                        <a href="{{ route('pacientes.show', ['paciente' => $persona->id, 'from' => 'busqueda', 'id' => $persona->id]) }}"
                           class="px-3 py-2 border border-gray-600 text-gray-600 rounded-lg hover:bg-gray-600 hover:text-white transition">
                           👁️ Ver
                        </a>
                        <a href="{{ route('pacientes.edit', ['paciente' => $persona->id, 'from' => 'busqueda', 'id' => $persona->id]) }}"
                           class="px-3 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition">
                           ✏️ Editar
                        </a>

                        @if ($persona->cama_id)
                            <form action="{{ route('pacientes.darDeAlta', ['paciente' => $persona->id, 'from' => 'busqueda', 'id' => $persona->id]) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="px-3 py-2 border border-green-600 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition">
                                    ✅ Dar de alta
                                </button>
                            </form>
                        @else
                            <form action="{{ route('pacientes.asignar', ['paciente' => $persona->id, 'from' => 'busqueda', 'id' => $persona->id]) }}" method="GET" class="inline-block">
                                <button type="submit" class="px-3 py-2 border border-green-600 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition">
                                    🛏️ Asignar
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('pacientes.destroy', ['paciente' => $persona->id, 'from' => 'busqueda', 'id' => $persona->id]) }}" method="POST" class="inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-3 py-2 border border-red-600 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Historial de medicamentos --}}
            <div class="max-w-2xl mx-auto mb-6">
                <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">
                    <div class="bg-[#1B7D8F] text-white p-4">
                        <h2 class="text-xl font-bold">Historial de Medicamentos</h2>
                    </div>
                    <div class="p-6">
                        @php
                            $historial = $persona->historial_stock()->with('get_stock.get_medicamento')->get();
                        @endphp

                        @if($historial->isNotEmpty())
                            <ul class="list-disc pl-6 space-y-2 text-gray-700">
                                @foreach ($historial as $registro)
                                    @php $medicamento = $registro->get_stock->get_medicamento ?? null; @endphp
                                    @if($medicamento)
                                        <li>
                                            <strong>{{ $medicamento->nombre }}</strong>
                                            (Cantidad: {{ $registro->cantidad }})
                                            - Fecha: {{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') }}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500">No tiene medicamentos administrados aún.</p>
                        @endif
                    </div>
                </div>
            </div>

        {{-- Resultados múltiples --}}
        @elseif(isset($resultados))
            <h2 class="text-lg font-semibold mb-4">Resultados para "{{ $busqueda }}"</h2>

            @if($resultados->isEmpty())
                <div class="max-w-lg mx-auto mb-6">
                    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200 text-center p-8">
                        <div class="flex flex-col items-center space-y-4">
                            <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center shadow">
                                {{-- Ícono sin resultados --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 15h-2v-2h2v2zm1.07-7.75l-.9.92C12.45 10.9 12 11.5 12 13h-2v-.5c0-.83.45-1.5 1.17-2.18l1.24-1.26c.37-.36.59-.86.59-1.41A2.5 2.5 0 0010.5 5c-1.38 0-2.5 1.12-2.5 2.5H6A4.5 4.5 0 0110.5 3c2.48 0 4.5 2.02 4.5 4.5 0 .88-.36 1.68-.93 2.25z"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-700">Sin resultados</h2>
                            <p class="text-gray-500">No se encontraron pacientes que coincidan con la búsqueda.</p>
                            <a href="{{ route('buscar') }}" class="mt-4 px-4 py-2 bg-[#1B7D8F] text-white rounded-lg hover:bg-[#176d7b] transition">
                                🔄 Intentar de nuevo
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="max-w-2xl mx-auto mb-6">
                    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">
                        <ul class="space-y-2 m-4">
                            @foreach ($resultados as $persona)
                                <li>
                                    <a href="{{ route('persona.ver', ['id' => $persona->id, 'from' => 'busqueda']) }}"
                                    class="text-[#176d7b] btn border-[#176d7b]">
                                        {{ $persona->nombre }} {{ $persona->apellido }} - DNI: {{ $persona->dni }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        @endif
    </center>
</div>

{{-- Autocomplete --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script>
    $(function () {
        $('#busqueda').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "{{ route('buscar.ajax') }}",
                    data: { term: request.term },
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {
                                label: item.nombre + " " + item.apellido + " - DNI: " + item.dni,
                                value: item.nombre + " " + item.apellido,
                                id: item.id
                            };
                        }));
                    }
                });
            },
            select: function (event, ui) {
                // Redirigir agregando from=busqueda
                window.location.href = '/persona/' + ui.item.id + '?from=busqueda';
            }
        });
    });
</script>
@endsection