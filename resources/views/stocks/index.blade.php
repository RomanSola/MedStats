@extends('layouts.app')

@section('titulo', 'Medicamentos en Stock')

@section('contenido')

    @if (session('success'))
        <div class="mb-6 px-4 py-3 bg-green-100 text-green-800 rounded shadow-sm border border-green-200">
            {{ session('success') }}
        </div>
    @endif



    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Medicamentos en Stock</h1>
            <a href="{{ route('stocks.create') }}"
                class="bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow">
                + Ingresar Nuevo Medicamento
            </a>
        </div>

        <div class="bg-white shadow rounded-lg border border-gray-200 overflow-auto">
            <table class=" table table-hover table-bordered shadow-sm text-center rounded">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Medicamento</th>
                        <th class="px-4 py-2 border">Lote</th>
                        <th class="px-4 py-2 border">Fecha de vencimiento</th>
                        <th class="px-4 py-2 border text-center">Cantidad actual</th>
                        <th class="px-4 py-2 border text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stock as $item)
                        @php
    if ($item->cantidad_act < 30) {
        $claseColor = 'text-red-600 font-bold'; // 🔴 Crítico
    } elseif ($item->cantidad_act < 50) {
        $claseColor = 'text-yellow-600 font-medium'; // 🟡 Advertencia
    } else {
        $claseColor = 'text-green-700 font-medium'; // 🟢 Suficiente
    }
                        @endphp

                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $item->get_medicamento->nombre }}</td>
                            <td class="px-4 py-2 border">{{ $item->lote }}</td>
                            <td class="px-4 py-2 border">{{ $item->fecha_vencimiento }}</td>
                            <td class="px-4 py-2 border text-center">
                                <span class="{{ $claseColor }}">{{ $item->cantidad_act }}</span>
                            </td>
                            <td class="px-4 py-2 border text-center space-x-2">
                                <a href="{{ route('stocks.show', $item) }}"
                                    class="inline-block bg-green-500 hover:bg-gray-200 text-gray-700 text-sm px-3 py-1 rounded-full shadow-sm transition">
                                    Historial
                                </a>

                                <a href="{{ route('stocks.edit', $item) }}"
                                    class="inline-block bg-green-500 hover:bg-gray-200 text-gray-700 text-sm px-3 py-1 rounded-full shadow-sm transition">
                                    Editar
                                </a>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-2 text-center text-gray-500">No hay medicamentos en stock.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
@endsection
