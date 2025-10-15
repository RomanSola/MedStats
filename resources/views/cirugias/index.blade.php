@extends('layouts.app')
@section('title', 'Gestión de Cirugías')
@section('contenido')
    <div class="w-100" style="padding-left: 0; margin-left: 0;">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md px-2">
                    Gestor de Cirugías
                </h1>
                <a href="{{ route('cirugias.create') }}"
                class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                style="text-decoration: none;">
                    Ingresar Nueva Cirugía
                </a>
            </div>
        </div>
        <div class="card border-0 shadow-none rounded-0">
        <div class="card-body p-0">
            <p class="mb-3 text-secondary fw-semibold"> Administrá las cirugías registradas en el sistema. Podés ver detalles y editarlos.</p>
        <div class="bg-white shadow-sm rounded-0 overflow-auto">
            <div class="dataTables_wrapper">
                <div class="top-controls d-flex flex-wrap align-items-center gap-2 justify-content-between">
                            {{-- Selector de cantidad --}}
                            <div class="dataTables_length"></div>

                            {{-- Buscador --}}
                            <div class="dataTables_filter"></div>

                            {{-- Filtros de fecha integrados --}}
                            <div class="fechas d-flex align-items-center gap-2">
                                <div>
                                    <label for="fechaDesde" class="form-label mb-0">Desde:</label>
                                    <input type="date" id="fechaDesde" class="form-control form-control-sm">
                                </div>
                                <div>
                                    <label for="fechaHasta" class="form-label mb-0">Hasta:</label>
                                    <input type="date" id="fechaHasta" class="form-control form-control-sm">
                                </div>
                                <div>
                                    <button id="limpiarFechas" class="btn btn-outline-secondary btn-sm">Limpiar</button>
                                </div>
                            </div>
                        </div>
                        <table id="miTabla" class=" table table-hover table-bordered shadow-sm text-center rounded">
                            <div class="d-flex justify-content-start align-items-center gap-2 mb-3">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>N°Q</th>
                                        <th>Edad</th>
                                        <th>DNI</th>
                                        <th>Paciente</th>
                                        <th>Procedimiento</th>
                                        <th>Cirujano</th>
                                        <th class="no-print">Ayudante 1</th>
                                        <th class="no-print">Ayudante 2</th>
                                        <th>Anestesiologo</th>
                                        <th>Instrumentador</th>                            
                                        <th>Enfermero</th>
                                        <th>Tipo de Anestesia</th>                                  
                                        <th class="no-print">Urgencia</th>
                                        <th class="no-print">óbito</th>
                                        <th class="text-center no print">Acciones</th>
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
                                            <td data-fecha="{{ $cirugia->fecha_cirugia }}">
                                                {{ \Carbon\Carbon::parse($cirugia->fecha_cirugia)->format('d/m/Y') }}
                                            </td>
                                            <td>{{ $cirugia->hora_cirugia ?? '' }}</td>
                                            <td>{{ $cirugia->get_quirofano->nombre ?? '-' }}</td>
                                            <td>
                                                {{ optional($cirugia->get_paciente)->fecha_nacimiento
                                                    ? \Carbon\Carbon::parse($cirugia->get_paciente->fecha_nacimiento)->age
                                                    : '—' }}
                                            </td>
                                            <td>{{ $cirugia->get_paciente->dni }}</td>
                                            <td>{{ $cirugia->get_paciente->nombre }} {{ $cirugia->get_paciente->apellido }}</td>
                                            <td>{{ $cirugia->get_procedimiento->nombre_procedimiento }}</td>
                                            <td>{{ $cirugia->get_cirujano->nombre }} {{ $cirugia->get_cirujano->apellido }}</td>
                                            <td class="no-print">{{ $cirugia->get_ayudante1->nombre ?? '-' }} {{ $cirugia->get_ayudante1->apellido ?? '' }}</td>
                                            <td class="no-print">{{ optional($cirugia->get_ayudante2)->nombre ?? '-' }} {{ optional($cirugia->get_ayudante2)->apellido ?? '' }}</td>
                                            <td>{{ $cirugia->get_anestesista->nombre }} {{ $cirugia->get_anestesista->apellido }}</td>
                                            <td>{{ optional($cirugia->get_instrumentador)->nombre }} {{ optional($cirugia->get_instrumentador)->apellido }}</td>                                          
                                            <td>{{ optional($cirugia->get_enfermero)->nombre }} {{ optional($cirugia->get_enfermero)->apellido }}</td> 
                                            <td>{{ $cirugia->get_tipo_anestesia->nombre }}</td>
                                            <td class="no-print">
                                                {{ $cirugia->urgencia ? 'Si' : 'No' }}
                                            </td>
                                            <td class="no-print">
                                                {{ $cirugia->obito ? 'Si' : 'No' }}
                                            </td>
                                            <td class="text-center no-print">
                                                <a href="{{ route('cirugias.show', $cirugia) }}"
                                                    class="btn btn-outline-primary btn-sm me-1 btn-acciones">Ver</a>
                                                <br>
                                                <a href="{{ route('cirugias.edit', $cirugia) }}"
                                                    class="btn btn-outline-warning btn-sm me-1 btn-acciones">Editar</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12" class="text-center text-muted">No hay cirugías registradas
                                                aún.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                        </table>
                    </div>
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
    <style>
        .btn-acciones {
            min-width: 110px;
            /* ajusta hasta que quede igual al "Dar de alta" */
            text-align: center;
        }
    </style>

    @push('scripts')
        <!-- jsPDF y autoTable -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <!-- SheetJS para generar archivos Excel -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
        <!-- Funciones de impresión y exportación -->
        <script>
        $(document).ready(function() {
                // Inicializar la tabla
            const tabla = $('#miTabla').DataTable({
                    dom: '<"top-controls d-flex flex-wrap align-items-end gap-3"l<"#fechas-html">f>rt<"bottom-controls"ip>',
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                    }
                });
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            const fechaDesde = $('#fechaDesde').val();
            const fechaHasta = $('#fechaHasta').val();

            const rowNode = tabla.row(dataIndex).node();
            const fechaTexto = $(rowNode).find('td').eq(0).data('fecha'); // Columna 0 = Fecha

            if (!fechaTexto) return true;

            const fechaCirugia = new Date(fechaTexto); // data-fecha ya está en formato YYYY-MM-DD
            const desde = fechaDesde ? new Date(fechaDesde) : null;
            const hasta = fechaHasta ? new Date(fechaHasta) : null;

            return (!desde || fechaCirugia >= desde) && (!hasta || fechaCirugia <= hasta);
            });

            $('#fechaDesde, #fechaHasta').on('change', function() {
                tabla.draw();
            });

            $('#limpiarFechas').on('click', function() {
                $('#fechaDesde').val('');
                $('#fechaHasta').val('');
                tabla.draw();
            });
        });

            function imprimirTablaCompleta() {
                const tablaOriginal = document.querySelector('.overflow-auto table');
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
                const doc = new jsPDF({
                    orientation: 'landscape',
                    format: 'legal'
                });

                const tablaDT = $('#miTabla').DataTable();
                const datosFiltrados = tablaDT.rows({ search: 'applied' }).data();
                const thElements = document.querySelectorAll('thead tr th');
                const headers = [];
                const columnasIncluidas = [];
                let indexFecha = -1;
                let indexHora = -1;

                // Función para capitalizar solo la primera letra
                const capitalizarPrimeraLetra = texto => {
                    const limpio = texto.trim().toLowerCase();
                    return limpio.charAt(0).toUpperCase() + limpio.slice(1);
                };

                thElements.forEach((th, index) => {
                    const texto = th.innerText.trim().toLowerCase();

                    if (texto === 'fecha') indexFecha = index;
                    else if (texto === 'hora') indexHora = index;
                    else if (texto !== 'acciones' && texto !== 'urgencia') {
                        headers.push(capitalizarPrimeraLetra(th.innerText));
                        columnasIncluidas.push(index);
                    }
                });

                if (indexFecha !== -1 && indexHora !== -1) {
                    headers.unshift('Fecha y hora');
                }

                const cleanText = html => {
                    const temp = document.createElement('div');
                    temp.innerHTML = html;
                    const text = temp.textContent || temp.innerText || '';
                    return text.replace(/\n/g, ' ').replace(/\r/g, '').replace(/\s+/g, ' ').trim();
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
