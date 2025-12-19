@extends('layouts.app')
@section('titulo', 'Modificar Stock')
@section('contenido')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1
            class="text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md px-2 mb-6">
            Modificar Stock
        </h1>
        <form action="{{ route('stocks.update', $stock) }}" method="POST"
        class="bg-white shadow rounded-lg border border-gray-200 p-6 space-y-6">
        @csrf
        @method('PUT')

        <!-- Datos fijos del medicamento -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Medicamento</label>
                <input type="text" value="{{ $stock->get_medicamento->nombre }}" readonly
                    class="w-full bg-gray-100 border border-gray-300 rounded-md px-4 py-2 text-gray-700">
                <input type="hidden" name="medicamento_id" value="{{ $stock->medicamento_id }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lote</label>
                <input type="text" value="{{ $stock->lote }}" readonly
                    class="w-full bg-gray-100 border border-gray-300 rounded-md px-4 py-2 text-gray-700">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Vencimiento</label>
                <input type="text" value="{{ $stock->fecha_vencimiento }}" readonly
                    class="w-full bg-gray-100 border border-gray-300 rounded-md px-4 py-2 text-gray-700">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad Actual</label>
                <input type="number" value="{{ $stock->cantidad_act }}" readonly
                    class="w-full bg-gray-100 border border-gray-300 rounded-md px-4 py-2 text-gray-700">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                <input type="text" value="{{ $stock->get_servicio->nombre }}" readonly
                    class="w-full bg-gray-100 border border-gray-300 rounded-md px-4 py-2 text-gray-700">
            </div>
        </div>

        <!-- Modificación de stock -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @if ($modo === 'agregar')
                <div>
                    <label for="cantidad_agregar" class="block text-sm font-medium text-gray-700 mb-1">Agregar Cantidad</label>
                    <input type="number" name="cantidad_agregar" id="cantidad_agregar" min="0"
                        class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-green-500"
                        value="{{ old('cantidad_agregar') }}">
                    @error('cantidad_agregar')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @elseif ($modo === 'extraer')
                <div>
                    <label for="cantidad_extraer" class="block text-sm font-medium text-gray-700 mb-1">Extraer Cantidad</label>
                    <input type="number" name="cantidad_extraer" id="cantidad_extraer" min="0"
                        class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-red-500"
                        value="{{ old('cantidad_extraer') }}">
                    @error('cantidad_extraer')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endif
        </div>

        @if ($modo === 'extraer')
            <!-- Asociación con paciente y médico -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="paciente_id" class="block text-sm font-medium text-gray-700 mb-1">El medicamento es para</label>
                    <select name="paciente_id" id="paciente_id" class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500 select2">
                        <option value="">Seleccione un paciente</option>
                        @foreach ($pacientes as $paciente)
                            <option value="{{ $paciente->id }}"
                                {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                                {{ $paciente->apellido }}, {{ $paciente->nombre }} – DNI {{ $paciente->dni }}
                            </option>
                        @endforeach
                    </select>
                    @error('paciente_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label for="empleado_id" class="block text-sm font-medium text-gray-700 mb-1">Recetado por</label>
                    <select name="empleado_id" id="empleado_id" class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500 select2">
                        <option value="">Seleccione un médico</option>
                        @php $profesionesPermitidas = [1, 2]; @endphp
                        @foreach ($empleados as $empleado)
                        @if (in_array($empleado->get_profesion->rol_id, $profesionesPermitidas))
                            <option value="{{ $empleado->id }}"
                                {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}>
                                Dr/a {{ $empleado->apellido }} – Mat. {{ $empleado->matricula ?? 'S/M' }}
                            </option>
                        @endif
                        @endforeach
                    </select>
                    @error('empleado_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        @endif

        <!-- Comentario -->
        <div>
            <label for="comentario" class="block text-sm font-medium text-gray-700 mb-1">Comentario</label>
            <input type="text" name="comentario" id="comentario"
                class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500"
                value="{{ old('comentario') }}">
            @error('comentario')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex justify-between pt-4">
            <a href="{{ route('stocks.index') }}" class="btn btn-outline-danger px-5 py-2 rounded shadow-sm">
                Cancelar
            </a>
            <button type="submit"
                class="inline-block bg-neutral-700 hover:bg-neutral-800 text-white font-medium py-2 px-6 rounded-full shadow-md cursor-pointer transition duration-300">
                Guardar
            </button>
        </div>
    </form>     
    </div>
@push('scripts')

<style>
    /* Estilos personalizados para Select2 */
    .select2-container--default .select2-selection--single {
        border: 1px solid #d1d5db !important;
        border-radius: 0.375rem !important;
        height: 42px !important;
        padding: 0.5rem 1rem !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 26px !important;
        padding-left: 0 !important;
        color: #374151 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px !important;
        right: 8px !important;
    }

    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #3b82f6 !important;
        outline: none !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
    }

    .select2-dropdown {
        border: 1px solid #d1d5db !important;
        border-radius: 0.375rem !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #3b82f6 !important;
    }
</style>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Seleccione una opción",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
@endsection