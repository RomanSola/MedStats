@extends('layouts.app')

@section('title', 'Búsqueda')

@section('contenido')

<div class="page-container">

    <center>
        {{-- Formulario de búsqueda --}}
        <form action="{{ route('buscar') }}" method="GET" autocomplete="off">
    <input
    style="width: 300px; padding: 8px; margin-right: 10px;"
        type="text"
        id="busqueda"
        name="busqueda"
        placeholder="Buscar por nombre, apellido o DNI"
        value="{{ old('busqueda', request('busqueda')) }}"
        required
    >
    <button 
    style="padding: 8px 16px; background-color: #4CAF50; color: white; border: none; cursor: pointer;"
    type="submit">Buscar</button>

        </form>


 

    {{-- Formulario de búsqueda --}}
    <form action="{{ route('buscar') }}" method="GET" autocomplete="off" class="max-w-xl mx-auto mt-6 space-y-4">
        <div>
            <input
                type="text"
                id="busqueda"
                name="busqueda"
                placeholder="Buscar por nombre, apellido o DNI"
                value="{{ old('busqueda', request('busqueda')) }}"
                required
                class="form-input"
            >
        </div>
        <div class="text-center">
            <button type="submit" class="btn-primary">Buscar</button>
        </div>
    </form>

        <br>

        <h1 style="font-size: 24px; margin-bottom: 20px;">Datos Personales</h1>
        {{-- Si hay detalle de una persona --}}
        @if(isset($persona))
                    Nombre:{{ $persona->nombre }}
                    <br>
                    Apellido:{{ $persona->apellido }}
                    <br>
                    DNI:{{ $persona->dni }}
                    <br>
                    Fecha de Nacimiento:{{ \Carbon\Carbon::parse($persona->fecha_nacimiento)->format('d/m/Y') }}
                    <br>
                    Teléfono:{{ $persona->telefono }}
                    <br>
                    Dirección:{{ $persona->direccion }}
                    <br><br>
                    {{-- Acciones --}}
                    <a href="{{ route('pacientes.show', $persona) }}"
                                    class="text-neutral-700 hover:underline font-medium">Ver</a>
                                <a href="{{ route('pacientes.edit', $persona) }}"
                                    class="text-neutral-700 hover:underline font-medium">Editar</a>
                                @if ($persona->cama_id)
                                    <form action="{{ route('pacientes.darDeAlta', $persona) }}" method="POST"
                                        class="inline-block form-dar-de-alta">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:underline font-medium">Dar de
                                            alta</button>
                                    </form>
                                @else
                                    <form action="{{ route('pacientes.asignar', $persona) }}" method="GET"
                                        class="inline-block form-asignar">
                                        <button type="submit"
                                            class="text-blue-700 hover:underline font-medium">Asignar</button>
                                    </form>
                                @endif
                                <form action="{{ route('pacientes.destroy', $persona) }}" method="POST"
                                    class="inline-block form-eliminar">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:underline font-medium">Eliminar</button>
                                </form>
                    <br><br>

            <h2 style="font-size: 20px; margin-bottom: 15px;">Historial de Medicamentos</h2
            {{-- Mostrar medicamentos del historial --}}
            @php
                $historial = $persona->historial_stock()->with('get_stock.get_medicamento')->get();
            @endphp

        @if($historial->isNotEmpty())
            <h3 class="text-lg font-semibold mt-6 mb-2">Medicamentos administrados:</h3>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                @foreach ($historial as $registro)
                    @php
                        $medicamento = $registro->get_stock->get_medicamento ?? null;
                    @endphp
                    @if($medicamento)
                        <li>
                            <span class="font-medium">{{ $medicamento->nombre }}</span>
                            (Cantidad: {{ $registro->cantidad }})
                            - <span class="text-gray-500">Fecha: {{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') }}</span>
                        </li>
                    @endif
                @endforeach
            </ul>
        @else
            <p class="text-gray-500 mt-4">No tiene medicamentos administrados aún.</p>
        @endif

    {{-- Si hay una búsqueda con resultados --}}
    @elseif(isset($resultados))
        <h2 class="text-xl font-semibold mt-8">Resultados para "{{ $busqueda }}"</h2>

        @if($resultados->isEmpty())
            <p class="text-gray-500 mt-2">No se encontraron coincidencias.</p>
        @else
            <ul class="mt-4 space-y-2">
                @foreach ($resultados as $persona)
                    <li>
                        <a href="{{ route('persona.ver', $persona->id) }}" 
                           class="text-[#1B7D8F] hover:underline">
                            {{ $persona->nombre }} {{ $persona->apellido }} - DNI: {{ $persona->dni }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    @endif
</div>

{{-- jQuery y Autocomplete --}}
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
                window.location.href = '/persona/' + ui.item.id;
            }
        });
    });
</script>
@endsection
