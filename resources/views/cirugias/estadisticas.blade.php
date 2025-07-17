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
@endpush
@endsection