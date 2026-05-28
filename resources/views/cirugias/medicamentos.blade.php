@extends('layouts.app')

@section('titulo', 'Cargar Medicamentos - Cirugía #' . $cirugia->id)

@section('contenido')
<div class="max-w-6xl mx-auto px-4 py-8">
    <!-- Header Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 mb-8 transition duration-300 hover:shadow-2xl">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <span class="bg-[#e6f4f3] text-[#1B7D8F] text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider">
                    Cirugía #{{ $cirugia->id }}
                </span>
                <h1 class="text-3xl font-extrabold text-gray-800 mt-2">
                    Cargar Medicamentos e Insumos
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Gestione los consumibles descontados del stock de Quirófano para esta cirugía.
                </p>
            </div>
            <div>
                <a href="{{ route('cirugias.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900 transition">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Volver a Cirugías
                </a>
            </div>
        </div>

        <hr class="my-6 border-gray-100">

        <!-- Surgery Details Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <div class="flex items-start gap-3">
                <div class="p-3 bg-[#e6f4f3] text-[#1B7D8F] rounded-xl">
                    <i data-lucide="user" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="text-xs text-gray-400 block uppercase font-medium">Paciente</span>
                    <span class="text-sm font-bold text-gray-700">
                        {{ $cirugia->get_paciente->nombre }} {{ $cirugia->get_paciente->apellido }}
                    </span>
                    <span class="text-xs text-gray-500 block">DNI: {{ $cirugia->get_paciente->dni }}</span>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="p-3 bg-[#e6f4f3] text-[#1B7D8F] rounded-xl">
                    <i data-lucide="calendar" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="text-xs text-gray-400 block uppercase font-medium">Fecha y Hora</span>
                    <span class="text-sm font-bold text-gray-700">
                        {{ \Carbon\Carbon::parse($cirugia->fecha_cirugia)->format('d/m/Y') }}
                    </span>
                    <span class="text-xs text-gray-500 block">{{ $cirugia->hora_cirugia }} hs</span>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="p-3 bg-[#e6f4f3] text-[#1B7D8F] rounded-xl">
                    <i data-lucide="activity" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="text-xs text-gray-400 block uppercase font-medium">Cirujano</span>
                    <span class="text-sm font-bold text-gray-700">
                        Dr/a. {{ $cirugia->get_cirujano->nombre }} {{ $cirugia->get_cirujano->apellido }}
                    </span>
                    <span class="text-xs text-gray-500 block">Mat: {{ $cirugia->get_cirujano->matricula ?? 'S/M' }}</span>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="p-3 bg-[#e6f4f3] text-[#1B7D8F] rounded-xl">
                    <i data-lucide="home" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="text-xs text-gray-400 block uppercase font-medium">Quirófano</span>
                    <span class="text-sm font-bold text-gray-700">
                        {{ $cirugia->get_quirofano->nombre }}
                    </span>
                    <span class="text-xs text-gray-500 block">{{ $cirugia->get_quirofano->descripcion ?? 'Sin descripción' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-xl mb-6 shadow-sm flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 flex-shrink-0"></i>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-rose-50 border-l-4 border-rose-500 text-rose-800 p-4 rounded-xl mb-6 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
                <i data-lucide="alert-circle" class="w-5 h-5 text-rose-500 flex-shrink-0"></i>
                <span class="text-sm font-bold">Por favor corrija los siguientes errores:</span>
            </div>
            <ul class="list-disc list-inside text-xs space-y-1 pl-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Two Column Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Column: Add Medication Form -->
        <div class="lg:col-span-4">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 sticky top-24">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i data-lucide="plus" class="w-5 h-5 text-[#1B7D8F]"></i> Cargar Nuevo
                </h2>
                
                <form action="{{ route('cirugias.medicamentos.store', $cirugia) }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="stock_id" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Medicamento / Insumo (Lote - Stock)
                        </label>
                        <select name="stock_id" id="stock_id" class="form-control select2 w-full" required>
                            <option value="">Seleccione el insumo</option>
                            @foreach($stocks as $stock)
                                <option value="{{ $stock->id }}" {{ old('stock_id') == $stock->id ? 'selected' : '' }}>
                                    {{ $stock->get_medicamento->nombre }} (Lote: {{ $stock->lote }} – Disp: {{ $stock->cantidad_act }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="cantidad" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Cantidad a extraer
                        </label>
                        <input type="number" name="cantidad" id="cantidad" min="1" 
                            class="w-full rounded-lg border border-gray-200 shadow-sm px-4 py-2 focus:ring-2 focus:ring-[#1B7D8F] focus:border-transparent text-sm" 
                            value="{{ old('cantidad', 1) }}" required>
                    </div>

                    <button type="submit" 
                        class="w-full bg-[#1B7D8F] hover:bg-[#15606e] text-white font-bold py-2.5 px-4 rounded-xl shadow-md transition flex items-center justify-center gap-2">
                        <i data-lucide="shopping-bag" class="w-4 h-4"></i> Descontar del Stock
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Column: Loaded Medications List -->
        <div class="lg:col-span-8">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <i data-lucide="list-checks" class="w-5 h-5 text-[#1B7D8F]"></i> Medicamentos Cargados
                </h2>

                @if($consumidos->isEmpty())
                    <div class="flex flex-col items-center justify-center py-12 text-center">
                        <div class="p-4 bg-gray-50 rounded-full text-gray-400 mb-4">
                            <i data-lucide="shopping-cart" class="w-8 h-8"></i>
                        </div>
                        <h3 class="font-semibold text-gray-600">No hay medicamentos cargados</h3>
                        <p class="text-xs text-gray-400 mt-1 max-w-sm">
                            Los medicamentos y descartables utilizados durante el acto quirúrgico se listarán aquí una vez descontados del Quirófano.
                        </p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-100 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    <th class="py-3 px-4">Medicamento / Insumo</th>
                                    <th class="py-3 px-4">Lote</th>
                                    <th class="py-3 px-4">Vencimiento</th>
                                    <th class="py-3 px-4 text-center">Cantidad</th>
                                    <th class="py-3 px-4 text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($consumidos as $item)
                                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition">
                                        <td class="py-4 px-4">
                                            <span class="font-bold text-gray-700">
                                                {{ $item->get_stock->get_medicamento->nombre ?? 'Insumo Eliminado' }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 text-sm text-gray-500">
                                            {{ $item->get_stock->lote ?? 'N/D' }}
                                        </td>
                                        <td class="py-4 px-4 text-sm text-gray-500">
                                            {{ $item->get_stock->fecha_vencimiento ? \Carbon\Carbon::parse($item->get_stock->fecha_vencimiento)->format('d/m/Y') : 'N/D' }}
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <span class="bg-rose-50 text-rose-700 text-xs font-bold px-2.5 py-1 rounded-full">
                                                {{ abs($item->cantidad) }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 text-right">
                                            <form action="{{ route('cirugias.medicamentos.destroy', [$cirugia, $item]) }}" method="POST" 
                                                onsubmit="return confirm('¿Está seguro de que desea eliminar esta carga de medicamento? El stock será devuelto al quirofano.');"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-500 hover:text-rose-700 p-1.5 hover:bg-rose-50 rounded-lg transition" title="Eliminar y devolver al stock">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Seleccione un insumo/medicamento",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
@endsection
