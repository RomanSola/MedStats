@extends('layouts.app')

@section('title', 'Gestión de Cirugías')

@section('contenido')
    <div class="container mt-4">
        <h2 class="mb-4">Gestor de Cirugías</h2>

        <div class="card border-danger">
            <div class="card-body">
                <p class="card-text">Administrá las cirugías registradas en el sistema. Podés ver detalles y editarlos.</p>
                <a href="{{ route('cirugias.create') }}" class="btn btn-danger mb-3">Registrar Nueva Cirugía</a>

                <div class="table-responsive">
                    <table id= "miTabla" class="table table-bordered align-middle">
                        <thead class="table-warning">
                            <tr>
                                <th>Paciente</th>
                                <th>DNI</th>
                                <th>Edad</th>
                                <th>Procedimiento</th>
                                <th>Quirófano</th>
                                <th>Cirujano</th>
                                <th class="no-print">Ayudante 1</th>
                                <th class="no-print">Ayudante 2</th>
                                <th class="no-print">Ayudante 3</th>
                                <th>Anestesista</th>
                                <th>Tipo de Anestesia</th>
                                <th>Instrumentador</th>
                                <th>Enfermero</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Urgencia</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        <style>
                        @media print {
                            .no-print{
                                display: none !important;
                            }
                            }
                        </style>
                        </thead>
                        <tbody>
                            @forelse($cirugias as $cirugia)
                                <tr>
                                    <td>
                                        {{ $cirugia->get_paciente->nombre }}
                                        {{ $cirugia->get_paciente->apellido }}
                                    </td>
                                    <td>
                                        {{ $cirugia->get_paciente->dni }}
                                    </td>
                                    <td>
                                        {{ optional($cirugia->get_paciente)->fecha_nacimiento
                                        ? \Carbon\Carbon::parse($cirugia->get_paciente->fecha_nacimiento)->age
                                        : '—' }}
                                    </td>
                                    <td>
                                        {{ $cirugia->get_procedimiento->nombre_procedimiento }}
                                    </td>
                                    <td>
                                        {{ $cirugia->get_quirofano->nombre ?? 'N/A' }}
                                    </td>
                                    <td>
                                        {{ $cirugia->get_cirujano->nombre }}
                                        {{ $cirugia->get_cirujano->apellido }}
                                    </td>
                                    <td class="no-print">
                                        {{ $cirugia->get_ayudante1->nombre ?? 'N/A' }}
                                        {{ $cirugia->get_ayudante1->apellido ?? '' }}
                                    </td>
                                    <td class="no-print">
                                        {{ optional($cirugia->get_ayudante2)->nombre ?? 'N/A' }}
                                        {{ optional($cirugia->get_ayudante2)->apellido ?? '' }}
                                    </td>
                                    <td class="no-print">
                                        {{ optional($cirugia->get_ayudante3)->nombre ?? 'N/A' }}
                                        {{ optional($cirugia->get_ayudante3)->apellido ?? '' }}
                                    </td>
                                    <td>
                                        {{ $cirugia->get_anestesista->nombre }}
                                        {{ $cirugia->get_anestesista->apellido }}
                                    </td>
                                    <td>
                                        {{ $cirugia->get_tipo_anestesia->nombre }}
                                    </td>
                                    <td>{{ optional($cirugia->get_instrumentador)->nombre }}
                                        {{ optional($cirugia->get_instrumentador)->apellido }}
                                    </td>
                                    <td>
                                        {{ optional($cirugia->get_enfermero)->nombre }}
                                        {{ optional($cirugia->get_enfermero)->apellido }}
                                    </td>
                                    <td>
                                        {{ $cirugia->fecha_cirugia ?? '' }}
                                    </td>
                                    <td>
                                        {{ $cirugia->hora_cirugia ?? '' }}
                                    </td>
                                    <td>
                                        {{ $cirugia->urgencia ? 'Si' : 'No' }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('cirugias.show', $cirugia) }}"
                                            class="btn btn-outline-primary btn-sm me-1">Ver</a>
                                        <a href="{{ route('cirugias.edit', $cirugia) }}"
                                            class="btn btn-outline-warning btn-sm me-1">Editar</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center text-muted">No hay cirugías registradas aún.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

            {{-- Botón de impresión <button class="btn btn-outline-secondary mt-4" onclick="imprimirUltimosDiez()">
                Imprimir últimas 10 cirugías
            </button>--}}
            

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
        <!-- Botón de impresión -->
    <div class="mb-3">
        <button onclick="imprimirTablaCompleta()" class="btn btn-secondary me-2">
            🖨️ Imprimir toda la tabla
        </button>


        <button onclick="exportarFiltradoPDF()" class="btn btn-warning">

            📄 Exportar PDF filtrado
        </button>
    </div>
@endsection

@push('scripts')
    <!-- jsPDF y autoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Funciones de impresión y exportación -->
    <script>
        function imprimirTablaCompleta() {
            const tablaOriginal = document.querySelector('.table-responsive table');
            const encabezado = tablaOriginal.querySelector('thead').outerHTML;
            const cuerpo = tablaOriginal.querySelector('tbody').outerHTML;

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
                <h2>Cirugías Registradas</h2>
                <table>
                    ${encabezado}
                    ${cuerpo}
                </table>
            </body>
            </html>
            `);
            ventana.document.close();
            ventana.focus();
            ventana.print();
            ventana.close();
        }

        async function exportarFiltradoPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'landscape' });

            const tablaDT = $('#miTabla').DataTable();
            const datosFiltrados = tablaDT.rows({ search: 'applied' }).data();

            const headers = Array.from(document.querySelector(' thead tr').children).map(th => th.innerText);

            const cleanText = html => {
                const temp = document.createElement('div');
                temp.innerHTML = html;
                return temp.textContent || temp.innerText || '';
            };

            const body = [];
            for (let i = 0; i < datosFiltrados.length; i++) {
                const fila = datosFiltrados[i];
                body.push(fila.map(cell => cleanText(cell)));
            }

            doc.text("Cirugías Filtradas", 14, 20);
            doc.autoTable({
                head: [headers],
                body: body,
                startY: 30,
                styles: { fontSize: 8 },
                headStyles: { fillColor: [248, 192, 69] }
            });

            doc.save('cirugias_filtradas.pdf');
        }

        $(document).ready(function () {
        let table = $('#miTabla').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron coincidencias",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
        }
        });

        $('#miTabla thead tr:eq(1) th').each(function (i) {
            $('input', this).on('keyup change', function () {
                if (table.column(i).search() !== this.value) {
                    table.column(i).search(this.value).draw();
                }
            });
        });
        });
    </script>
@endpush    

