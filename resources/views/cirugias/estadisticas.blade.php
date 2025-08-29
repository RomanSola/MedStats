@extends('layouts.app')
@section('contenido')
<div class="container">
    <div class="text-center mb-4">
    <div class="inline-flex items-center gap-4">
        <h2 class="bg-light d-inline-block px-4 py-2 rounded shadow-sm text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
        Estadísticas de Cirugías
        </h2>
        <a href="{{ route('stocks.estadisticasstock') }}" class="btn btn-outline-info shadow-sm">
        <i class="bi bi-box-seam me-1"></i> Estadísticas de Stock
        </a>
    </div>
    </div>

    <form method="GET" action="{{ route('cirugias.estadisticas') }}" class="bg-light p-3 rounded shadow-sm mb-4">
    <div class="row g-2 align-items-end">
    <div class="col-md-4">
      <label for="desde" class="form-label fw-semibold text-primary">Desde</label>
      <input type="date" name="desde" id="desde" class="form-control form-control-sm border-primary" value="{{ request('desde') }}">
    </div>

    <div class="col-md-4">
      <label for="hasta" class="form-label fw-semibold text-primary">Hasta</label>
      <input type="date" name="hasta" id="hasta" class="form-control form-control-sm border-primary" value="{{ request('hasta') }}">
    </div>

    <div class="col-md-4 d-flex align-items-end">
      <button type="submit" class="btn btn-sm btn-outline-primary w-100">
        <i class="bi bi-filter-circle me-1"></i> Aplicar filtro
      </button>
    </div>
    </div>
    </form>
    @if(request('desde') && request('hasta'))
        <div class="alert alert-info d-flex align-items-center justify-content-between shadow-sm mt-2">
        <div>
            <i class="bi bi-calendar-range me-2"></i>
            <span class="fw-semibold">Período activo:</span>
            <span class="text-dark">{{ \Carbon\Carbon::parse(request('desde'))->format('d/m/Y') }}</span>
            <span class="text-muted">→</span>
            <span class="text-dark">{{ \Carbon\Carbon::parse(request('hasta'))->format('d/m/Y') }}</span>
        </div>
            <small class="text-muted fst-italic">Los datos y gráficos reflejan este rango</small>
            <a href="{{ route('cirugias.estadisticas') }}" class="btn btn-sm btn-outline-light text-primary border-primary">
            <i class="bi bi-x-circle me-1"></i> Quitar filtro
            </a>
        </div>
    @endif

<div class="row mb-4">
    {{-- Columna izquierda: Estadísticas --}}
    <div class="col-md-6" data-aos="fade-up" data-aos-duration="800">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-bar-chart-line me-2"></i>
                    Estadísticas de Cirugías
                </h5>

                <form method="GET" action="/estadisticas" class="d-flex align-items-center">
                    <label for="anio" class="me-2 mb-0 fw-semibold">Año:</label>
                    <select name="anio" id="anio"
                class="form-select form-select-sm w-auto text-white bg-info border-0"
                onchange="this.form.submit()">
                @foreach($aniosDisponibles as $anio)
                <option value="{{ $anio }}" {{ $anio == $anioSeleccionado ? 'selected' : '' }}>
                    {{ $anio }}
                </option>
                @endforeach
                    </select>
                </form>
            </div>

            <div class="card-body bg-light">
                <div class="row text-center">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="text-muted small">Total de cirugías</div>
                        <div class="fs-4 fw-bold text-primary">{{ $total }}</div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="text-muted small">Promedio mensual</div>
                        <div class="fs-4 fw-bold text-success">{{ $promedioMensual }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted small">Promedio semanal</div>
                        <div class="fs-4 fw-bold text-warning">{{ $promedioSemanal }}</div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalCirugias">
                    Ver detalles ampliados
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Pop-Up para detalles ampliados --}}
    <div class="modal fade" id="modalCirugias" tabindex="-1" aria-labelledby="modalCirugiasLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header bg-info text-white">
            <h5 class="modal-title" id="modalCirugiasLabel">Detalle mensual de cirugías</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Mes</th>
                    <th>Total de cirugías</th>
                </tr>
            </thead>
            <tbody>
                @foreach($porMes as $item)
                <tr>
                    <td>{{ $item->mes_nombre }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        </div>
        </div>
    </div>

    {{-- Columna derecha: Gráfico mensual --}}
    <div class="col-md-6" data-aos="fade-up" data-aos-duration="800">
        <div class="card h-100 shadow-sm">
        <div class="card-header bg-info text-white">Gráfico mensual</div>
            <div class="card-body bg-light">
                <div style="height: 300px;">
                    <canvas id="cirugiasPorMes"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- Cirugías por cirujano --}}
    <div class="card mb-4 shadow-sm" data-aos="fade-up" data-aos-duration="800">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <span><i class="bi bi-person-lines-fill me-2"></i> Cirugías por cirujano</span>
        <small class="text-light">Total: {{ $porCirujano->sum('total') }}</small>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-7 d-flex flex-column justify-content-between">
            <div>
                <ul class="list-group list-group-flush">
                @foreach ($porCirujano->sortByDesc('total')->take(5) as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ optional($item->get_cirujano)->apellido }}, {{ optional($item->get_cirujano)->nombre }}
                    <span class="badge bg-secondary rounded-pill">{{ $item->total }}</span>
                    </li>
                @endforeach
                </ul>
            </div>

                <div class="mt-3">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCirujanos">
                        Ver todos los cirujanos
                    </button>
                </div>
            </div>

            <div class="col-md-5 d-flex align-items-center justify-content-center">
                <div style="width: 180px; height: 180px;">
                    <canvas id="graficoCirujanos"></canvas>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- Pop-Up para ver todos los cirujanos --}}
    <div class="modal fade" id="modalCirujanos" tabindex="-1" aria-labelledby="modalCirujanosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="modalCirujanosLabel">Listado completo de cirugías por cirujano</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
        <table class="table table-bordered table-hover">
          <thead class="table-light">
            <tr>
              <th>Apellido</th>
              <th>Nombre</th>
              <th>Total de cirugías</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($porCirujano->sortByDesc('total') as $item)
              <tr>
                <td>{{ optional($item->get_cirujano)->apellido }}</td>
                <td>{{ optional($item->get_cirujano)->nombre }}</td>
                <td>{{ $item->total }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        </div>
    </div>
    </div>
    </div>

    {{-- Top enfermeros --}}
    <div class="card h-100 shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">Top enfermeros/as</div>
    <div class="card-body d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div>
            <ul class="mb-3 mb-md-0">
                @foreach ($topEnfermeros as $item)
                    <li>{{ optional($item->get_enfermero)->nombre }} {{ optional($item->get_enfermero)->apellido }}: {{ $item->total }}</li>
                @endforeach
            </ul>
            <div class="mt-3">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEnfermeros">
            Ver todos los enfermeros/as
            </button>
            </div>
        </div>
        <div>
            <canvas id="graficoEnfermeros" style="width: 180px; height: 180px;"></canvas>
        </div>
    </div>
    </div>

    {{-- Pop-Up para ver todos los enfermeros --}}
    <div class="modal fade" id="modalEnfermeros" tabindex="-1" aria-labelledby="modalEnfermerosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="modalEnfermerosLabel">Listado completo de enfermeros/as</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Total de cirugías asistidas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topEnfermeros as $item)
                <tr>
                    <td>{{ optional($item->get_enfermero)->nombre }}</td>
                    <td>{{ optional($item->get_enfermero)->apellido }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    </div>
    </div>
    
    {{-- Urgencias vs Programadas --}}

    <div class="card-body">
    <div class="row mb-4">
    {{-- Columna izquierda: Resumen numérico --}}
        <div class="col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-danger text-white">Resumen de urgencias vs programadas</div>
            <div class="card-body">
                <p>Cirugías urgentes: <strong>{{ $urgentes }}</strong></p>
                <p>Cirugías programadas: <strong>{{ $programadas }}</strong></p>
                <p>Porcentaje urgencias:        
                    @if ($urgentes + $programadas > 0)
                        <p>Porcentaje urgencias:
                        <strong>{{ round(($urgentes / ($urgentes + $programadas)) * 100, 2) }}%</strong>
                        </p>
                    @else
                        <p>Porcentaje urgencias:
                        <strong>0%</strong>
                        </p>
                    @endif
                </p>
            </div>
        </div>
        </div>

        {{-- Columna derecha: Gráfico comparativo --}}
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-warning text-dark">Gráfico comparativo</div>
                <div class="card-body">
                    <div style="height: 300px;">
                        @if ($urgentes + $programadas > 0)
                            <div style="height: 300px;">
                                <canvas id="graficoUrgenciasProgramadas"></canvas>
                            </div>
                        @else
                            <div class="alert alert-info text-center">
                                No hay cirugías urgentes ni programadas para mostrar comparación.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

{{-- Scripts para gráficos --}}

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    //Cirugías por mes - Bar
    const ctxMes = document.getElementById('cirugiasPorMes');
    if (ctxMes) {
        new Chart(ctxMes.getContext('2d'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($porMesLabels) !!},
                datasets: [{
                    label: 'Cirugías por mes',
                    data: {!! json_encode($porMesValores) !!},
                    backgroundColor: '#3b82f6'
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } }
            }
        });
    }

    //Cirugías por cirujano - Doughnut
    const ctxCirujanos = document.getElementById('graficoCirujanos');
    if (ctxCirujanos) {
        new Chart(ctxCirujanos.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: @json($cirujanoLabels),
                datasets: [{
                    label: 'Cirugías por cirujano',
                    data: @json($cirujanoValores),
                    backgroundColor: [
                        '#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6',
                        '#ec4899', '#22d3ee', '#f43f5e', '#a3e635', '#6366f1'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }

    //Urgencias vs Programadas - Doughnut
    const ctxUrgencias = document.getElementById('graficoUrgenciasProgramadas');
    if (ctxUrgencias) {
        new Chart(ctxUrgencias.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Urgentes', 'Programadas'],
                datasets: [{
                    data: [{{ $urgentes }}, {{ $programadas }}],
                    backgroundColor: ['#dc3545', '#ffc107']
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }
});
    // Top enfermeros - Doughnut
    const ctxEnfermeros = document.getElementById('graficoEnfermeros');
    if (ctxEnfermeros) {
        new Chart(ctxEnfermeros.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: @json($enfermeroLabels),
                datasets: [{
                    label: 'Actividades por enfermero/a',
                    data: @json($enfermeroValores),
                    backgroundColor: [
                        '#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6',
                        '#ec4899', '#22d3ee', '#f43f5e', '#a3e635', '#6366f1'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }
</script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
@endpush
@endsection