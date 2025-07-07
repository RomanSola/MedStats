@extends('layouts.app')

@section('title', 'Gestión de Cirugias')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Gestor de Cirugias</h2>

    <div class="card border-warning">
        <div class="card-body">
            <p class="card-text">Administrá las cirugias registradas en el sistema. Podés ver detalles y editarlos.</p>
            <a href="{{ route('cirugias.create') }}" class="btn btn-warning mb-3">Registrar Nueva Cirugía</a>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-warning">
                        <tr>
                            <th>Paciente</th>
                            <th>Procedimiento</th>
                            <th>Cirujano</th>
                            <th>Ayudante 1</th>
                            <th>Ayudante 2</th>
                            <th>Anestesista</th>
                            <th>Tipo de Anestesia</th>
                            <th>Instrumentador</th>
                            <th>Urgencia</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cirugias as $cirugia)
                        <tr>
                            <td>{{ $cirugia->get_paciente->nombre }} {{ $cirugia->get_paciente->apellido }}</td>
                            <td>{{ $cirugia->get_procedimiento->nombre_procedimiento }}</td>
                            <td>{{ $cirugia->get_cirujano->nombre }} {{ $cirugia->get_cirujano->apellido }}</td>
                            <td>{{ $cirugia->get_ayudante1->nombre }} {{ $cirugia->get_ayudante1->apellido }}</td>
                            <td>{{ $cirugia->get_ayudante2->nombre }} {{ $cirugia->get_ayudante2->apellido }}</td>
                            <td>{{ $cirugia->get_anestesista->nombre }} {{ $cirugia->get_anestesista->apellido }}</td>
                            <td>{{ $cirugia->get_tipo_anestesia->nombre }}</td>
                            <td>{{ $cirugia->get_instrumentador->nombre }} {{ $cirugia->get_instrumentador->apellido }}</td>
                            <td>{{ $cirugia->urgencia ? 'Si' : 'No' }}</td>
                            <td class="text-center">
                                <a href="{{ route('cirugias.show', $cirugia) }}" class="btn btn-outline-primary btn-sm me-1">Ver</a>
                                <a href="{{ route('cirugias.edit', $cirugia) }}" class="btn btn-outline-warning btn-sm me-1">Editar</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">No hay cirugias registradas aún.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection