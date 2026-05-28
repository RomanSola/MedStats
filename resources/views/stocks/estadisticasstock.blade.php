@extends('layouts.app_estadisticas')
@section('titulo', 'Estadísticas de Stock')
@section('contenido')
    <div class="container py-4">
        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 tracking-tight">
                    Estadísticas de Stock
                </h2>
                <p class="text-gray-500 mt-1">Control de inventario y consumo de insumos</p>
            </div>
            <a href="{{ route('cirugias.estadisticas') }}" 
               class="btn bg-white text-gray-700 shadow-sm hover:shadow-md border border-gray-200 d-flex align-items-center px-4 py-2 rounded-lg transition-all">
                <i class="bi bi-activity me-2 text-[#1B7D8F]"></i> 
                <span class="font-medium">Estadísticas de Cirugías</span>
            </a>
        </div>

        @if($vencimientos->isEmpty())
            <div class="alert alert-success bg-emerald-50 text-emerald-700 border-emerald-100 rounded-lg shadow-sm mb-4 d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2"></i>
                <div>Todo en orden: No hay insumos próximos a vencer en este período.</div>
            </div>
        @endif

        {{-- Filtros --}}
        <form method="GET" action="{{ route('stocks.estadisticasstock') }}" 
              class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-5 transition-all hover:shadow-md">
            <div class="row g-4 align-items-end">
                <div class="col-md-4">
                    <label for="desde" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Desde
                    </label>
                    <input type="date" name="desde" id="desde" value="{{ request('desde') }}" 
                           class="form-control bg-gray-50 border-gray-200 rounded-lg focus:ring-[#1B7D8F] focus:border-[#1B7D8F] text-gray-700">
                </div>
                <div class="col-md-4">
                    <label for="hasta" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Hasta
                    </label>
                    <input type="date" name="hasta" id="hasta" value="{{ request('hasta') }}" 
                           class="form-control bg-gray-50 border-gray-200 rounded-lg focus:ring-[#1B7D8F] focus:border-[#1B7D8F] text-gray-700">
                </div>
                <div class="col-md-4">
                    <button type="submit" 
                            class="btn w-100 rounded-lg d-flex align-items-center justify-content-center gap-2 text-white font-medium shadow-md hover:shadow-lg transition-all" 
                            style="background: linear-gradient(135deg, #1B7D8F 0%, #245360 100%);">
                        <i class="bi bi-funnel-fill"></i> Filtrar
                    </button>
                </div>
            </div>
        </form>

        @if ($errors->has('desde') || $errors->has('hasta'))
            <div class="alert alert-warning rounded-lg shadow-sm border-0 mb-4 d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-3 text-warning fs-4"></i>
                <div>
                    <strong class="d-block text-gray-800">Atención</strong>
                    <ul class="mb-0 ps-3 text-sm text-gray-600">
                        @foreach ($errors->get('desde') as $error) <li>{{ $error }}</li> @endforeach
                        @foreach ($errors->get('hasta') as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if(request('desde') && request('hasta'))
            <div class="bg-blue-50 border border-blue-100 rounded-lg p-3 mb-5 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center text-blue-800">
                    <i class="bi bi-calendar-check me-2"></i>
                    <span class="font-medium me-2">Filtro activo:</span>
                    <span>{{ \Carbon\Carbon::parse(request('desde'))->format('d/m/Y') }} - {{ \Carbon\Carbon::parse(request('hasta'))->format('d/m/Y') }}</span>
                </div>
                <a href="{{ route('stocks.estadisticasstock') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium hover:underline">
                    Limpiar filtros
                </a>
            </div>
        @endif

        {{-- KPIs --}}
        <div class="row g-4 mb-5">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                <div class="card border-0 shadow-sm rounded-xl h-100 bg-white overflow-hidden group hover:shadow-md transition-all">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Total en Stock</p>
                            <h3 class="text-3xl font-bold text-gray-800">{{ $totalStock }}</h3>
                        </div>
                        <div class="p-3 rounded-full bg-blue-50 text-blue-600">
                            <i class="bi bi-box-seam fs-3"></i>
                        </div>
                    </div>
                    <div class="bg-blue-50 px-4 py-2 border-t border-blue-100">
                        <small class="text-blue-700 font-medium">Unidades disponibles</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-xl h-100 bg-white overflow-hidden group hover:shadow-md transition-all">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Utilizados</p>
                            <h3 class="text-3xl font-bold text-gray-800">{{ $totalExtraidos }}</h3>
                        </div>
                        <div class="p-3 rounded-full bg-emerald-50 text-emerald-600">
                            <i class="bi bi-arrow-down-circle fs-3"></i>
                        </div>
                    </div>
                    <div class="bg-emerald-50 px-4 py-2 border-t border-emerald-100">
                        <small class="text-emerald-700 font-medium">Consumo del período</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-xl h-100 bg-white overflow-hidden group hover:shadow-md transition-all">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Ingresados</p>
                            <h3 class="text-3xl font-bold text-gray-800">{{ $totalAgregados }}</h3>
                        </div>
                        <div class="p-3 rounded-full bg-cyan-50 text-cyan-600">
                            <i class="bi bi-arrow-up-circle fs-3"></i>
                        </div>
                    </div>
                    <div class="bg-cyan-50 px-4 py-2 border-t border-cyan-100">
                        <small class="text-cyan-700 font-medium">Reposiciones del período</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Gráfico de insumos más utilizados --}}
        <div class="card border-0 shadow-sm rounded-xl mb-5" data-aos="fade-up">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h5 class="font-bold text-gray-800 mb-1">Insumos Más Utilizados</h5>
                <p class="text-sm text-gray-500 mb-0">Top de consumo en el período seleccionado</p>
            </div>
            <div class="card-body px-4">
                <div style="height: 300px;">
                    <canvas id="graficoInsumos"></canvas>
                </div>
            </div>
        </div>

        {{-- Tabla de vencimientos próximos --}}
        <div class="card border-0 shadow-sm rounded-xl mb-5" data-aos="fade-up">
            <div class="card-header bg-white border-0 pt-4 px-4 d-flex align-items-center gap-2">
                <div class="p-2 rounded-lg bg-amber-50 text-amber-600">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div>
                    <h5 class="font-bold text-gray-800 mb-1">Próximos Vencimientos</h5>
                    <p class="text-sm text-gray-500 mb-0">Insumos que requieren atención inmediata</p>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase font-bold">
                            <tr>
                                <th class="px-4 py-3 border-0">Medicamento</th>
                                <th class="px-4 py-3 border-0">Lote</th>
                                <th class="px-4 py-3 border-0">Vencimiento</th>
                                <th class="px-4 py-3 border-0 text-end">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($vencimientos as $item)
                                <tr>
                                    <td class="px-4 py-3 font-medium text-gray-800">{{ optional($item->get_medicamento)->nombre }}</td>
                                    <td class="px-4 py-3 text-gray-600 font-mono text-sm">{{ $item->lote }}</td>
                                    <td class="px-4 py-3 text-amber-600 font-medium">
                                        {{ \Carbon\Carbon::parse($item->fecha_vencimiento)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-4 py-3 text-end font-bold text-gray-800">{{ $item->cantidad_act }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row g-4">
            {{-- Insumos sin movimiento --}}
            <div class="col-lg-6" data-aos="fade-up">
                <div class="card border-0 shadow-sm rounded-xl h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <h5 class="font-bold text-gray-800 mb-1">Sin Movimiento</h5>
                            <p class="text-sm text-gray-500 mb-0">Stock inactivo por más de {{ $umbralDias }} días</p>
                        </div>
                        <form method="GET" action="{{ route('stocks.estadisticasstock') }}" class="d-flex gap-2 align-items-center">
                            <input type="number" name="dias" id="dias" 
                                   class="form-control form-control-sm w-20 border-gray-200 rounded-lg text-center" 
                                   value="{{ request('dias', 30) }}" min="1">
                            <button type="submit" class="btn btn-sm btn-light border border-gray-200 text-gray-600 hover:bg-gray-50 rounded-lg">
                                Aplicar
                            </button>
                        </form>
                    </div>
                    <div class="card-body p-0">
                        @if($stocksSinMovimiento->isEmpty())
                            <div class="p-5 text-center text-gray-500">
                                <i class="bi bi-check-circle fs-1 text-emerald-500 mb-3 d-block"></i>
                                Excelente rotación. Todos los insumos han tenido movimiento reciente.
                            </div>
                        @else
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase font-bold">
                                        <tr>
                                            <th class="px-4 py-3 border-0">Insumo</th>
                                            <th class="px-4 py-3 border-0">Lote</th>
                                            <th class="px-4 py-3 border-0 text-end">Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($stocksSinMovimiento as $item)
                                            <tr>
                                                <td class="px-4 py-3 text-sm text-gray-800">{{ optional($item->get_medicamento)->nombre }}</td>
                                                <td class="px-4 py-3 text-xs text-gray-500 font-mono">{{ $item->lote }}</td>
                                                <td class="px-4 py-3 text-end font-medium text-gray-700">{{ $item->cantidad_act }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Proyección de agotamiento --}}
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-xl h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="font-bold text-gray-800 mb-1">Proyección de Agotamiento</h5>
                        <p class="text-sm text-gray-500 mb-0">Estimación basada en consumo de últimos 30 días</p>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="table-responsive">
                        <table id="tablaProyeccion" class="table table-hover align-middle w-100">
                            <thead class="bg-gray-50 text-xs text-gray-500 uppercase font-bold">
                                <tr>
                                    <th class="border-0 rounded-start">Medicamento</th>
                                    <th class="border-0">Stock</th>
                                    <th class="border-0">Consumo/Día</th>
                                    <th class="border-0 rounded-end">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @foreach($proyecciones as $item)
                                    <tr>
                                        <td class="font-medium text-gray-800">{{ $item['medicamento'] }} <span class="text-xs text-gray-400 block">{{ $item['lote'] }}</span></td>
                                        <td class="text-gray-600">{{ $item['cantidad_act'] }}</td>
                                        <td class="text-gray-600">{{ $item['consumo_diario'] }}</td>
                                        <td>
                                            @if(!is_null($item['dias_restantes']) && $item['dias_restantes'] < 10)
                                                <span class="badge bg-red-100 text-red-700 border border-red-200 rounded-pill px-2 py-1">Crítico: {{ $item['dias_restantes'] }} días</span>
                                            @elseif(!is_null($item['dias_restantes']) && $item['dias_restantes'] < 20)
                                                <span class="badge bg-amber-100 text-amber-700 border border-amber-200 rounded-pill px-2 py-1">Bajo: {{ $item['dias_restantes'] }} días</span>
                                            @elseif(!is_null($item['dias_restantes']))
                                                <span class="badge bg-emerald-100 text-emerald-700 border border-emerald-200 rounded-pill px-2 py-1">Normal: {{ $item['dias_restantes'] }} días</span>
                                            @else
                                                <span class="badge bg-gray-100 text-gray-500 border border-gray-200 rounded-pill px-2 py-1">Sin consumo</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.color = '#64748b';

        const ctx = document.getElementById('graficoInsumos').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($insumoLabels) !!},
                datasets: [{
                    label: 'Cantidad extraída',
                    data: {!! json_encode($insumoValores) !!},
                    backgroundColor: '#1B7D8F',
                    borderRadius: 6,
                    barThickness: 30,
                    hoverBackgroundColor: '#245360'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.95)',
                        titleColor: '#1e293b',
                        bodyColor: '#475569',
                        borderColor: '#e2e8f0',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f1f5f9', drawBorder: false },
                        ticks: { padding: 10 }
                    },
                    x: {
                        grid: { display: false, drawBorder: false }
                    }
                }
            }
        });
    });

    $(document).ready(function () {
        $('#tablaProyeccion').DataTable({
            dom: '<"d-flex justify-content-between align-items-center mb-3"Bf>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="bi bi-file-earmark-excel me-1"></i> Excel',
                    className: 'btn btn-sm btn-outline-success border-success text-success hover:bg-success hover:text-white transition-all'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="bi bi-file-earmark-pdf me-1"></i> PDF',
                    className: 'btn btn-sm btn-outline-danger border-danger text-danger hover:bg-danger hover:text-white transition-all',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    customize: function (doc) {
                        doc.defaultStyle.fontSize = 8;
                    }
                }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                search: "",
                searchPlaceholder: "Buscar...",
                lengthMenu: "_MENU_",
                info: "<span class='text-gray-500 text-sm'>_START_ - _END_ de _TOTAL_</span>",
                infoEmpty: "<span class='text-gray-500 text-sm'>0 registros</span>",
                infoFiltered: "",
                paginate: {
                    first: '<i class="bi bi-chevron-double-left"></i>',
                    last: '<i class="bi bi-chevron-double-right"></i>',
                    next: '<i class="bi bi-chevron-right"></i>',
                    previous: '<i class="bi bi-chevron-left"></i>'
                }
            },
            order: [[3, 'asc']], // Orden por estado (columna 3 ahora)
            pageLength: 5,
            drawCallback: function() {
                $('.dataTables_paginate .paginate_button').addClass('px-3 py-1 border rounded-md mx-1 text-sm hover:bg-gray-50 transition-colors');
                $('.dataTables_paginate .paginate_button.current').addClass('bg-blue-50 text-blue-600 border-blue-100 font-bold');
                $('div.dataTables_wrapper div.dataTables_filter input').addClass('form-control form-control-sm border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 ps-3');
            }
        });
    });
    AOS.init();
</script>
<style>
    /* Custom DataTables Styling overrides */
    div.dt-buttons .btn {
        margin-right: 0.5rem;
        border-radius: 0.5rem;
    }
    .dataTables_wrapper .dataTables_filter {
        float: none;
        text-align: right;
    }
</style>
@endpush