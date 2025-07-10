@extends('layouts.app')

@section('titulo', 'Modificar Stock')

@section('contenido')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Modificar Stock</h1>

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
        </div>

        <!-- Modificación de stock -->
        <div>
            <label for="cantidad_mod" class="block text-sm font-medium text-gray-700 mb-1">Agregar o Extraer Cantidad</label>
            <input type="number" name="cantidad_mod" id="cantidad_mod" placeholder="Ingrese cantidad que quiera agergar o extraer"
                   class="w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 focus:ring-2 focus:ring-blue-500"
                   required>
            @error('cantidad_mod')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Asociación con paciente y médico -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="paciente_id" class="block text-sm font-medium text-gray-700 mb-1">El medicamento es para</label>
                <select name="paciente_id" id="paciente_id"
                        class="w-full rounded-md border-gray-300 px-4 py-2">
                    <option value="">Seleccione un paciente</option>
                    @foreach ($pacientes as $paciente)
                        <option value="{{ $paciente->id }}" {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                            {{ $paciente->apellido }}, {{ $paciente->nombre }} – DNI {{ $paciente->dni }}
                        </option>
                    @endforeach
                </select>
                @error('paciente_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="empleado_id" class="block text-sm font-medium text-gray-700 mb-1">Recetado por</label>
                <select name="empleado_id" id="empleado_id"
                        class="w-full rounded-md border-gray-300 px-4 py-2">
                    <option value="">Seleccione un médico</option>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id }}" {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}>
                            Dr/a {{ $empleado->apellido }} – DNI {{ $empleado->dni }}
                        </option>
                    @endforeach
                </select>
                @error('empleado_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

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

        <!-- Botón -->
        <div class="flex justify-end pt-4">
            <button type="submit"
                    class="bg-neutral-700 hover:bg-neutral-800 text-white font-medium px-6 py-2 rounded-full shadow transition">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection
