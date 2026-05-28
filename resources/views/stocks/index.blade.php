@extends('layouts.app')
@section('titulo', 'Medicamentos en Stock')
@section('contenido')

    @if (session('success'))
        <div class="mb-6 px-4 py-3 bg-green-100 text-green-800 rounded shadow-sm border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex min-h-screen transition-all duration-300 ease-in-out">

        <!-- Main -->
        <main class="flex-1 p-5 max-w-full">
        <div class="flex justify-between items-center mb-6">
            <h1
                class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent  bg-clip-text drop-shadow-md  flex items-center gap-2 px-2">
                Medicamentos en Stock</h1>
            
            <div class="flex gap-4 items-center">
                <!-- Filtros por servicio -->
                <form method="GET" action="{{ route('stocks.index') }}" class="flex items-center gap-3">
                    <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-lg" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border: 2px solid #1B7D8F;">

                        <label for="servicio_id" class="font-semibold mb-0" style="color: #1B7D8F;">Filtrar por Servicio:</label>
                        <select name="servicio_id" id="servicio_id" 
                            class="form-select" 
                            style="border: 2px solid #1B7D8F; border-radius: 8px; min-width: 200px; font-weight: 500;"
                            onchange="this.form.submit()"
                            {{ (count($servicios) == 1 && auth()->user()->servicio_id) ? 'disabled' : '' }}
                        >
                            @if(!auth()->user()->servicio_id)
                                <option value="">Todos los Servicios</option>
                            @endif
                            @foreach($servicios as $s)
                                <option value="{{ $s->id }}" {{ request('servicio_id') == $s->id ? 'selected' : '' }}>
                                    {{ $s->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @if(auth()->user()->servicio_id)
                            <span class="badge" style="background-color: #1B7D8F; font-size: 0.75rem;">
                                Restringido
                            </span>
                        @endif
                    </div>
                </form>

                <a href="{{ route('stocks.create') }}"
                    class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300"
                    style="text-decoration: none;">
                    Ingresar Nuevo Medicamento
                </a>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg border border-gray-200 overflow-auto">
            <table class=" table table-hover table-bordered shadow-sm text-center rounded">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Medicamento</th>
                        <th class="px-4 py-2 border">Servicio</th>
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
                            <td class="px-4 py-2 border">{{ $item->get_servicio->nombre }}</td>
                            <td class="px-4 py-2 border">{{ $item->lote }}</td>
                            <td class="px-4 py-2 border">{{ $item->fecha_vencimiento }}</td>
                            <td class="px-4 py-2 border text-center">
                                <span class="{{ $claseColor }}">{{ $item->cantidad_act }}</span>
                            </td>
                            <td class="px-4 py-2 border text-center space-x-2">
                                <a href="{{ route('stocks.show', $item) }}" class="btn btn-outline-primary btn-sm me-1">
                                    Historial
                                </a>

                                <a href="{{ route('stocks.edit', ['stock' => $item->id, 'modo' => 'agregar']) }}" class="btn btn-outline-success btn-sm">
                                    Agregar
                                </a>
                                
                                <a href="{{ route('stocks.edit', ['stock' => $item->id, 'modo' => 'extraer']) }}" class="btn btn-outline-danger btn-sm">
                                    Extraer
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
 </div>      
@endsection
@push('scripts')
<script>
$(document).ready(function () {
    const tabla = $('.table').DataTable({
        dom: '<"top-controls"lf>rt<"bottom-controls"ip>',
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            search: "Buscar medicamento:",
            lengthMenu: "Mostrar _MENU_ medicamentos por página",
            info: "Mostrando _START_ a _END_ de _TOTAL_ medicamentos",
            infoEmpty: "No hay medicamentos para mostrar",
            infoFiltered: "(filtrado de _MAX_ medicamentos en total)"
        },
        order: [[2, 'asc']],
        columnDefs: [
            { orderable: false, targets: 4 }
        ]
    });
});
</script>
@endpush