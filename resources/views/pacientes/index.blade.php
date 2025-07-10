@extends('layouts.app')

@section('titulo', 'Gestión de Pacientes')

@section('contenido')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Pacientes Registrados</h1>
        <a href="{{ route('pacientes.create') }}"
           class="bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow">
            + Ingresar Nuevo Paciente
        </a>
    </div>

    <div class="bg-white shadow rounded-lg border border-gray-200 overflow-auto">
        <table class="min-w-full text-sm text-gray-800 table-auto">
            <thead class="bg-gray-100 text-gray-700 font-semibold">
                <tr>
                    <th class="px-4 py-2 border">DNI</th>
                    <th class="px-4 py-2 border">Nombre</th>
                    <th class="px-4 py-2 border">Apellido</th>
                    <th class="px-4 py-2 border">Teléfono</th>
                    <th class="px-4 py-2 border">Género</th>
                    <th class="px-4 py-2 border">Habitación</th>
                    <th class="px-4 py-2 border">Cama</th>
                    <th class="px-4 py-2 border text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pacientes as $paciente)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $paciente->dni }}</td>
                    <td class="px-4 py-2 border">{{ $paciente->nombre }}</td>
                    <td class="px-4 py-2 border">{{ $paciente->apellido }}</td>
                    <td class="px-4 py-2 border">{{ $paciente->telefono }}</td>
                    <td class="px-4 py-2 border">{{ $paciente->genero }}</td>
                    <td class="px-4 py-2 border">
                        {{ $paciente->habitacion?->numero ?? '—' }}
                    </td>
                    <td class="px-4 py-2 border">
                        {{ $paciente->cama?->codigo ?? '—' }}
                    </td>
                    <td class="px-4 py-2 border text-center space-x-2">
                        <a href="{{ route('pacientes.show', $paciente) }}" class="text-neutral-700 hover:underline font-medium">Ver</a>
                        <a href="{{ route('pacientes.edit', $paciente) }}" class="text-neutral-700 hover:underline font-medium">Editar</a>
                        @if($paciente->cama_id)
                        <form action="{{ route('pacientes.darDeAlta', $paciente) }}" method="POST" class="inline-block form-dar-de-alta">
                            @csrf
                            <button type="submit" class="text-green-600 hover:underline font-medium">Dar de alta</button>
                        </form>
                        @else
                            <a href="{{ route('pacientes.asignar', $paciente) }}" class="text-blue-700 hover:underline font-medium">Asignar</a>
                        @endif
                        <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST" class="inline-block form-eliminar">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline font-medium">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-2 text-center text-gray-500">No hay pacientes registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Confirmar dar de alta
        document.querySelectorAll('.form-dar-de-alta').forEach(form => {
            form.addEventListener('submit', function (e) {
                const confirmar = confirm('¿Estás seguro que querés dar de alta a este paciente? Esta acción liberará la cama asignada.');
                if (!confirmar) {
                    e.preventDefault();
                }
            });
        });

        // Confirmar eliminación
        document.querySelectorAll('.form-eliminar').forEach(form => {
            form.addEventListener('submit', function (e) {
                const confirmar = confirm('¿Seguro que querés eliminar este paciente? Esta acción no se puede deshacer.');
                if (!confirmar) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection