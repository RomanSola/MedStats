@extends('layouts.app')

@section('title', 'Plantillas de Programación')

@section('contenido')
<div class="container mx-auto px-4 py-6 max-w-7xl">
    
    <!-- Encabezado -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <a href="{{ route('ajustes') }}" class="text-[#1B7D8F] hover:text-[#156370] text-sm font-semibold flex items-center gap-1 transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Volver a Ajustes
                </a>
            </div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight flex items-center gap-2">
                <i data-lucide="calendar-range" class="w-7 h-7 text-[#1B7D8F]"></i>
                Plantillas de Programación Semanal
            </h1>
            <p class="text-sm text-gray-500 mt-0.5">
                Configure turnos de cirugía precargados y reservas de bloques semanales por especialidad y quirófano.
            </p>
        </div>

        <button onclick="abrirModalPlantilla()" class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#1B7D8F] hover:bg-[#156370] text-white text-sm font-bold rounded-xl shadow-md transition-all">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Nueva Regla Semanal
        </button>
    </div>

    @if(session('exito'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-2 shadow-xs">
            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
            <span>{{ session('exito') }}</span>
        </div>
    @endif

    <!-- Grilla por Días de la Semana -->
    @php
        $diasNombre = [
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
            7 => 'Domingo'
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @foreach($diasNombre as $numDia => $nombreDia)
            @php
                $plantillasDelDia = $plantillas->where('dia_semana', $numDia);
            @endphp
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                <!-- Header Día -->
                <div class="px-4 py-3 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4 text-[#1B7D8F]"></i>
                        {{ $nombreDia }}
                    </h3>
                    <span class="px-2 py-0.5 text-xs font-extrabold rounded-full bg-[#1B7D8F]/10 text-[#1B7D8F]">
                        {{ $plantillasDelDia->count() }} {{ $plantillasDelDia->count() === 1 ? 'reserva' : 'reservas' }}
                    </span>
                </div>

                <!-- Lista de Reservas del Día -->
                <div class="p-3 space-y-3 flex-1 overflow-y-auto">
                    @forelse($plantillasDelDia as $item)
                        <div class="p-3 bg-gray-50 hover:bg-white rounded-xl border border-gray-200/80 hover:border-[#1B7D8F]/40 transition-all shadow-xs group">
                            
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="px-2 py-0.5 text-[11px] font-bold rounded-md bg-[#1B7D8F]/10 text-[#1B7D8F]">
                                    {{ $item->quirofano }}
                                </span>
                                <div class="flex items-center gap-1">
                                    <span class="text-xs font-semibold text-gray-500">
                                        {{ $item->hora ? \Carbon\Carbon::parse($item->hora)->format('H:i') . ' hs' : 'Sin hora' }}
                                    </span>
                                    <button onclick='editarPlantilla(@json($item))' class="p-1 text-gray-400 hover:text-amber-600 rounded hover:bg-amber-50 transition-colors">
                                        <i data-lucide="edit-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                    <form action="{{ route('plantillas-programacion.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta plantilla recurrente?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 text-gray-400 hover:text-rose-600 rounded hover:bg-rose-50 transition-colors">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="font-bold text-gray-900 text-sm">
                                {{ $item->especialidad }}
                            </div>

                            @if($item->procedimiento)
                                <div class="text-xs text-gray-600 font-medium mt-0.5">
                                    <span class="text-gray-400">Proc:</span> {{ $item->procedimiento }}
                                </div>
                            @endif

                            @if($item->cirujano)
                                <div class="text-xs text-gray-600 font-medium mt-0.5 flex items-center gap-1">
                                    <i data-lucide="stethoscope" class="w-3 h-3 text-gray-400"></i>
                                    {{ $item->cirujano }}
                                </div>
                            @endif

                            @if($item->observaciones)
                                <div class="mt-2 pt-1.5 border-t border-gray-200/60 text-[11px] text-gray-500 italic">
                                    "{{ $item->observaciones }}"
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="py-8 text-center text-gray-400 text-xs italic">
                            Sin reservas automáticas configuradas
                        </div>
                    @endforelse
                </div>

                <div class="p-2 bg-gray-50 border-t border-gray-100 text-center">
                    <button onclick="abrirModalPlantilla({{ $numDia }})" class="text-xs text-[#1B7D8F] font-bold hover:underline flex items-center justify-center gap-1 mx-auto py-1">
                        <i data-lucide="plus-circle" class="w-3.5 h-3.5"></i> Añadir turno en {{ $nombreDia }}
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- MODAL CREAR / EDITAR PLANTILLA -->
<div id="modalPlantilla" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 w-full max-w-lg overflow-hidden transform transition-all">
        
        <div class="bg-gradient-to-r from-[#1B7D8F] to-[#156370] px-6 py-4 flex justify-between items-center text-white">
            <h3 id="modalPlantillaTitle" class="font-bold text-lg flex items-center gap-2">
                <i data-lucide="calendar-plus" class="w-5 h-5"></i>
                <span>Nueva Regla Recurrente</span>
            </h3>
            <button onclick="cerrarModalPlantilla()" class="text-white/80 hover:text-white rounded-lg p-1 hover:bg-white/10 transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="formPlantilla" method="POST" action="{{ route('plantillas-programacion.store') }}" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="_method" id="plantillaMethod" value="POST">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Día de la Semana -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Día de la Semana *</label>
                    <select name="dia_semana" id="planDia" required class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#1B7D8F] focus:border-[#1B7D8F]">
                        <option value="1">Lunes</option>
                        <option value="2">Martes</option>
                        <option value="3">Miércoles</option>
                        <option value="4">Jueves</option>
                        <option value="5">Viernes</option>
                        <option value="6">Sábado</option>
                        <option value="7">Domingo</option>
                    </select>
                </div>

                <!-- Quirófano -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Quirófano *</label>
                    <select name="quirofano" id="planQuirofano" required class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#1B7D8F] focus:border-[#1B7D8F]">
                        @foreach($quirofanosList as $q)
                            <option value="{{ $q }}">{{ $q }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Hora -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Hora Estimada</label>
                    <input type="time" name="hora" id="planHora" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#1B7D8F] focus:border-[#1B7D8F]">
                </div>

                <!-- Especialidad -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Especialidad *</label>
                    <select name="especialidad" id="planEspecialidad" required class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#1B7D8F] focus:border-[#1B7D8F]">
                        <option value="">Seleccionar especialidad...</option>
                        @foreach($especialidades as $esp)
                            <option value="{{ $esp->nombre }}">{{ $esp->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Cirujano -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Cirujano habitual (Opcional)</label>
                    <select name="cirujano" id="planCirujano" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#1B7D8F] focus:border-[#1B7D8F]">
                        <option value="">A definir / Cualquiera</option>
                        @foreach($cirujanos as $cir)
                            <option value="{{ $cir->nombre }} {{ $cir->apellido }}">{{ $cir->apellido }}, {{ $cir->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Procedimiento -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Procedimiento habitual (Opcional)</label>
                    <input type="text" name="procedimiento" id="planProcedimiento" placeholder="Ej: Laparoscopía..." class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#1B7D8F] focus:border-[#1B7D8F]">
                </div>
            </div>

            <!-- Observaciones -->
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Notas / Observaciones</label>
                <textarea name="observaciones" id="planObservaciones" rows="2" placeholder="Información adicional de la reserva..." class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#1B7D8F] focus:border-[#1B7D8F]"></textarea>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <button type="button" onclick="cerrarModalPlantilla()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-xl transition-colors">
                    Cancelar
                </button>
                <button type="submit" class="px-5 py-2 bg-[#1B7D8F] hover:bg-[#156370] text-white text-sm font-bold rounded-xl shadow-md transition-all">
                    Guardar Regla
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function abrirModalPlantilla(diaNum = 1) {
        $('#formPlantilla')[0].reset();
        $('#plantillaMethod').val('POST');
        $('#formPlantilla').attr('action', "{{ route('plantillas-programacion.store') }}");
        $('#modalPlantillaTitle span').text('Nueva Regla Recurrente');
        $('#planDia').val(diaNum);
        $('#modalPlantilla').removeClass('hidden');
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    function cerrarModalPlantilla() {
        $('#modalPlantilla').addClass('hidden');
    }

    function editarPlantilla(item) {
        $('#formPlantilla')[0].reset();
        $('#plantillaMethod').val('PUT');
        $('#formPlantilla').attr('action', "/plantillas-programacion/" + item.id);
        $('#modalPlantillaTitle span').text('Editar Regla Recurrente');

        $('#planDia').val(item.dia_semana);
        $('#planQuirofano').val(item.quirofano);
        $('#planHora').val(item.hora ? item.hora.substring(0, 5) : '');
        $('#planEspecialidad').val(item.especialidad);
        $('#planCirujano').val(item.cirujano || '');
        $('#planProcedimiento').val(item.procedimiento || '');
        $('#planObservaciones').val(item.observaciones || '');

        $('#modalPlantilla').removeClass('hidden');
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }
</script>
@endpush
@endsection
