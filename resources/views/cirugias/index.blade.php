@extends('layouts.app')

@section('title', 'Gestión de Cirugías')

@section('contenido')
<div class="max-w-full px-4 py-4">

    {{-- Título institucional rojo --}}
    <h2 class="text-danger fw-bold border-bottom border-danger pb-2 mb-4">
        Gestor de Cirugías
    </h2>

    {{-- Contenedor con borde rojo institucional --}}
    <div class="card border-danger shadow-sm">
        <div class="card-body text-dark">

            <p class="mb-3 fw-semibold">
                Administrá las cirugías registradas en el sistema. Podés ver detalles y editarlos.
            </p>

            {{-- Botón de acción --}}
            <a href="{{ route('cirugias.create') }}" class="btn btn-outline-danger fw-semibold mb-3">
                Registrar Nueva Cirugía
            </a>

            {{-- Tabla de cirugías --}}
            <div class="table-responsive">
                <table class="table table-bordered border-danger align-middle">
                    <thead class="table-danger text-dark">
                        <tr>
                            <th>Paciente</th>
                            <th>DNI</th>
                            <th>Edad</th>
                            <th>Procedimiento</th>
                            <th>Quirofano</th>
                            <th>Cirujano</th>
                            <th>Ayudante 1</th>
                            <th>Ayudante 2</th>
                            <th>Ayudante 3</th>
                            <th>Anestesista</th>
                            <th>Tipo de Anestesia</th>
                            <th>Instrumentador</th>
                            <th>Enfermero</th>
                            <th>Urgencia</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cirugias as $cirugia)
                        <tr>
                            <td>{{ $cirugia->get_paciente->nombre }} {{ $cirugia->get_paciente->apellido }}</td>
                            <td>{{ $cirugia->get_paciente->dni }}</td>
                            <td>
                                {{ optional($cirugia->get_paciente)->fecha_nacimiento
                                    ? \Carbon\Carbon::parse($cirugia->get_paciente->fecha_nacimiento)->age
                                    : '—' }}
                            </td>
                            <td>{{ $cirugia->get_procedimiento->nombre_procedimiento }}</td>
                            <td>{{ $cirugia->get_quirofano->nombre ?? 'N/A' }}</td>
                            <td>{{ $cirugia->get_cirujano->nombre }} {{ $cirugia->get_cirujano->apellido }}</td>
                            <td>{{ $cirugia->get_ayudante1->nombre ?? 'N/A' }} {{ $cirugia->get_ayudante1->apellido ?? '' }}</td>
                            <td>{{ optional($cirugia->get_ayudante2)->nombre ?? 'N/A' }} {{ optional($cirugia->get_ayudante2)->apellido ?? '' }}</td>
                            <td>{{ optional($cirugia->get_ayudante3)->nombre ?? 'N/A' }} {{ optional($cirugia->get_ayudante3)->apellido ?? '' }}</td>
                            <td>{{ $cirugia->get_anestesista->nombre }} {{ $cirugia->get_anestesista->apellido }}</td>
                            <td>{{ $cirugia->get_tipo_anestesia->nombre }}</td>
                            <td>{{ optional($cirugia->get_instrumentador)->nombre }} {{ optional($cirugia->get_instrumentador)->apellido }}</td>
                            <td>{{ optional($cirugia->get_enfermero)->nombre }} {{ optional($cirugia->get_enfermero)->apellido }}</td>
                            <td>{{ $cirugia->urgencia ? 'Sí' : 'No' }}</td>
                            <td class="text-center">
                                <a href="{{ route('cirugias.show', $cirugia) }}" class="btn btn-outline-danger btn-sm me-1">Ver</a>
                                <a href="{{ route('cirugias.edit', $cirugia) }}" class="btn btn-outline-warning btn-sm">Editar</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="15" class="text-center text-muted">
                                No hay cirugías registradas aún.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Botón de impresión --}}
            <button class="btn btn-outline-secondary mt-4" onclick="imprimirUltimosDiez()">
                Imprimir últimas 10 cirugías
            </button>

            {{-- Script de impresión --}}
            <script>
                function imprimirUltimosDiez() {
                    const tablaOriginal = document.querySelector('.table-responsive table');
                    const filas = tablaOriginal.querySelectorAll('tbody tr');
                    const ultimasFilas = Array.from(filas).slice(-10);
                    const encabezado = tablaOriginal.querySelector('thead').outerHTML;

                    let cuerpoTabla = '';
                    ultimasFilas.forEach(fila => {
                        cuerpoTabla += fila.outerHTML;
                    });

                    const ventana = window.open('', '', 'width=900,height=700');
                    ventana.document.write(`
                        <html>
                        <head>
                            <title>Libro de Cirugías</title>
                            <style>
                                body { font-family: Arial, sans-serif; margin: 20px; }
                                table { width: 100%; border-collapse: collapse; }
                                th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
                                th { background-color: #f8d7da; }
                            </style>
                        </head>
                        <body>
                            <h2>Últimas 10 Cirugías Registradas</h2>
                            <table>
                                ${encabezado}
                                <tbody>
                                    ${cuerpoTabla}
                                </tbody>
                            </table>
                        </body>
                        </html>
                    `);
                    ventana.document.close();
                    ventana.focus();
                    ventana.print();
                    ventana.close();
                }
            </script>

        </div>
    </div>
</div>
@endsection
