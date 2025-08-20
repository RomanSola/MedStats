@extends('layouts.app')

@section('contenido')
<div class="container py-4">

    {{-- Título institucional rojo --}}
    <h2 class="text-danger fw-bold border-bottom border-danger pb-2 mb-4 text-center">
        Estadísticas de Cirugías
    </h2>

    {{-- Actividad general --}}
    <div class="card border-danger mb-4">
        <div class="card-header bg-light fw-semibold">Actividad general</div>
        <div class="card-body text-dark">
            <p>Total de cirugías: <strong>{{ $total }}</strong></p>
            <p>Promedio mensual: <strong>{{ $promedioMensual }}</strong></p>
            <p>Promedio semanal: <strong>{{ $promedioSemanal }}</strong></p>
        </div>
    </div>

    {{-- Cirugías por cirujano --}}
    <div class="card border-danger mb-4">
        <div class="card-header bg-light fw-semibold">Cirugías por cirujano</div>
        <div class="card-body text-dark">
            <ul class="list-disc ps-3">
                @foreach ($porCirujano as $item)
                    <li>{{ optional($item->get_cirujano)->nombre }} {{ optional($item->get_cirujano)->apellido }}: {{ $item->total }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Top enfermeros --}}
    <div class="card border-danger mb-4">
        <div class="card-header bg-light fw-semibold">Top enfermeros/as</div>
        <div class="card-body text-dark">
            <ul class="list-disc ps-3">
                @foreach ($porEnfermero as $item)
                    <li>{{ optional($item->enfermero)->nombre }} {{ optional($item->enfermero)->apellido }}: {{ $item->total }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Distribución mensual --}}
    <div class="card border-danger mb-4">
        <div class="card-header bg-light fw-semibold">Distribución de cirugías por mes</div>
        <div class="card-body text-dark">
            <table class="table table-bordered border-danger align-middle">
                <thead class="table-danger text-dark">
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
    <div class="card border-danger mb-4">
        <div class="card-header bg-light fw-semibold">Urgencias vs Programadas</div>
        <div class="card-body text-dark">
            <p>Urgentes: <strong>{{ $urgentes }}</strong> | Programadas: <strong>{{ $programadas }}</strong></p>
        </div>
    </div>

    {{-- Tipos de anestesia --}}
    <div class="card border-danger mb-4">
        <div class="card-header bg-light fw-semibold">Tipos de anestesia utilizadas</div>
        <div class="card-body text-dark">
            <ul class="list-disc ps-3">
                @foreach ($porAnestesia as $item)
                    <li>{{ optional($item->tipo_anestesia)->nombre }}: {{ $item->total }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Canvas para gráfico (opcional) --}}
    <canvas id="cirugiasPorMes" height="100" class="mt-4"></canvas>

</div>

@push('scripts')
{{-- Aquí podés agregar scripts para gráficos si los necesitás --}}
@endpush
@endsection
