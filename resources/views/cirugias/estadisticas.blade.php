@extends('layouts.app')
@section('contenido')
<div class="container">
    <div class="text-center mb-4">
        <h2 class="bg-light d-inline-block px-4 py-2 rounded shadow-sm">
        📊 Estadísticas de Cirugías
        </h2>
    </div>

    <div class="row mb-4">
    {{-- Columna izquierda: Actividad general --}}
    <div class="col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-primary text-white">Actividad general</div>
            <div class="card-body">
                <p>Total de cirugías: <strong>{{ $total }}</strong></p>
                <p>Promedio mensual: <strong>{{ $promedioMensual }}</strong></p>
                <p>Promedio semanal: <strong>{{ $promedioSemanal }}</strong></p>
            </div>
        </div>
    </div>

    {{-- Columna derecha: Gráfico mensual --}}
    <div class="col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-info text-white">Gráfico mensual</div>
            <div class="card-body">
                <div style="height: 300px;">
                    <canvas id="cirugiasPorMes"></canvas>
                </div>
            </div>
            </div>
        </div>
    </div>

    {{-- Cirugías por cirujano --}}
    <div class="card mb-4 shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <span><i class="bi bi-person-lines-fill me-2"></i> Cirugías por cirujano</span>
        <small class="text-light">Total: {{ $porCirujano->sum('total') }}</small>
    </div>

    <div class="card-body">
        <div class="row">
            {{-- Listado a la izquierda --}}
            <div class="col-md-7">
                <ul class="list-group list-group-flush">
                    @foreach ($porCirujano->sortByDesc('total')->take(5) as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ optional($item->get_cirujano)->apellido }}, {{ optional($item->get_cirujano)->nombre }}
                        <span class="badge bg-secondary rounded-pill">{{ $item->total }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Gráfico a la derecha --}}
            <div class="col-md-5 d-flex align-items-center justify-content-center">
                <div style="width: 180px; height: 180px;">
                    <canvas id="graficoCirujanos"></canvas>
                </div>
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
        </div>
        <div>
            <canvas id="graficoEnfermeros" style="width: 180px; height: 180px;"></canvas>
        </div>
    </div>
    </div>
    

    {{-- Distribución mensual --}}
    <div class="card mb-4">
        <div class="card-header">Distribución de cirugías por mes</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Mes</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($porMes as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::create()->month($item->mes)->translatedFormat('F') }}</td>
                            <td>{{ $item->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mb-4">
    {{-- Columna izquierda: Resumen numérico --}}
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-danger text-white">Resumen de urgencias vs programadas</div>
                <div class="card-body">
                    <p>Cirugías urgentes: <strong>{{ $urgentes }}</strong></p>
                    <p>Cirugías programadas: <strong>{{ $programadas }}</strong></p>
                    <p>Porcentaje urgencias: 
                    <strong>{{ round(($urgentes / ($urgentes + $programadas)) * 100, 2) }}%</strong>
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

@endpush

@endsection