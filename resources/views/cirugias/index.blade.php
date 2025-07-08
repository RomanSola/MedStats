@extends('layouts.app')

@section('title', 'Gestión de Cirugias')

@section('contenido')
    <div class="container mt-4">
        <h2 class="mb-4">Gestor de Cirugias</h2>

        <div class="card border-warning">
            <div class="card-body">
                <p class="card-text">Administrá las cirugias registradas en el sistema. Podés ver detalles y editarlos.</p>
                <a href="{{ route('cirugias.create') }}" class="btn btn-warning mb-3">Registrar Nueva Cirugía</a>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-warning">
                            <tr>
                                <th>Paciente</th>
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
                                    <td>{{ $cirugia->get_procedimiento->nombre_procedimiento }}</td>
                                    <td>{{ $cirugia->get_quirofano->nombre ?? 'N/A' }}</td>
                                    <td>{{ $cirugia->get_cirujano->nombre }} {{ $cirugia->get_cirujano->apellido }}</td>
                                    <td>{{ $cirugia->get_ayudante1->nombre ?? 'N/A' }}
                                        {{ $cirugia->get_ayudante1->apellido ?? '' }}
                                    </td>
                                    <td>{{ $cirugia->get_ayudante2->nombre }} {{ $cirugia->get_ayudante2->apellido }}
                                    </td>
                                    <td>{{ $cirugia->get_ayudante3->nombre ?? 'N/A' }}
                                        {{ $cirugia->get_ayudante3->apellido ?? '' }}
                                    </td>
                                    <td>{{ $cirugia->get_anestesista->nombre }} {{ $cirugia->get_anestesista->apellido }}
                                    </td>
                                    <td>{{ $cirugia->get_tipo_anestesia->nombre }}</td>
                                    <td>{{ $cirugia->get_instrumentador->nombre }}
                                        {{ $cirugia->get_instrumentador->apellido }}</td>
                                    <td>{{ $cirugia->get_enfermero->nombre }}
                                        {{ $cirugia->get_enfermero->apellido }}</td>
                                    <td>{{ $cirugia->urgencia ? 'Si' : 'No' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('cirugias.show', $cirugia) }}"
                                            class="btn btn-outline-primary btn-sm me-1">Ver</a>
                                        <a href="{{ route('cirugias.edit', $cirugia) }}"
                                            class="btn btn-outline-warning btn-sm me-1">Editar</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center text-muted">No hay cirugias registradas aún.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- Botón de impresión -->
        <button class="btn-imprimir" onclick="imprimirUltimosDiez()">🖨️ Imprimir últimas 10 cirugias</button>

        <script>
        function imprimirUltimosDiez() {
            const tablaOriginal = document.querySelector('.table-responsive table');
            const filas = tablaOriginal.querySelectorAll('tbody tr');
            const ultimasFilas = Array.from(filas).slice(-10); // Toma las últimas 10
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
                th { background-color: #f8c045; }
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
@endsection