@extends('layouts.app')

@section('title', 'Búsqueda')

@section('contenido')
    <center>
        {{-- Formulario de búsqueda --}}
        <form action="{{ route('buscar') }}" method="GET" autocomplete="off">
    <input
        style="width: 300px; padding: 10px; border-radius: 5px; border: 1px solid #ccc;"
        type="text"
        id="busqueda"
        name="busqueda"
        placeholder="Buscar por nombre, apellido o DNI"
        value="{{ old('busqueda', request('busqueda')) }}"
        required
    >
    <button 
    style="padding: 10px 15px; border-radius: 5px; background-color: #1B7D8F; color: white; border: none;" 
    type="submit">Buscar</button>
        </form>

        <br><br>
        <h1
        style="font-size: 24px; color: #333; font-weight: bold;">Datos Personales</h1>
        
        <br>

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

            <h1
        style="font-size: 24px; color: #333; font-weight: bold;">
        Historial de Medicamentos</h1>

        <br>
        
            {{-- Mostrar medicamentos del historial --}}
            @php
                $historial = $persona->historial_stock()->with('get_stock.get_medicamento')->get();
            @endphp

            @if($historial->isNotEmpty())
                <h3>Medicamentos administrados:</h3>
                <ul>
                    @foreach ($historial as $registro)
                        @php
                            $medicamento = $registro->get_stock->get_medicamento ?? null;
                        @endphp
                        @if($medicamento)
                            <li>
                                {{ $medicamento->nombre }}
                                (Cantidad: {{ $registro->cantidad }})
                                - Fecha: {{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') }}
                            </li>
                        @endif
                    @endforeach
                </ul>
            @else
                <p>No tiene medicamentos administrados aún.</p>
            @endif

        {{-- Si hay una búsqueda con resultados --}}
        @elseif(isset($resultados))
            <h2>Resultados para "{{ $busqueda }}"</h2>

            @if($resultados->isEmpty())
                <p>No se encontraron coincidencias.</p>
            @else
                <ul>
                    @foreach ($resultados as $persona)
                        <li>
                            <a href="{{ route('persona.ver', $persona->id) }}">
                                {{ $persona->nombre }} {{ $persona->apellido }} - DNI: {{ $persona->dni }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        @endif
    </center>

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
