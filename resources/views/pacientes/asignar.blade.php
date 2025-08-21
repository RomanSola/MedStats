@extends('layouts.app')

@section('titulo', 'Asignar habitación y cama')

@section('contenido')

<div class="max-w-2xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">
        Asignar Habitación y Cama a {{ $paciente->nombre }} {{ $paciente->apellido }}
    </h1>

    {{-- Aviso cuando se viene desde la creación del paciente --}}
    @if(session('success'))
        <div class="mb-6 p-4 rounded-md bg-green-100 border border-green-300 text-green-800 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pacientes.asignar.guardar', $paciente) }}" method="POST" 
          class="bg-white p-6 rounded-lg shadow space-y-6 border">
        @csrf

        <div>
            <label for="sala_id" class="block font-medium text-gray-700 mb-1">Sala</label>
            <select id="sala_id" 
                    class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-neutral-300">
                <option value="">-- Seleccioná una sala --</option>
                @foreach($salas as $sala)
                    <option value="{{ $sala->id }}">{{ $sala->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="habitacion_id" class="block font-medium text-gray-700 mb-1">Habitación</label>
            <select name="habitacion_id" id="habitacion_id" 
                    class="w-full border-gray-300 rounded shadow-sm" disabled>
                <option value="">-- Seleccioná una habitación --</option>
            </select>
        </div>

        <div>
            <label for="cama_id" class="block font-medium text-gray-700 mb-1">Cama</label>
            <select name="cama_id" id="cama_id" 
                    class="w-full border-gray-300 rounded shadow-sm" disabled>
                <option value="">-- Seleccioná una cama --</option>
            </select>
        </div>

        <div class="text-right">
            <button type="submit" 
                    class="bg-neutral-700 text-white px-6 py-2 rounded-full hover:bg-neutral-800 shadow">
                Guardar asignación
            </button>
        </div>
    </form>
</div>


            {{-- Sala --}}
            <div>
                <label for="sala_id" class="block text-sm font-medium text-gray-700 mb-1">Sala</label>
                <select id="sala_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-neutral-300">
                    <option value="">-- Seleccioná una sala --</option>
                    @foreach ($salas as $sala)
                        <option value="{{ $sala->id }}">{{ $sala->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Habitación --}}
            <div>
                <label for="habitacion_id" class="block text-sm font-medium text-gray-700 mb-1">Habitación</label>
                <select name="habitacion_id" id="habitacion_id" class="w-full border-gray-300 rounded-md shadow-sm"
                    disabled>
                    <option value="">-- Seleccioná una habitación --</option>
                </select>
            </div>

            {{-- Cama --}}
            <div>
                <label for="cama_id" class="block text-sm font-medium text-gray-700 mb-1">Cama</label>
                <select name="cama_id" id="cama_id" class="w-full border-gray-300 rounded-md shadow-sm" disabled>
                    <option value="">-- Seleccioná una cama --</option>
                </select>
            </div>

            {{-- Botón de acción --}}
            <div class="text-right pt-4">
                <button type="submit"
                    class="bg-neutral-700 hover:bg-neutral-800 text-white font-semibold px-6 py-2 rounded-full shadow-md transition">
                    Guardar asignación
                </button>
            </div>
        </form>
    </div>

    {{-- Script dinámico --}}
    <script>
        const salas = @json($salas);

        const salaSelect = document.getElementById('sala_id');
        const habitacionSelect = document.getElementById('habitacion_id');
        const camaSelect = document.getElementById('cama_id');

        salaSelect.addEventListener('change', () => {
            const salaId = parseInt(salaSelect.value);
            const sala = salas.find(s => s.id === salaId);

            habitacionSelect.innerHTML = '<option value="">-- Seleccioná una habitación --</option>';
            camaSelect.innerHTML = '<option value="">-- Seleccioná una cama --</option>';
            camaSelect.disabled = true;

        }
    });
</script>

@endsection
