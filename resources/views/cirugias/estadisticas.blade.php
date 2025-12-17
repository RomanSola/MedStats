@extends('layouts.app_estadisticas')
@section('contenido')
    <div class="container-fluid py-4">
        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 tracking-tight">
                    Estadísticas de Cirugías
                </h2>
                <p class="text-gray-500 mt-1">Resumen y métricas clave del quirófano</p>
            </div>
            <a href="{{ route('stocks.estadisticasstock') }}" 
               class="btn bg-white text-gray-700 shadow-sm hover:shadow-md border border-gray-200 d-flex align-items-center px-4 py-2 rounded-lg transition-all">
                <i class="bi bi-box-seam me-2 text-[#1B7D8F]"></i> 
                <span class="font-medium">Estadísticas de Stock</span>
            </a>
        </div>

        {{-- Filtros --}}
        <form method="GET" action="{{ route('cirugias.estadisticas') }}" 
              class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-5 transition-all hover:shadow-md">
            <div class="row g-4 align-items-end">
                <div class="col-md-3">
                    <label for="desde" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Desde
                    </label>
                    <input type="date" name="desde" id="desde" value="{{ request('desde') }}" 
                           class="form-control bg-gray-50 border-gray-200 rounded-lg focus:ring-[#1B7D8F] focus:border-[#1B7D8F] text-gray-700">
                </div>

                <div class="col-md-3">
                    <label for="hasta" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Hasta
                    </label>
                    <input type="date" name="hasta" id="hasta" value="{{ request('hasta') }}" 
                           class="form-control bg-gray-50 border-gray-200 rounded-lg focus:ring-[#1B7D8F] focus:border-[#1B7D8F] text-gray-700">
                </div>

                <div class="col-md-2">
                    <label for="especialidad_id" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Especialidad
                    </label>
                    <select name="especialidad_id" id="especialidad_id" 
                            class="form-select bg-gray-50 border-gray-200 rounded-lg focus:ring-[#1B7D8F] focus:border-[#1B7D8F] text-gray-700" 
                            onchange="this.form.submit()">
                        <option value="">Todas</option>
                        @foreach($especialidades as $esp)
                            <option value="{{ $esp->id }}" {{ $esp->id == request('especialidad_id') ? 'selected' : '' }}>
                                {{ $esp->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="cirujano_id" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Cirujano
                    </label>
                    <select name="cirujano_id" id="cirujano_id" 
                            class="form-select bg-gray-50 border-gray-200 rounded-lg focus:ring-[#1B7D8F] focus:border-[#1B7D8F] text-gray-700">
                        <option value="">Todos</option>
                        @foreach($cirujanosDisponibles as $cirujano)
                            <option value="{{ $cirujano->id }}" {{ $cirujano->id == request('cirujano_id') ? 'selected' : '' }}>
                                {{ $cirujano->apellido }}, {{ $cirujano->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
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

        @if (request('desde') && request('hasta'))
            <div class="bg-blue-50 border border-blue-100 rounded-lg p-3 mb-5 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center text-blue-800">
                    <i class="bi bi-calendar-check me-2"></i>
                    <span class="font-medium me-2">Filtro activo:</span>
                    <span>{{ \Carbon\Carbon::parse(request('desde'))->format('d/m/Y') }} - {{ \Carbon\Carbon::parse(request('hasta'))->format('d/m/Y') }}</span>
                </div>
                <a href="{{ route('cirugias.estadisticas') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium hover:underline">
                    Limpiar filtros
                </a>
            </div>
        @endif

        <div class="row g-4 mb-5">
            {{-- Columna izquierda: KPIs y Gráfico Mensual --}}
            <div class="col-lg-6" data-aos="fade-up" data-aos-duration="800">
                <div class="card border-0 shadow-sm rounded-xl h-100 overflow-hidden">
                    <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="font-bold text-gray-800 mb-1">Resumen General</h5>
                            <p class="text-sm text-gray-500 mb-0">Métricas de rendimiento anual</p>
                        </div>
                        <form method="GET" action="/estadisticas">
                            <select name="anio" id="anio"
                                class="form-select form-select-sm bg-gray-50 border-gray-200 text-gray-600 font-medium rounded-lg"
                                onchange="this.form.submit()">
                                @foreach ($aniosDisponibles as $anio)
                                    <option value="{{ $anio }}" {{ $anio == $anioSeleccionado ? 'selected' : '' }}>
                                        {{ $anio }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <div class="card-body px-4">
                        {{-- KPIs --}}
                        <div class="row g-3 mb-4">
                            <div class="col-4">
                                <div class="p-3 rounded-xl bg-blue-50 text-center h-100 border border-blue-100">
                                    <div class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">Total</div>
                                    <div class="text-2xl font-bold text-gray-800">{{ $total }}</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-3 rounded-xl bg-emerald-50 text-center h-100 border border-emerald-100">
                                    <div class="text-xs font-bold text-emerald-600 uppercase tracking-wider mb-1">Mensual</div>
                                    <div class="text-2xl font-bold text-gray-800">{{ $promedioMensual }}</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-3 rounded-xl bg-amber-50 text-center h-100 border border-amber-100">
                                    <div class="text-xs font-bold text-amber-600 uppercase tracking-wider mb-1">Semanal</div>
                                    <div class="text-2xl font-bold text-gray-800">{{ $promedioSemanal }}</div>
                                </div>
                            </div>
                        </div>

                        <div style="height: 250px;">
                            <canvas id="cirugiasPorMes"></canvas>
                        </div>
                        
                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-link text-decoration-none text-[#1B7D8F] font-medium text-sm" 
                                    data-bs-toggle="modal" data-bs-target="#modalCirugias">
                                Ver tabla detallada <i class="bi bi-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Columna derecha: Cirujanos --}}
            <div class="col-lg-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-xl h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="font-bold text-gray-800 mb-1">Top Cirujanos</h5>
                        <p class="text-sm text-gray-500 mb-0">Profesionales con mayor actividad</p>
                    </div>
                    <div class="card-body px-4">
                        <div class="row align-items-center h-100">
                            <div class="col-md-7">
                                <div class="d-flex flex-column gap-3">
                                    @foreach ($porCirujano->sortByDesc('total')->take(5) as $index => $item)
                                        <div class="d-flex align-items-center justify-content-between p-2 rounded-lg hover:bg-gray-50 transition-colors">
                                            <div class="d-flex align-items-center gap-3">
                                                <span class="d-flex align-items-center justify-content-center w-6 h-6 rounded-full bg-gray-100 text-xs font-bold text-gray-500">
                                                    {{ $index + 1 }}
                                                </span>
                                                <span class="text-sm font-medium text-gray-700">
                                                    {{ optional($item->get_cirujano)->apellido }}, {{ optional($item->get_cirujano)->nombre }}
                                                </span>
                                            </div>
                                            <span class="badge bg-blue-100 text-blue-700 rounded-pill px-3 py-1">
                                                {{ $item->total }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-link text-decoration-none text-[#1B7D8F] font-medium text-sm mt-3 ps-0"
                                        data-bs-toggle="modal" data-bs-target="#modalCirujanos">
                                    Ver listado completo <i class="bi bi-arrow-right ms-1"></i>
                                </button>
                            </div>
                            <div class="col-md-5 d-flex justify-content-center">
                                <div style="width: 200px; height: 200px;">
                                    <canvas id="graficoCirujanos"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            {{-- Enfermeros --}}
            <div class="col-md-6" data-aos="fade-up" data-aos-duration="800">
                <div class="card border-0 shadow-sm rounded-xl h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="font-bold text-gray-800 mb-1">Enfermería</h5>
                        <p class="text-sm text-gray-500 mb-0">Personal de asistencia destacado</p>
                    </div>
                    <div class="card-body px-4 d-flex align-items-center">
                        <div class="flex-grow-1">
                            <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                @foreach ($topEnfermeros->take(4) as $item)
                                    <li class="d-flex justify-content-between align-items-center text-sm text-gray-700 border-b border-gray-50 pb-2">
                                        <span>{{ optional($item->get_enfermero)->nombre }} {{ optional($item->get_enfermero)->apellido }}</span>
                                        <span class="font-bold text-gray-900">{{ $item->total }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn btn-link text-decoration-none text-[#1B7D8F] font-medium text-sm mt-2 ps-0" 
                                    data-bs-toggle="modal" data-bs-target="#modalEnfermeros">
                                Ver todos
                            </button>
                        </div>
                        <div class="ms-3">
                            <div style="width: 140px; height: 140px;">
                                <canvas id="graficoEnfermeros"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Instrumentadores --}}
            <div class="col-md-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-xl h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="font-bold text-gray-800 mb-1">Instrumentación</h5>
                        <p class="text-sm text-gray-500 mb-0">Personal técnico destacado</p>
                    </div>
                    <div class="card-body px-4 d-flex align-items-center">
                        <div class="flex-grow-1">
                            <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                @foreach ($topInstrumentadors->take(4) as $item)
                                    <li class="d-flex justify-content-between align-items-center text-sm text-gray-700 border-b border-gray-50 pb-2">
                                        <span>{{ optional($item->get_instrumentador)->nombre }} {{ optional($item->get_instrumentador)->apellido }}</span>
                                        <span class="font-bold text-gray-900">{{ $item->total }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn btn-link text-decoration-none text-[#1B7D8F] font-medium text-sm mt-2 ps-0"
                                    data-bs-toggle="modal" data-bs-target="#modalInstrumentadors">
                                Ver todos
                            </button>
                        </div>
                        <div class="ms-3">
                            <div style="width: 140px; height: 140px;">
                                <canvas id="graficoInstrumentadors"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Urgencias vs Programadas --}}
        <div class="card border-0 shadow-sm rounded-xl mb-5" data-aos="fade-up">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h5 class="font-bold text-gray-800 mb-1">Tipo de Intervención</h5>
                <p class="text-sm text-gray-500 mb-0">Comparativa Urgencias vs Programadas</p>
            </div>
            <div class="card-body px-4">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="d-flex flex-column gap-3">
                            <div class="p-3 rounded-xl bg-red-50 border border-red-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-red-700 font-medium">Urgencias</span>
                                    <span class="text-2xl font-bold text-red-700">{{ $urgentes }}</span>
                                </div>
                            </div>
                            <div class="p-3 rounded-xl bg-amber-50 border border-amber-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-amber-700 font-medium">Programadas</span>
                                    <span class="text-2xl font-bold text-amber-700">{{ $programadas }}</span>
                                </div>
                            </div>
                            <div class="text-center mt-2">
                                <span class="text-sm text-gray-500">Tasa de Urgencias</span>
                                <div class="text-3xl font-bold text-gray-800">
                                    @if ($urgentes + $programadas > 0)
                                        {{ round(($urgentes / ($urgentes + $programadas)) * 100, 1) }}%
                                    @else
                                        0%
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div style="height: 250px;">
                            @if ($urgentes + $programadas > 0)
                                <canvas id="graficoUrgenciasProgramadas"></canvas>
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 bg-gray-50 rounded-xl text-gray-400">
                                    Sin datos suficientes
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modales (Reutilizando estilos limpios) --}}
    
@push('modales')
    {{-- Modal Cirugías Mes --}}
    <div class="modal fade" id="modalCirugias" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-xl">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-bold text-gray-800">Detalle Mensual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                            <tr><th class="border-0 rounded-start">Mes</th><th class="border-0 text-end rounded-end">Total</th></tr>
                        </thead>
                        <tbody>
                            @foreach ($porMes as $item)
                                <tr>
                                    <td class="border-gray-100">{{ $item->mes_nombre }}</td>
                                    <td class="border-gray-100 text-end font-bold text-[#1B7D8F]">{{ $item->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Cirujanos --}}
    <div class="modal fade" id="modalCirujanos" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-xl">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-bold text-gray-800">Listado de Cirujanos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                                <tr>
                                    <th class="border-0 rounded-start py-3">Profesional</th>
                                    <th class="border-0 text-end rounded-end py-3">Intervenciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($porCirujano->sortByDesc('total') as $item)
                                    <tr>
                                        <td class="border-gray-100 py-3">
                                            <div class="font-medium text-gray-800">{{ optional($item->get_cirujano)->apellido }}</div>
                                            <div class="text-sm text-gray-500">{{ optional($item->get_cirujano)->nombre }}</div>
                                        </td>
                                        <td class="border-gray-100 text-end py-3">
                                            <span class="badge bg-blue-50 text-blue-700 rounded-pill px-3 py-2">{{ $item->total }}</span>
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

    {{-- Modal Enfermeros --}}
    <div class="modal fade" id="modalEnfermeros" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-xl">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-bold text-gray-800">Listado de Enfermería</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover align-middle">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                            <tr><th class="border-0 rounded-start py-3">Nombre</th><th class="border-0 text-end rounded-end py-3">Asistencias</th></tr>
                        </thead>
                        <tbody>
                            @foreach ($topEnfermeros as $item)
                                <tr>
                                    <td class="border-gray-100 py-3">{{ optional($item->get_enfermero)->apellido }}, {{ optional($item->get_enfermero)->nombre }}</td>
                                    <td class="border-gray-100 text-end py-3"><span class="badge bg-emerald-50 text-emerald-700 rounded-pill px-3 py-2">{{ $item->total }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Instrumentadores --}}
    <div class="modal fade" id="modalInstrumentadors" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-xl">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-bold text-gray-800">Listado de Instrumentadores</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover align-middle">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                            <tr><th class="border-0 rounded-start py-3">Nombre</th><th class="border-0 text-end rounded-end py-3">Asistencias</th></tr>
                        </thead>
                        <tbody>
                            @foreach ($topInstrumentadors as $item)
                                <tr>
                                    <td class="border-gray-100 py-3">{{ optional($item->get_instrumentador)->apellido }}, {{ optional($item->get_instrumentador)->nombre }}</td>
                                    <td class="border-gray-100 text-end py-3"><span class="badge bg-amber-50 text-amber-700 rounded-pill px-3 py-2">{{ $item->total }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Chart.defaults.font.family = "'Inter', sans-serif";
            Chart.defaults.color = '#64748b';
            
            const commonOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 20, boxWidth: 8 }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.95)',
                        titleColor: '#1e293b',
                        bodyColor: '#475569',
                        borderColor: '#e2e8f0',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: true,
                        boxPadding: 4
                    }
                }
            };

            // Cirugías por mes - Bar Chart Moderno
            new Chart(document.getElementById('cirugiasPorMes'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($porMesLabels) !!},
                    datasets: [{
                        label: 'Cirugías',
                        data: {!! json_encode($porMesValores) !!},
                        backgroundColor: '#1B7D8F',
                        borderRadius: 6,
                        barThickness: 24
                    }]
                },
                options: {
                    ...commonOptions,
                    plugins: { legend: { display: false } },
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

            // Donut Charts Config
            const donutColors = ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#06b6d4'];
            const donutOptions = {
                ...commonOptions,
                cutout: '75%',
                plugins: {
                    ...commonOptions.plugins,
                    legend: { display: false } // Ocultamos leyenda en donuts pequeños para limpieza
                }
            };

            // Cirujanos
            new Chart(document.getElementById('graficoCirujanos'), {
                type: 'doughnut',
                data: {
                    labels: @json($cirujanoLabels),
                    datasets: [{
                        data: @json($cirujanoValores),
                        backgroundColor: donutColors,
                        borderWidth: 0
                    }]
                },
                options: donutOptions
            });

            // Enfermeros
            new Chart(document.getElementById('graficoEnfermeros'), {
                type: 'doughnut',
                data: {
                    labels: @json($enfermeroLabels),
                    datasets: [{
                        data: @json($enfermeroValores),
                        backgroundColor: donutColors,
                        borderWidth: 0
                    }]
                },
                options: donutOptions
            });

            // Instrumentadores
            new Chart(document.getElementById('graficoInstrumentadors'), {
                type: 'doughnut',
                data: {
                    labels: @json($instrumentadorLabels),
                    datasets: [{
                        data: @json($instrumentadorValores),
                        backgroundColor: donutColors,
                        borderWidth: 0
                    }]
                },
                options: donutOptions
            });

            // Urgencias vs Programadas
            new Chart(document.getElementById('graficoUrgenciasProgramadas'), {
                type: 'doughnut', // Cambiado a bar horizontal para mejor comparación o mantener doughnut
                data: {
                    labels: ['Urgentes', 'Programadas'],
                    datasets: [{
                        data: [{{ $urgentes }}, {{ $programadas }}],
                        backgroundColor: ['#ef4444', '#f59e0b'],
                        borderWidth: 0
                    }]
                },
                options: {
                    ...commonOptions,
                    cutout: '60%'
                }
            });
        });
        AOS.init();
    </script>
@endpush
@endsection