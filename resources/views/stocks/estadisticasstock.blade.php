@extends('layouts.app')
@section('titulo', 'Estadísticas de Stock')
@section('contenido')

<div class="container">
    <div class="text-center mb-4">
    <div class="inline-flex items-center gap-4">
        <h2 class="bg-light d-inline-block px-4 py-2 rounded shadow-sm text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md flex items-center gap-2 px-2">
        Estadísticas de Insumos
        </h2>
        <a href="{{ route('cirugias.estadisticas') }}" class="btn btn-outline-info shadow-sm">
        <i class="bi bi-box-seam me-1"></i> Estadísticas de Cirugías
        </a>
    </div>
    </div>
    @if($vencimientos->isEmpty())
    <div class="alert alert-warning text-center">No hay insumos próximos a vencer en este período.</div>
    @endif

  {{-- Filtro por período --}}
  <form method="GET" action="{{ route('stocks.estadisticasstock') }}" class="bg-light p-3 rounded shadow-sm mb-4">
    <div class="row g-2 align-items-end">
      <div class="col-md-4">
        <label for="desde" class="form-label fw-semibold text-primary">Desde</label>
        <input type="date" name="desde" id="desde" class="form-control form-control-sm" value="{{ request('desde') }}">
      </div>
      <div class="col-md-4">
        <label for="hasta" class="form-label fw-semibold text-primary">Hasta</label>
        <input type="date" name="hasta" id="hasta" class="form-control form-control-sm" value="{{ request('hasta') }}">
      </div>
      <div class="col-md-4 d-flex align-items-end">
        <button type="submit" class="btn btn-sm btn-outline-primary w-100">
          <i class="bi bi-filter-circle me-1"></i> Aplicar filtro
        </button>
      </div>
    </div>
  </form>

  {{-- Período activo --}}
  @if(request('desde') && request('hasta'))
    <div class="alert alert-info d-flex flex-column flex-md-row align-items-md-center justify-content-between shadow-sm mt-2">
      <div>
        <i class="bi bi-calendar-range me-2"></i>
        <span class="fw-semibold">Período activo:</span>
        <span class="text-dark">{{ \Carbon\Carbon::parse(request('desde'))->format('d/m/Y') }}</span>
        <span class="text-muted">→</span>
        <span class="text-dark">{{ \Carbon\Carbon::parse(request('hasta'))->format('d/m/Y') }}</span>
      </div>
      <a href="{{ route('stocks.estadisticas') }}" class="btn btn-sm btn-outline-light text-primary border-primary">
        <i class="bi bi-x-circle me-1"></i> Quitar filtro
      </a>
    </div>
  @endif

  {{-- Resumen general --}}
  <div class="row mt-4">
    <div class="col-md-4">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <div class="text-muted small">Total de insumos en stock</div>
          <div class="fs-4 fw-bold text-primary">{{ $totalStock }}</div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <div class="text-muted small">Insumos utilizados</div>
          <div class="fs-4 fw-bold text-success">{{ $totalExtraidos }}</div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <div class="text-muted small">Insumos agregados</div>
          <div class="fs-4 fw-bold text-info">{{ $totalAgregados }}</div>
        </div>
      </div>
    </div>
  </div>

  {{-- Gráfico de insumos más utilizados --}}
  <div class="card mt-4 shadow-sm">
    <div class="card-header bg-primary text-white">
      <i class="bi bi-bar-chart me-2"></i> Insumos más utilizados
    </div>
    <div class="card-body text-center p-2">
      <canvas id="graficoInsumos" class="h-36 w-full"></canvas>
    </div>
  </div>

  {{-- Tabla de vencimientos próximos --}}
  <div class="card mt-4 shadow-sm">
    <div class="card-header bg-info text-white">
      <i class="bi bi-exclamation-triangle me-2"></i> Insumos próximos a vencer
    </div>
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead class="bg-info text-white text-center align-middle">
            <tr>
                <th class="py-2"><i class="bi bi-capsule me-1"></i> Medicamento</th>
                <th class="py-2"><i class="bi bi-hash me-1"></i> Lote</th>
                <th class="py-2"><i class="bi bi-calendar-event me-1"></i> Vencimiento</th>
                <th class="py-2"><i class="bi bi-box me-1"></i> Cantidad</th>
            </tr>
        </thead>
        <tbody>
          @foreach($vencimientos as $item)
            <tr>
              <td>{{ optional($item->get_medicamento)->nombre }}</td>
              <td>{{ $item->lote }}</td>
              <td>{{ \Carbon\Carbon::parse($item->fecha_vencimiento)->format('d/m/Y') }}</td>
              <td>{{ $item->cantidad_act }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

<div class="card mt-4 shadow-sm">
  <div class="card-header bg-secondary text-white d-flex justify-between align-items-center">
    <div>
      <i class="bi bi-clock-history me-2"></i> Insumos sin movimiento
      <span class="badge bg-light text-dark">{{ $umbralDias }} días</span>
    </div>
    <form method="GET" action="{{ route('stocks.estadisticasstock') }}" class="d-flex gap-2">
      <input type="number" name="dias" id="dias" class="form-control form-control-sm" value="{{ request('dias', 30) }}" min="1" style="width: 80px;">
      <button type="submit" class="btn btn-sm btn-light">Aplicar</button>
    </form>
  </div>

  <div class="card-body">
    @if($stocksSinMovimiento->isEmpty())
      <div class="alert alert-success text-center">Todos los insumos han tenido movimiento reciente.</div>
    @else
      <table class="table table-bordered table-hover">
        <thead class="bg-dark text-white text-center">
          <tr>
            <th>Medicamento</th>
            <th>Lote</th>
            <th>Fecha de vencimiento</th>
            <th>Cantidad actual</th>
          </tr>
        </thead>
        <tbody>
          @foreach($stocksSinMovimiento as $item)
            <tr>
              <td>{{ optional($item->get_medicamento)->nombre }}</td>
              <td>{{ $item->lote }}</td>
              <td>{{ $item->fecha_vencimiento ? \Carbon\Carbon::parse($item->fecha_vencimiento)->format('d/m/Y') : '—' }}</td>
              <td>{{ $item->cantidad_act }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
</div>

<div class="card mt-4 shadow-sm">
  <div class="card-header bg-warning text-dark">
    <i class="bi bi-hourglass-split me-2"></i> Proyección de agotamiento (basado en últimos 30 días)
  </div>
  <div class="card-body">
    <table class="table table-bordered table-hover">
      <thead class="bg-warning text-dark text-center">
        <tr>
          <th>Medicamento</th>
          <th>Lote</th>
          <th>Stock actual</th>
          <th>Consumo diario</th>
          <th>Días restantes</th>
        </tr>
      </thead>
      <tbody>
        @foreach($proyecciones as $item)
          <tr>
            <td>{{ $item['medicamento'] }}</td>
            <td>{{ $item['lote'] }}</td>
            <td>{{ $item['cantidad_act'] }}</td>
            <td>{{ $item['consumo_diario'] }}</td>
            <td>
                @if($item['dias_restantes'] && $item['dias_restantes'] < 10)
                    <span class="badge bg-danger text-white">{{ $item['dias_restantes'] }} días</span>
                @elseif($item['dias_restantes'] && $item['dias_restantes'] < 20)
                    <span class="badge bg-warning text-white">{{ $item['dias_restantes'] }} días</span>
                @elseif($item['dias_restantes'])
                    <span class="badge bg-success text-white">{{ $item['dias_restantes'] }} días</span>
                @else
                <span class="text-muted">Sin consumo</span>
                @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const canvas = document.getElementById('graficoInsumos');
    canvas.height = 250;
    const ctx = document.getElementById('graficoInsumos').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($insumoLabels) !!},
            datasets: [{
            label: 'Cantidad extraída',
            data: {!! json_encode($insumoValores) !!},
            backgroundColor: 'rgba(13, 110, 253, 0.5)',
            borderColor: 'rgba(13, 110, 253, 1)',
            borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {y: { beginAtZero: true }}
        }
    });
</script>
@endpush

