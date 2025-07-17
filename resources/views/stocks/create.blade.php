@extends('layouts.app')

@section('titulo', 'Ingresar Medicamento')

@section('contenido')
<div class="max-w-3xl mx-auto px-4 py-8">

    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Ingresar nuevo medicamento al stock</h1>

    <form action="{{ route('stocks.store') }}" method="POST"
        class="bg-white shadow rounded-lg border border-gray-200 p-6 space-y-6">
        @csrf

        <!-- Input con búsqueda de medicamentos -->
        <div>
            <label for="medicamento_input" class="block text-sm font-medium text-gray-700 mb-1">Medicamento</label>
            <input type="text" id="medicamento_input" name="medicamento_id"
                class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-gray-500"
                placeholder="Escriba para buscar un medicamento..." required>
            @error('medicamento_id')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Detalles del lote -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="cantidad_act" class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
                <input type="number" name="cantidad_act" id="cantidad_act"
                    class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-gray-900"
                    value="{{ old('cantidad_act') }}" required>
            </div>

            <div>
                <label for="lote" class="block text-sm font-medium text-gray-700 mb-1">Lote</label>
                <input type="text" name="lote" id="lote"
                    class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-gray-900"
                    value="{{ old('lote') }}" required>
            </div>

            <div>
                <label for="fecha_vencimiento" class="block text-sm font-medium text-gray-700 mb-1">Fecha de vencimiento</label>
                <input type="date" name="fecha_vencimiento" id="fecha_vencimiento"
                    class="w-full rounded-md border-gray-300 px-4 py-2 focus:ring-2 focus:ring-gray-500"
                    value="{{ old('fecha_vencimiento') }}" required>
            </div>
        </div>

        <!-- Botón -->
        <div class="flex justify-end pt-4">
            <button type="submit"
                class="bg-neutral-700 hover:bg-neutral-800 text-white font-medium px-6 py-2 rounded-full shadow transition">
                💾 Agregar medicamento
            </button>
        </div>
    </form>
</div>

<!-- Script para alerta de vencimiento -->
<script>
    const vencimiento = document.getElementById('fecha_vencimiento');

    vencimiento.addEventListener('change', () => {
        const inputDate = new Date(vencimiento.value);
        const today = new Date();
        const limit = new Date();
        limit.setDate(today.getDate() + 15);

        if (inputDate <= today) {
            showWarning("⚠️ Este medicamento está vencido o vence hoy.");
        } else if (inputDate <= limit) {
            showWarning("⚠️ Este medicamento vence en los próximos 15 días.");
        } else {
            hideWarning();
        }
    });

    function showWarning(message) {
        let alertBox = document.getElementById('vencimiento-alert');
        if (!alertBox) {
            alertBox = document.createElement('div');
            alertBox.id = 'vencimiento-alert';
            alertBox.className = 'mb-4 px-4 py-3 bg-yellow-100 border border-yellow-300 text-yellow-800 rounded shadow-sm';
            vencimiento.parentNode.insertBefore(alertBox, vencimiento.parentNode.firstChild);
        }
        alertBox.innerText = message;
    }

    function hideWarning() {
        const alertBox = document.getElementById('vencimiento-alert');
        if (alertBox) alertBox.remove();
    }
</script>

<!-- Tom Select CSS y JS -->
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

<!-- Inicialización de autocompletado -->
<script>
    new TomSelect('#medicamento_input', {
        options: [
            @foreach($medicamentos as $id => $nombre)
                { value: '{{ $id }}', text: '{{ $nombre }}' },
            @endforeach
        ],
        create: false,
        maxItems: 1,
        placeholder: "Escriba para buscar un medicamento...",
        allowEmptyOption: true,
        sortField: {
            field: "text",
            direction: "asc"
        },
        render: {
            no_results: function(data, escape) {
                return '<div class="no-results">No se encontró ningún medicamento</div>';
            }
        }
    });
</script>
@endsection
