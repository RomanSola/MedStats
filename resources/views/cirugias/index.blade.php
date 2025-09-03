@extends('layouts.app')

@section('title', 'Gestión de Cirugías')

@section('contenido')
    <div class="container mt-4">


        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="flex justify-between items-center mb-6">
                <h1
                    class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2 px-2">
                    Gestor de Cirugías</h1>
                <a href="{{ route('cirugias.create') }}"
                    class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                    style="text-decoration: none;">
                    Ingresar Nueva Cirugía
                </a>
            </div>
            

            <div class="card border">
                <div class="card-body">
                    <p class="mb-3 text-secondary fw-semibold">Administrá las cirugías registradas en el sistema. Podés ver detalles y editarlos.
                    </p>
                    <br>
                    <div class="bg-white shadow rounded-lg border border-gray-200 overflow-auto">
                        <table class=" table table-hover table-bordered shadow-sm text-center rounded">
                            <thead>
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
                                        .no-print {
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
                                            <br>
                                            <a href="{{ route('cirugias.edit', $cirugia) }}"
                                                class="btn btn-outline-warning btn-sm me-1">Editar</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center text-muted">No hay cirugías registradas aún.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- Botón de impresión -->
            <br>
            <div class="mb-3">
                <button onclick="imprimirTablaCompleta()" class="btn btn-outline-primary btn-sm">
                    🖨️ Imprimir toda la tabla
                </button>
                <button onclick="exportarFiltradoPDF()" class="btn btn-outline-danger btn-sm">
                    📄 Exportar PDF filtrado
                </button>
                <button id="btnExportarExcel" class="btn btn-outline-success btn-sm">
                    <i class="bi bi-file-earmark-excel"></i> 📄 Exportar a Excel
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
            <!-- Botones de DataTables -->
            <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
            <!-- SheetJS para generar archivos Excel -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

            <!-- Funciones de impresión y exportación -->
            <script>
                $(document).ready(function() {
                    $('#miTabla').DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'excelHtml5',
                                text: 'Exportar a Excel',
                                className: 'btn btn-success btn-sm'
                            },
                            {
                                extend: 'pdfHtml5',
                                text: 'Exportar a PDF',
                                className: 'btn btn-danger btn-sm',
                                orientation: 'landscape',
                                pageSize: 'A4',
                                customize: function(doc) {
                                    doc.defaultStyle.fontSize = 8;
                                }
                            }
                        ],
                        language: {
                            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                        }
                    });
                });

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
                    const {
                        jsPDF
                    } = window.jspdf;
                    const doc = new jsPDF({
                        orientation: 'landscape',
                        format: 'legal'
                    });

                    const tablaDT = $('#miTabla').DataTable();
                    const datosFiltrados = tablaDT.rows({
                        search: 'applied'
                    }).data();
                    const thElements = document.querySelectorAll('thead tr th');
                    const headers = [];
                    const columnasIncluidas = [];
                    let indexFecha = -1;
                    let indexHora = -1;

                    thElements.forEach((th, index) => {
                        const texto = th.innerText.trim().toLowerCase();

                        if (texto === 'fecha') indexFecha = index;
                        else if (texto === 'hora') indexHora = index;
                        else if (texto !== 'acciones' && texto !== 'urgencia') {
                            headers.push(th.innerText.trim());
                            columnasIncluidas.push(index);
                        }
                    });

                    if (indexFecha !== -1 && indexHora !== -1) {
                        headers.unshift('Fecha y Hora');
                    }

                    const cleanText = html => {
                        const temp = document.createElement('div');
                        temp.innerHTML = html;
                        return temp.textContent || temp.innerText || '';
                    };

                    const body = [];
                    for (let i = 0; i < datosFiltrados.length; i++) {
                        const fila = datosFiltrados[i];
                        const filaFiltrada = [];

                        // Combinar Fecha y Hora
                        if (indexFecha !== -1 && indexHora !== -1) {
                            const fecha = cleanText(fila[indexFecha]);
                            const hora = cleanText(fila[indexHora]);
                            filaFiltrada.push(`${fecha} ${hora}`);
                        }

                        // Agregar columnas restantes
                        columnasIncluidas.forEach(index => {
                            filaFiltrada.push(cleanText(fila[index]));
                        });

                        body.push(filaFiltrada);
                    }

                    doc.text("Cirugías Filtradas", 14, 20);
                    doc.autoTable({
                        head: [headers],
                        body: body,
                        startY: 30,
                        styles: {
                            fontSize: 8
                        },
                        headStyles: {
                            fillColor: [248, 192, 69]
                        }
                    });

                    doc.save('cirugias_filtradas.pdf');
                }

                document.getElementById('btnExportarExcel').addEventListener('click', function() {
                    const tablaDT = $('#miTabla').DataTable();
                    const datosFiltrados = tablaDT.rows({
                        search: 'applied'
                    }).data().toArray();

                    const thElements = document.querySelectorAll('#miTabla thead tr th');
                    const columnasExcluidas = ['acciones', 'urgencia'];
                    const headers = [];
                    const columnasIncluidas = [];
                    let indexFecha = -1;
                    let indexHora = -1;

                    // Detectar columnas y construir encabezados
                    thElements.forEach((th, index) => {
                        const texto = th.innerText.trim().toLowerCase();
                        if (texto === 'fecha') indexFecha = index;
                        else if (texto === 'hora') indexHora = index;
                        else if (!columnasExcluidas.includes(texto)) {
                            headers.push(th.innerText.trim());
                            columnasIncluidas.push(index);
                        }
                    });

                    if (indexFecha !== -1 && indexHora !== -1) {
                        headers.unshift('Fecha y Hora');
                    }

                    // Función para limpiar HTML embebido
                    const cleanText = html => {
                        const temp = document.createElement('div');
                        temp.innerHTML = html;
                        return temp.innerText.replace(/\s+/g, ' ').trim();
                    };

                    // Construir cuerpo de datos
                    const filas = datosFiltrados.map(fila => {
                        const filaFiltrada = [];
                        if (indexFecha !== -1 && indexHora !== -1) {
                            const fecha = cleanText(fila[indexFecha]);
                            const hora = cleanText(fila[indexHora]);
                            filaFiltrada.push(`${fecha} ${hora}`);
                        }
                        columnasIncluidas.forEach(index => {
                            filaFiltrada.push(cleanText(fila[index]));
                        });
                        return filaFiltrada;
                    });
                    // Generar archivo Excel con SheetJS
                    const hoja = [headers, ...filas];
                    const wb = XLSX.utils.book_new();
                    const ws = XLSX.utils.aoa_to_sheet(hoja);
                    XLSX.utils.book_append_sheet(wb, ws, 'Cirugías');
                    XLSX.writeFile(wb, 'cirugias_filtradas.xlsx');
                });
            </script>
        @endpush
