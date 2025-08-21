@extends('layouts.app')

@section('titulo', 'Historial del Stock')

@section('contenido')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Historial del medicamento</h1>

    <div class="mb-6 text-sm text-gray-700">
        <p><span class="font-medium">Medicamento:</span> {{ $stock->get_medicamento->nombre }}</p>
        <p><span class="font-medium">Lote:</span> {{ $stock->lote }}</p>
    </div>

    <div class="bg-white shadow rounded-lg border border-gray-200 overflow-auto">
        <table class="min-w-full text-sm text-gray-800 table-auto">
            <thead class="bg-gray-100 text-gray-700 font-semibold">
                <tr>
                    <th class="px-4 py-2 border">Cantidad</th>
                    <th class="px-4 py-2 border">Fecha</th>
                    <th class="px-4 py-2 border">Médico</th>
                    <th class="px-4 py-2 border">Paciente</th>
                    <th class="px-4 py-2 border">Comentario</th>
                    <th class="px-4 py-2 border">Usuario</th>
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
           class="bg-neutral-700 hover:bg-neutral-800 text-white font-medium px-5 py-2 rounded-full shadow transition">
            ← Volver al stock
        </a>
    </div>
</div>
@endsection
