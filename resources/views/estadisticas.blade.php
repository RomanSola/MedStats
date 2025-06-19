@extends('layouts.app')

@section('title', 'Estadísticas de Procedimientos')

@section('contenido')

<div class="container mt-4">
    <h2 class="mb-4">Estadísticas de Procedimientos</h2>

    <!-- Formulario de filtrado (no funcional aún) -->
    <form class="card border-info p-3 mb-4">
        <div class="row">
            <div class="col-md-5">
                <label for="desde" class="form-label">Desde</label>
                <input type="date" name="desde" id="desde" class="form-control" disabled>
            </div>
            <div class="col-md-5">
                <label for="hasta" class="form-label">Hasta</label>
                <input type="date" name="hasta" id="hasta" class="form-control" disabled>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-info w-100" disabled>Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Área de gráfico (estática) -->
    <div class="card border-info mb-4">
        <div class="card-body">
            <canvas id="graficoProcedimientos"></canvas>
            <p class="text-muted mt-2">Aquí se visualizará un gráfico de barras con los procedimientos.</p>
        </div>
    </div>

    <!-- Tabla ejemplo (estática) -->
    <div class="card border-info">
        <div class="card-body">
            <h5 class="card-title">Resumen de Procedimientos</h5>
            <table class="table table-bordered table-striped">
                <thead class="table-info">
                    <tr>
                        <th>Procedimiento</th>
                        <th>Cantidad realizada</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ejemplo A</td>
                        <td>12</td>
                    </tr>
                    <tr>
                        <td>Ejemplo B</td>
                        <td>7</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Simulación visual sin datos reales -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficoProcedimientos').getContext('2d');
    const grafico = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Ejemplo A', 'Ejemplo B'],
            datasets: [{
                label: 'Cantidad Realizada',
                data: [12, 7],
                backgroundColor: 'rgba(13, 202, 240, 0.6)',
                borderColor: 'rgba(13, 202, 240, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endpush
