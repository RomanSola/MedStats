@extends('layouts.app')

@section('titulo', 'Asignar habitación y cama')

@section('contenido')
<div class="max-w-2xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Asignar Habitación y Cama a {{ $paciente->nombre }} {{ $paciente->apellido }}</h1>

    <form action="{{ route('pacientes.asignar.guardar', $paciente) }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-6 border">
        @csrf

        <div>
            <label for="sala_id" class="block font-medium text-gray-700 mb-1">Sala</label>
            <select id="sala_id" class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-neutral-300">
                <option value="">-- Seleccioná una sala --</option>
                @foreach($salas as $sala)
                    <option value="{{ $sala->id }}">{{ $sala->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="habitacion_id" class="block font-medium text-gray-700 mb-1">Habitación</label>
            <select name="habitacion_id" id="habitacion_id" class="w-full border-gray-300 rounded shadow-sm" disabled>
                <option value="">-- Seleccioná una habitación --</option>
            </select>
        </div>

        <div>
            <label for="cama_id" class="block font-medium text-gray-700 mb-1">Cama</label>
            <select name="cama_id" id="cama_id" class="w-full border-gray-300 rounded shadow-sm" disabled>
                <option value="">-- Seleccioná una cama --</option>
            </select>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-neutral-700 text-white px-6 py-2 rounded-full hover:bg-neutral-800 shadow">
                Guardar asignación
            </button>
        </div>
    </form>
</div>

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

        if (sala) {
            habitacionSelect.disabled = false;
            sala.habitaciones.forEach(h => {
                habitacionSelect.innerHTML += `<option value="${h.id}">${h.numero ?? 'Habitación ' + h.id}</option>`;
            });
        } else {
            habitacionSelect.disabled = true;
        }
    });

    habitacionSelect.addEventListener('change', () => {
        const salaId = parseInt(salaSelect.value);
        const habitacionId = parseInt(habitacionSelect.value);
        const sala = salas.find(s => s.id === salaId);
        const habitacion = sala?.habitaciones.find(h => h.id === habitacionId);

        camaSelect.innerHTML = '<option value="">-- Seleccioná una cama --</option>';

        if (habitacion) {
            camaSelect.disabled = false;
            habitacion.camas.forEach(c => {
                camaSelect.innerHTML += `<option value="${c.id}">Cama ${c.codigo ?? c.id}</option>`;
            });
        } else {
            camaSelect.disabled = true;
        }
    });
</script>
@endsection