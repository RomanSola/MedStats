@extends('layouts.app')

@section('title', 'Búsqueda')

@section('contenido')
    <center>
        {{-- Formulario de búsqueda --}}
        <form action="{{ route('buscar') }}" method="GET" autocomplete="off">
    <input
        type="text"
        id="busqueda"
        name="busqueda"
        placeholder="Buscar por nombre, apellido o DNI"
        value="{{ old('busqueda', request('busqueda')) }}"
        required
    >
    <button type="submit">Buscar</button>
        </form>


        <br>

        {{-- Si hay detalle de una persona --}}
        @if(isset($persona))
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $persona->nombre }}</td>
                        <td>{{ $persona->apellido }}</td>
                        <td>{{ $persona->dni }}</td>
                    </tr>
                </tbody>
            </table>

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
