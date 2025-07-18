@extends('layouts.app')
@section('contenido')
<div class="container">
    <h2 class="mb-4 text-center">📊 Estadísticas de Cirugías</h2>

    {{-- Actividad general --}}
    <div class="card mb-4">
    <div class="card-header">Actividad general</div>
    <div class="card-body">
        <p>Total de cirugías: <strong>{{ $total }}</strong></p>
        <p>Promedio mensual: <strong>{{ $promedioMensual }}</strong></p>
        <p>Promedio semanal: <strong>{{ $promedioSemanal }}</strong></p>
    </div>
    </div>

    {{-- Gráfico mensual --}}
    <div class="card mb-4">
        <div class="card-header">Gráfico mensual</div>
        <div class="card-body" style="width: 300px; height: 300px; margin: auto;">
            <canvas id="cirugiasPorMes" height="200px;"></canvas>
        </div>
    </div>

    {{-- Cirugías por cirujano --}}
    <div class="card mb-4">
        <div class="card-header">Cirugías por cirujano</div>
        <div class="card-body">
            <ul>
                @foreach ($porCirujano as $item)
                    <li>{{ optional($item->get_cirujano)->nombre }} {{ optional($item->get_cirujano)->apellido }}: {{ $item->total }}</li>
                @endforeach
            </ul>
            <div style="width: 300px; height: 300px; margin: auto;">
                <canvas id="graficoCirujanos"></canvas>
            </div>
        </div>
    </div>

    {{-- Top enfermeros --}}
    <div class="card mb-4">
        <div class="card-header">Top enfermeros/as</div>
        <div class="card-body">
            <ul>
                @foreach ($porEnfermero as $item)
                    <li>{{ optional($item->enfermero)->nombre }} {{ optional($item->enfermero)->apellido }}: {{ $item->total }}</li>
                @endforeach
            </ul>
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

    {{-- Urgencias vs programadas --}}
    <div class="card mb-4">
        <div class="card-header">Urgencias vs Programadas</div>
        <div class="card-body">
            <p>Urgentes: {{ $urgentes }} | Programadas: {{ $programadas }}</p>
        </div>
    </div>

    {{-- Tipos de anestesia --}}
    <div class="card mb-4">
        <div class="card-header">Tipos de anestesia utilizadas</div>
        <div class="card-body">
            <ul>
                @foreach ($porAnestesia as $item)
                    <li>{{ optional($item->tipo_anestesia)->nombre }}: {{ $item->total }}</li>
                @endforeach
            </ul>
        </div>
    </div>

</div>
<canvas id="cirugiasPorMes" height="100"></canvas>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('cirugiasPorMes').getContext('2d');
    const chart = new Chart(ctx, {
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
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>
<script>
    const ctxCirujanos = document.getElementById('graficoCirujanos').getContext('2d');
    const chartCirujanos = new Chart(ctxCirujanos, {
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
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endpush
@endsection