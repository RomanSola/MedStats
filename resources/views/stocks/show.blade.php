@extends('layouts.app')

@section('titulo', 'Historial del Stock')

@section('contenido')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md px-2 mb-6">
        Historial del medicamento
    </h1>

    <div class="mb-6 text-sm text-gray-700">
        <p><span class="font-medium">Medicamento:</span> {{ $stock->get_medicamento->nombre }}</p>
        <p><span class="font-medium">Lote:</span> {{ $stock->lote }}</p>
    </div>

        <div class="bg-white shadow rounded-lg border border-gray-200 overflow-auto">
            <table class=" table table-hover table-bordered shadow-sm text-center rounded">
                <thead>
                <tr>
                    <th class="px-4 py-2 border text-center">Cantidad</th>
                    <th class="px-4 py-2 border text-center">Fecha</th>
                    <th class="px-4 py-2 border">Médico</th>
                    <th class="px-4 py-2 border">Paciente</th>
                    <th class="px-4 py-2 border">Comentario</th>
                    <th class="px-4 py-2 border text-center">Usuario</th>
                </tr>
            </thead>
            <tbody>
                @forelse($hist_item as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border text-center">{{ $item->cantidad }}</td>
                    <td class="px-4 py-2 border text-center">{{ $item->fecha }}</td>
                    <td class="px-4 py-2 border">
                        {{ $item->get_empleado?->nombre }} {{ $item->get_empleado?->apellido }}
                        @if($item->get_empleado) (DNI {{ $item->get_empleado->dni }}) @endif
                    </td>
                    <td class="px-4 py-2 border">
                        {{ $item->get_paciente?->nombre }} {{ $item->get_paciente?->apellido }}
                        @if($item->get_paciente) (DNI {{ $item->get_paciente->dni }}) @endif
                    </td>
                    <td class="px-4 py-2 border">{{ $item->comentario }}</td>
                    <td class="px-4 py-2 border text-center">–</td> {{-- Usuario pendiente --}}
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">No hay movimientos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $hist_item->links() }}
    </div>

    <div class="mt-8">
        <a href="{{ route('stocks.index') }}"
           class="btn btn-outline-secondary px-5 py-2 rounded shadow-sm">
            Volver al stock
        </a>
    </div>
</div>
@endsection
