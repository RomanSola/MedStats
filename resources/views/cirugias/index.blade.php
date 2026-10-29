@extends('layouts.app')
@section('title', 'Gestión de Cirugías')
@section('contenido')
    <div class="w-100" style="padding-left: 0; margin-left: 0;">
        
        @if(session('exito'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center justify-between shadow-sm" id="alertSuccess">
                <div class="flex items-center gap-3">
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600"></i>
                    <span class="font-medium text-sm">{{ session('exito') }}</span>
                </div>
                <button onclick="document.getElementById('alertSuccess').remove()" class="text-emerald-500 hover:text-emerald-800">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl flex items-center justify-between shadow-sm" id="alertSessionError">
                <div class="flex items-center gap-3">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-600"></i>
                    <span class="font-medium text-sm">{{ session('error') }}</span>
                </div>
                <button onclick="document.getElementById('alertSessionError').remove()" class="text-rose-500 hover:text-rose-800">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl shadow-sm" id="alertError">
                <div class="flex items-center gap-3 mb-2">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-600"></i>
                    <span class="font-semibold text-sm">Ocurrieron errores en el formulario. Revisá los campos:</span>
                </div>
                <ul class="list-disc pl-9 text-xs space-y-1 text-rose-700">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Header con Título y Acciones -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-[#1B7D8F]">
                    Gestor de Cirugías
                </h1>
                <p class="text-gray-500 mt-1 text-sm">Administra la programación por quirófanos y el registro histórico de cirugías.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <button onclick="abrirModalProgramacion()"
                        class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-emerald-600/20 transition-all duration-300 transform hover:-translate-y-0.5">
                    <i data-lucide="calendar-plus" class="w-5 h-5"></i>
                    <span>Nueva Programación</span>
                </button>
                <a href="{{ route('cirugias.create') }}"
                   class="flex items-center gap-2 bg-[#1B7D8F] hover:bg-[#156370] text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-[#1B7D8F]/20 transition-all duration-300 transform hover:-translate-y-0.5">
                    <i data-lucide="plus-circle" class="w-5 h-5"></i>
                    <span>Cargar Cirugía Realizada</span>
                </a>
            </div>
        </div>

        <!-- Pestañas de Navegación -->
        <div class="flex border-b border-gray-200 mb-6 bg-white rounded-t-2xl px-4 pt-3 border-x border-t shadow-sm">
            <button id="btnTabProgramacion" onclick="cambiarTab('programacion')"
                    class="py-3 px-6 font-semibold text-sm border-b-2 transition-colors flex items-center gap-2 {{ $activeTab === 'programacion' ? 'border-[#1B7D8F] text-[#1B7D8F]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                <i data-lucide="layout-grid" class="w-4 h-4"></i>
                <span>Programación de Quirófanos</span>
                <span class="bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded-full font-bold ml-1">
                    {{ array_sum(array_map('count', $programaciones)) }}
                </span>
            </button>
            <button id="btnTabHistorico" onclick="cambiarTab('historico')"
                    class="py-3 px-6 font-semibold text-sm border-b-2 transition-colors flex items-center gap-2 {{ $activeTab === 'historico' ? 'border-[#1B7D8F] text-[#1B7D8F]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                <i data-lucide="history" class="w-4 h-4"></i>
                <span>Histórico de Cirugías Realizadas</span>
                <span class="bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded-full font-bold ml-1">
                    {{ $cirugias->count() }}
                </span>
            </button>
        </div>

        <!-- ========================================== -->
        <!-- TAB 1: PROGRAMACIÓN DE QUIRÓFANOS (5 COLUMNAS) -->
        <!-- ========================================== -->
        <div id="contentProgramacion" class="{{ $activeTab === 'programacion' ? '' : 'hidden' }}">
            
            <!-- Barra Superior de Navegación por Fecha -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-4">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha Programada:</label>
                        <form id="formFechaProg" method="GET" action="{{ route('cirugias.index') }}" class="flex items-center gap-2">
                            <input type="hidden" name="tab" value="programacion">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input type="text" id="fechaProgramacionInput" name="fecha_programacion" value="{{ \Carbon\Carbon::parse($fechaProgramacion)->format('d/m/Y') }}" placeholder="dd/mm/aaaa" autocomplete="off"
                                       class="pl-10 pr-3 py-2 bg-gray-50 border border-gray-200 text-gray-700 text-sm font-semibold rounded-xl focus:ring-[#1B7D8F] focus:border-[#1B7D8F] transition-colors cursor-pointer">
                            </div>
                        </form>
                    </div>

                    <!-- Botones de Navegación Rápida & Exportación -->
                    <div class="flex items-center gap-2 w-full md:w-auto justify-end flex-wrap">
                        @php
                            $dateObj = \Carbon\Carbon::parse($fechaProgramacion);
                            $prevDate = $dateObj->copy()->subDay()->format('Y-m-d');
                            $nextDate = $dateObj->copy()->addDay()->format('Y-m-d');
                            $todayDate = \Carbon\Carbon::today()->format('Y-m-d');
                        @endphp
                        <a href="{{ route('cirugias.index', ['tab' => 'programacion', 'fecha' => $prevDate, 'fecha_programacion' => $prevDate]) }}"
                           class="px-3 py-2 bg-gray-50 hover:bg-gray-100 border border-gray-200 text-gray-700 text-xs font-medium rounded-lg transition-colors flex items-center gap-1">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                            Día Anterior
                        </a>
                        <a href="{{ route('cirugias.index', ['tab' => 'programacion', 'fecha' => $todayDate, 'fecha_programacion' => $todayDate]) }}"
                           class="px-4 py-2 {{ $fechaProgramacion === $todayDate ? 'bg-[#1B7D8F] text-white' : 'bg-gray-50 hover:bg-gray-100 text-gray-700 border border-gray-200' }} text-xs font-bold rounded-lg transition-colors">
                            Hoy
                        </a>
                        <a href="{{ route('cirugias.index', ['tab' => 'programacion', 'fecha' => $nextDate, 'fecha_programacion' => $nextDate]) }}"
                           class="px-3 py-2 bg-gray-50 hover:bg-gray-100 border border-gray-200 text-gray-700 text-xs font-medium rounded-lg transition-colors flex items-center gap-1">
                            Día Siguiente
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>

                        <div class="h-5 w-px bg-gray-200 mx-1 hidden sm:block"></div>

                        <!-- Botones de Exportar Programación -->
                        <button type="button" onclick="exportarProgramacionExcel()"
                                class="px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-lg transition-all shadow-xs flex items-center gap-1.5 cursor-pointer"
                                title="Exportar programación a Excel">
                            <i data-lucide="file-spreadsheet" class="w-4 h-4"></i>
                            <span>Excel</span>
                        </button>
                        <button type="button" onclick="exportarProgramacionPDF()"
                                class="px-3 py-2 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-lg transition-all shadow-xs flex items-center gap-1.5 cursor-pointer"
                                title="Exportar programación a PDF">
                            <i data-lucide="file-text" class="w-4 h-4"></i>
                            <span>PDF</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tablero de 4 Columnas de Quirófanos -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                
                @php
                    $quirofanosCols = [
                        'quirofano 1' => ['titulo' => 'Quirófano 1', 'color' => 'border-t-blue-500', 'badge' => 'bg-blue-100 text-blue-800'],
                        'quirofano 2' => ['titulo' => 'Quirófano 2', 'color' => 'border-t-teal-500', 'badge' => 'bg-teal-100 text-teal-800'],
                        'quirofano 3' => ['titulo' => 'Quirófano 3', 'color' => 'border-t-indigo-500', 'badge' => 'bg-indigo-100 text-indigo-800'],
                        'quirofano 4' => ['titulo' => 'Quirófano 4', 'color' => 'border-t-purple-500', 'badge' => 'bg-purple-100 text-purple-800'],
                    ];
                @endphp

                @foreach($quirofanosCols as $key => $colInfo)
                    @php
                        $items = $programaciones[$key] ?? collect();
                    @endphp
                    <div class="bg-white rounded-2xl border border-gray-200 border-t-4 {{ $colInfo['color'] }} shadow-sm flex flex-col min-h-[320px]">
                        
                        <!-- Encabezado Columna Quirófano -->
                        <div class="p-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50 rounded-t-xl">
                            <div class="flex items-center gap-2">
                                <h3 class="font-bold text-gray-800 text-sm tracking-wide">{{ $colInfo['titulo'] }}</h3>
                                <span class="px-2 py-0.5 text-xs font-extrabold rounded-full {{ $colInfo['badge'] }}">
                                    {{ $items->count() }}
                                </span>
                            </div>
                            <button onclick="abrirModalProgramacion('{{ $colInfo['titulo'] }}')" title="Agregar en {{ $colInfo['titulo'] }}"
                                    class="p-1.5 bg-white border border-gray-200 hover:border-[#1B7D8F] text-gray-600 hover:text-[#1B7D8F] rounded-lg transition-all shadow-xs">
                                <i data-lucide="plus" class="w-4 h-4"></i>
                            </button>
                        </div>

                        <!-- Lista de Cirugías Programadas -->
                        <div class="p-3 flex-1 overflow-y-auto space-y-3">
                            @forelse($items as $prog)
                                @php
                                    $limiteEditable = \Carbon\Carbon::parse($prog->fecha)->subDay()->setTime(16, 0, 0);
                                    $esEditable = \Carbon\Carbon::now()->lessThanOrEqualTo($limiteEditable);
                                    $esReserva = $prog->es_reserva || empty(trim($prog->paciente ?? ''));
                                @endphp
                                <div id="prog-card-{{ $prog->id }}" class="p-3.5 rounded-xl border transition-all group relative {{ $prog->realizada ? 'bg-emerald-50/70 border-emerald-300' : ($prog->suspendida ? 'bg-rose-50/70 border-rose-300 opacity-75' : ($esReserva ? 'bg-amber-50/60 border-amber-300 border-dashed shadow-xs hover:shadow-md' : 'bg-gray-50 hover:bg-white border-gray-200/80 hover:border-[#1B7D8F]/50 shadow-xs hover:shadow-md')) }}">
                                    
                                    <!-- Badges: Hora, Estado & Botones de Acción -->
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center gap-1.5 flex-wrap">
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md text-xs font-bold bg-[#1B7D8F]/10 text-[#1B7D8F]">
                                                <i data-lucide="clock" class="w-3 h-3"></i>
                                                {{ $prog->hora ? \Carbon\Carbon::parse($prog->hora)->format('H:i') . ' hs' : 'Sin Hora' }}
                                            </span>
                                            
                                            @if($esReserva)
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[11px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                                    <i data-lucide="bookmark" class="w-3 h-3"></i> Reserva
                                                </span>
                                            @endif

                                            <span id="badge-realizada-{{ $prog->id }}" class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[11px] font-bold bg-emerald-100 text-emerald-800 {{ $prog->realizada ? '' : 'hidden' }}">
                                                <i data-lucide="check-circle-2" class="w-3 h-3"></i> Realizada
                                            </span>
                                            <span id="badge-suspendida-{{ $prog->id }}" class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[11px] font-bold bg-rose-100 text-rose-800 {{ $prog->suspendida ? '' : 'hidden' }}">
                                                <i data-lucide="x-circle" class="w-3 h-3"></i> Suspendida
                                            </span>
                                        </div>
                                        
                                        <div class="flex items-center gap-1 opacity-90 group-hover:opacity-100">
                                            @if($esEditable)
                                                <button onclick='editarProgramacion(@json($prog))' class="p-1 text-gray-400 hover:text-amber-600 rounded hover:bg-amber-50" title="Editar / Asignar Paciente">
                                                    <i data-lucide="edit-2" class="w-3.5 h-3.5"></i>
                                                </button>
                                            @else
                                                <span class="p-1 text-gray-300 cursor-not-allowed" title="Edición/Eliminación vencida (límite 16:00 hs día anterior)">
                                                    <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Paciente -->
                                    <div class="mb-1.5">
                                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Paciente</div>
                                        <div class="font-bold text-gray-900 text-sm flex items-center gap-1">
                                            <i data-lucide="user" class="w-3.5 h-3.5 text-[#1B7D8F]"></i>
                                            @if($esReserva)
                                                <span class="text-amber-700 italic font-medium" id="paciente-text-{{ $prog->id }}">[Turno libre - Sin paciente]</span>
                                            @else
                                                <span class="{{ $prog->suspendida ? 'line-through text-gray-500' : '' }}" id="paciente-text-{{ $prog->id }}">{{ $prog->paciente }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Procedimiento -->
                                    <div class="mb-1.5">
                                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Procedimiento</div>
                                        <div class="text-xs text-gray-800 font-medium line-clamp-2">
                                            {{ $prog->procedimiento ?: 'A definir' }}
                                        </div>
                                        <div class="text-[11px] text-[#1B7D8F] font-semibold mt-0.5">
                                            {{ $prog->especialidad }}
                                        </div>
                                    </div>

                                    <!-- Cirujano -->
                                    <div class="mb-1 text-xs text-gray-600 flex items-center gap-1">
                                        <i data-lucide="stethoscope" class="w-3.5 h-3.5 text-gray-400"></i>
                                        <span class="font-medium text-gray-700">{{ $prog->cirujano ?: 'A definir' }}</span>
                                    </div>

                                    <!-- Observaciones — siempre editable (sin restricción horaria) -->
                                    <div class="mt-2 pt-2 border-t border-gray-200/60">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider flex items-center gap-1">
                                                <i data-lucide="message-square" class="w-3 h-3"></i> Observaciones
                                            </span>
                                            <button type="button"
                                                    onclick="guardarObservaciones({{ $prog->id }}, this)"
                                                    class="obs-save-btn-{{ $prog->id }} hidden text-[10px] px-2 py-0.5 rounded bg-[#1B7D8F] text-white hover:bg-[#165f6e] transition-colors font-medium">
                                                Guardar
                                            </button>
                                        </div>
                                        <textarea
                                            id="obs-textarea-{{ $prog->id }}"
                                            rows="2"
                                            placeholder="Anotar observación o motivo de suspensión…"
                                            oninput="document.querySelector('.obs-save-btn-{{ $prog->id }}').classList.remove('hidden')"
                                            class="w-full text-[11px] text-gray-600 bg-white/70 border border-gray-200 rounded-lg px-2 py-1.5 resize-none focus:outline-none focus:ring-1 focus:ring-[#1B7D8F]/50 focus:border-[#1B7D8F]/50 placeholder-gray-300 leading-relaxed">{{ $prog->observaciones }}</textarea>
                                    </div>

                                    <!-- Auditoría: Registrado / Editado por -->
                                    <div class="mt-2 space-y-0.5">
                                        <div class="flex items-center gap-1 text-[10px] text-gray-400">
                                            <i data-lucide="user-check" class="w-3 h-3 shrink-0"></i>
                                            <span class="text-gray-300">Registrado:</span>
                                            @if($prog->registradoPor)
                                                <span title="Usuario que registró la programación">{{ $prog->registradoPor->name }}</span>
                                            @else
                                                <span class="italic">Sistema / Plantilla</span>
                                            @endif
                                        </div>
                                        @if($prog->editadoPor)
                                            <div id="audit-editado-{{ $prog->id }}" class="flex items-center gap-1 text-[10px] text-amber-500/80">
                                                <i data-lucide="pencil" class="w-3 h-3 shrink-0"></i>
                                                <span class="text-gray-300">Editado:</span>
                                                <span title="Última edición por {{ $prog->editadoPor->name }}">{{ $prog->editadoPor->name }}</span>
                                            </div>
                                        @else
                                            <div id="audit-editado-{{ $prog->id }}" class="hidden flex items-center gap-1 text-[10px] text-amber-500/80">
                                                <i data-lucide="pencil" class="w-3 h-3 shrink-0"></i>
                                                <span class="text-gray-300">Editado:</span>
                                                <span></span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Checkboxes de Acciones: Realizada, Suspendida, Eliminar -->
                                    <div class="mt-3 pt-2.5 border-t border-gray-200/60 flex items-center justify-between gap-2 text-xs bg-white/60 p-1.5 rounded-lg">
                                        <label class="inline-flex items-center gap-1.5 cursor-pointer text-emerald-700 font-medium select-none hover:text-emerald-800">
                                            <input type="checkbox" 
                                                   id="chk-realizada-{{ $prog->id }}"
                                                   onchange="toggleEstadoProgramacion({{ $prog->id }}, 'realizada', this.checked)"
                                                   {{ $prog->realizada ? 'checked' : '' }}
                                                   class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-gray-300">
                                            <span>Realizada</span>
                                        </label>

                                        <label class="inline-flex items-center gap-1.5 cursor-pointer text-rose-700 font-medium select-none hover:text-rose-800">
                                            <input type="checkbox" 
                                                   id="chk-suspendida-{{ $prog->id }}"
                                                   onchange="toggleEstadoProgramacion({{ $prog->id }}, 'suspendida', this.checked)"
                                                   {{ $prog->suspendida ? 'checked' : '' }}
                                                   class="w-4 h-4 rounded text-rose-600 focus:ring-rose-500 border-gray-300">
                                            <span>Suspendida</span>
                                        </label>

                                        @if($esEditable)
                                            <form action="{{ route('programacion.destroy', $prog) }}" method="POST" id="form-delete-{{ $prog->id }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <label class="inline-flex items-center gap-1.5 cursor-pointer text-gray-500 hover:text-rose-600 font-medium select-none">
                                                    <input type="checkbox" 
                                                           onchange="if(this.checked){ confirmarEliminarProgramacion({{ $prog->id }}, this); }"
                                                           class="w-4 h-4 rounded text-rose-600 focus:ring-rose-500 border-gray-300">
                                                    <span>Eliminar</span>
                                                </label>
                                            </form>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 text-gray-400 font-medium select-none cursor-not-allowed" title="Eliminación vencida (límite 16:00 hs día anterior)">
                                                <input type="checkbox" disabled class="w-4 h-4 rounded text-gray-300 border-gray-200 cursor-not-allowed">
                                                <span>Eliminar</span>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="py-6 min-h-[120px] flex flex-col items-center justify-center text-center p-4 text-gray-400 border-2 border-dashed border-gray-100 rounded-xl">
                                    <i data-lucide="calendar-x" class="w-7 h-7 opacity-40 mb-1.5"></i>
                                    <p class="text-xs">Sin programaciones para esta fecha</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 2: HISTÓRICO DE CIRUGÍAS REALIZADAS -->
        <!-- ========================================== -->
        <div id="contentHistorico" class="{{ $activeTab === 'historico' ? '' : 'hidden' }}">
            
            <!-- Tarjeta de Filtros y Controles -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6">
                <div class="flex flex-col lg:flex-row gap-5 justify-between items-end lg:items-center">
                    
                    <!-- Filtros de Fecha -->
                    <div class="flex flex-wrap items-end gap-4 w-full lg:w-auto">
                        <div class="w-full sm:w-auto">
                            <label for="fechaDesde" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Desde</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input type="text" id="fechaDesde" placeholder="dd/mm/aaaa" autocomplete="off"
                                       class="pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-[#1B7D8F] focus:border-[#1B7D8F] block w-full transition-colors cursor-pointer">
                            </div>
                        </div>
                        
                        <div class="w-full sm:w-auto">
                            <label for="fechaHasta" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Hasta</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input type="text" id="fechaHasta" placeholder="dd/mm/aaaa" autocomplete="off"
                                       class="pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-[#1B7D8F] focus:border-[#1B7D8F] block w-full transition-colors cursor-pointer">
                            </div>
                        </div>

                        <div class="w-full sm:w-auto min-w-[200px]">
                            <label for="filtroEspecialidad" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Especialidad</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <i data-lucide="activity" class="w-4 h-4"></i>
                                </div>
                                <select id="filtroEspecialidad" 
                                        class="pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-[#1B7D8F] focus:border-[#1B7D8F] block w-full transition-colors">
                                    <option value="">Todas las especialidades</option>
                                    @foreach($especialidades as $esp)
                                        <option value="{{ $esp->id }}">{{ $esp->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button id="limpiarFechas" 
                                class="px-4 py-2 bg-white border border-gray-200 text-gray-600 text-sm font-medium rounded-lg hover:bg-gray-50 hover:text-[#1B7D8F] hover:border-[#1B7D8F] transition-all flex items-center gap-2 h-[38px]">
                            <i data-lucide="x" class="w-4 h-4"></i>
                            Limpiar
                        </button>
                    </div>

                    <!-- Buscador Global -->
                    <div class="w-full lg:w-72">
                        <label for="customSearch" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Buscar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i data-lucide="search" class="w-4 h-4"></i>
                            </div>
                            <input type="text" id="customSearch" placeholder="Paciente, DNI, Cirujano..." 
                                   class="pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-[#1B7D8F] focus:border-[#1B7D8F] block w-full transition-colors">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de Resultados Realizados -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table id="miTabla" class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Fecha</th>
                                <th class="px-6 py-3 font-semibold">Hora</th>
                                <th class="px-6 py-3 font-semibold">N°Q</th>
                                <th class="px-6 py-3 font-semibold">Edad</th>
                                <th class="px-6 py-3 font-semibold">DNI</th>
                                <th class="px-6 py-3 font-semibold">Paciente</th>
                                <th class="px-6 py-3 font-semibold">Procedimiento</th>
                                <th class="px-6 py-3 font-semibold">Cirujano</th>
                                <th class="px-6 py-3 font-semibold no-print">Ayudante 1</th>
                                <th class="px-6 py-3 font-semibold no-print">Ayudante 2</th>
                                <th class="px-6 py-3 font-semibold">Anestesiologo</th>
                                <th class="px-6 py-3 font-semibold">Instrumentador</th>                            
                                <th class="px-6 py-3 font-semibold">Enfermero</th>
                                <th class="px-6 py-3 font-semibold">Anestesia</th>                                  
                                <th class="px-6 py-3 font-semibold no-print">Urgencia</th>
                                <th class="px-6 py-3 font-semibold no-print">Óbito</th>
                                <th class="px-6 py-3 font-semibold text-center no-print">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($cirugias as $cirugia)
                                <tr class="{{ $cirugia->suspendida ? 'bg-gray-200 text-gray-500 hover:bg-gray-250 opacity-75' : 'hover:bg-gray-50 transition-colors' }}" data-especialidad-id="{{ $cirugia->especialidad_id }}">
                                    <td class="px-6 py-4 font-medium {{ $cirugia->suspendida ? 'text-gray-600' : 'text-gray-900' }} whitespace-nowrap" data-fecha="{{ $cirugia->fecha_cirugia }}" data-order="{{ $cirugia->fecha_cirugia }} {{ $cirugia->hora_cirugia ?? '00:00' }}">
                                        {{ \Carbon\Carbon::parse($cirugia->fecha_cirugia)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4">{{ $cirugia->hora_cirugia ?? '' }}</td>
                                    <td class="px-6 py-4">{{ $cirugia->get_quirofano->nombre ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        {{ optional($cirugia->get_paciente)->fecha_nacimiento
                                            ? \Carbon\Carbon::parse($cirugia->get_paciente->fecha_nacimiento)->age
                                            : '—' }}
                                    </td>
                                    <td class="px-6 py-4 font-mono text-xs">{{ optional($cirugia->get_paciente)->dni ?? '-' }}</td>
                                    <td class="px-6 py-4 font-medium {{ $cirugia->suspendida ? 'text-gray-700' : 'text-[#1B7D8F]' }}">{{ optional($cirugia->get_paciente)->nombre }} {{ optional($cirugia->get_paciente)->apellido }}</td>
                                    <td class="px-6 py-4">
                                        <div>{{ optional($cirugia->get_procedimiento)->nombre_procedimiento }}</div>
                                        @if($cirugia->get_especialidad)
                                            <div class="text-xs text-gray-400 font-normal">{{ $cirugia->get_especialidad->nombre }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">{{ optional($cirugia->get_cirujano)->nombre }} {{ optional($cirugia->get_cirujano)->apellido }}</td>
                                    <td class="px-6 py-4 no-print">{{ optional($cirugia->get_ayudante1)->nombre ?? '-' }} {{ optional($cirugia->get_ayudante1)->apellido ?? '' }}</td>
                                    <td class="px-6 py-4 no-print">{{ optional($cirugia->get_ayudante2)->nombre ?? '-' }} {{ optional($cirugia->get_ayudante2)->apellido ?? '' }}</td>
                                    <td class="px-6 py-4">{{ optional($cirugia->get_anestesista)->nombre }} {{ optional($cirugia->get_anestesista)->apellido }}</td>
                                    <td class="px-6 py-4">{{ optional($cirugia->get_instrumentador)->nombre }} {{ optional($cirugia->get_instrumentador)->apellido }}</td>                                          
                                    <td class="px-6 py-4">{{ optional($cirugia->get_enfermero)->nombre }} {{ optional($cirugia->get_enfermero)->apellido }}</td> 
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-medium {{ $cirugia->suspendida ? 'bg-gray-300 text-gray-700' : 'bg-blue-50 text-blue-600' }} rounded-full">
                                            {{ optional($cirugia->get_tipo_anestesia)->nombre ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 no-print">
                                        @if($cirugia->urgencia)
                                            <span class="px-2 py-1 text-xs font-medium {{ $cirugia->suspendida ? 'bg-gray-300 text-gray-700' : 'bg-red-50 text-red-600' }} rounded-full">Sí</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-medium {{ $cirugia->suspendida ? 'bg-gray-300 text-gray-700' : 'bg-green-50 text-green-600' }} rounded-full">No</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 no-print">
                                        @if($cirugia->obito)
                                            <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-600 rounded-full">Sí</span>
                                        @else
                                            <span class="text-gray-300">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center no-print">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('cirugias.show', $cirugia) }}"
                                               class="p-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors" title="Ver Detalles">
                                                <i data-lucide="eye" class="w-4 h-4"></i>
                                            </a>
                                            <a href="{{ route('cirugias.medicamentos', $cirugia) }}"
                                               class="p-1.5 bg-[#e6f4f3] text-[#1B7D8F] rounded-lg hover:bg-[#cdeceb] transition-colors" title="Cargar Medicamentos">
                                                <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                                            </a>
                                            <a href="{{ route('cirugias.edit', $cirugia) }}"
                                               class="p-1.5 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-100 transition-colors" title="Editar">
                                                <i data-lucide="edit-2" class="w-4 h-4"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="17" class="px-6 py-12 text-center text-gray-400">
                                        <div class="flex flex-col items-center justify-center gap-3">
                                            <i data-lucide="inbox" class="w-10 h-10 opacity-50"></i>
                                            <p>No hay cirugías registradas aún.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-between items-center">
                    <div class="text-xs text-gray-500" id="tableInfo"></div>
                    <div id="tablePagination"></div>
                </div>
            </div>

            <!-- Botones de Acción de Exportación -->
            <div class="mt-6 flex flex-wrap gap-3 justify-start">
                <button onclick="imprimirTablaCompleta()" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 hover:text-[#1B7D8F] transition-all shadow-sm">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                    <span>Imprimir Tabla</span>
                </button>
                <button onclick="exportarFiltradoPDF()" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-red-600 rounded-xl hover:bg-red-50 transition-all shadow-sm">
                    <i data-lucide="file-text" class="w-4 h-4"></i>
                    <span>Exportar PDF</span>
                </button>
                <button id="btnExportarExcel" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-green-600 rounded-xl hover:bg-green-50 transition-all shadow-sm">
                    <i data-lucide="sheet" class="w-4 h-4"></i>
                    <span>Exportar Excel</span>
                </button>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- MODAL PARA NUEVA / EDITAR PROGRAMACIÓN -->
    <!-- ========================================== -->
    <div id="modalProgramacion" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 w-full max-w-xl overflow-hidden transform transition-all">
            
            <div class="bg-gradient-to-r from-[#1B7D8F] to-[#156370] px-6 py-4 flex justify-between items-center text-white">
                <h3 id="modalTitle" class="font-bold text-lg flex items-center gap-2">
                    <i data-lucide="calendar-plus" class="w-5 h-5"></i>
                    <span>Nueva Programación de Cirugía</span>
                </h3>
                <button onclick="cerrarModalProgramacion()" class="text-white/80 hover:text-white rounded-lg p-1 hover:bg-white/10 transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form id="formProgramacion" method="POST" action="{{ route('programacion.store') }}" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="programacion_id" id="progId" value="">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Fecha -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Fecha *</label>
                        <input type="date" name="fecha" id="progFecha" value="{{ $fechaProgramacion }}" required
                               class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#1B7D8F] focus:border-[#1B7D8F]">
                    </div>

                    <!-- Quirófano -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Quirófano *</label>
                        <select name="quirofano" id="progQuirofano" required
                                class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#1B7D8F] focus:border-[#1B7D8F]">
                            <option value="Quirófano 1">Quirófano 1</option>
                            <option value="Quirófano 2">Quirófano 2</option>
                            <option value="Quirófano 3">Quirófano 3</option>
                            <option value="Quirófano 4">Quirófano 4</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Hora -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Hora Estimada</label>
                        <input type="time" name="hora" id="progHora"
                               class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#1B7D8F] focus:border-[#1B7D8F]">
                    </div>

                    <!-- Paciente (Selección de cargados o texto manual) -->
                    <div class="relative custom-dropdown-container">
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Paciente</label>
                            <span class="text-[11px] text-amber-600 font-semibold">(Opcional: Dejar en blanco para reservar turno)</span>
                        </div>
                        <div class="relative">
                            <input type="text" name="paciente" id="progPaciente" placeholder="Seleccionar o escribir (Opcional)..." autocomplete="off"
                                   class="w-full px-3 py-2 pr-8 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#1B7D8F] focus:border-[#1B7D8F] cursor-pointer">
                            <div class="absolute inset-y-0 right-0 pr-2.5 flex items-center pointer-events-none text-gray-400">
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </div>
                        </div>
                        <div id="dropPacientes" class="hidden absolute z-30 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-xl max-h-48 overflow-y-auto divide-y divide-gray-50">
                            @foreach($pacientes as $pac)
                                <div class="option-item px-3 py-2.5 hover:bg-[#1B7D8F]/10 hover:text-[#1B7D8F] text-sm text-gray-700 cursor-pointer transition-colors" data-value="{{ trim($pac->apellido . ' ' . $pac->nombre) }}">
                                    <span class="font-medium">{{ $pac->apellido }}, {{ $pac->nombre }}</span>
                                    @if($pac->dni)
                                        <span class="text-xs text-gray-400 ml-1">(DNI: {{ $pac->dni }})</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Especialidad -->
                    <div class="relative custom-dropdown-container">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Especialidad *</label>
                        <div class="relative">
                            <input type="text" name="especialidad" id="progEspecialidad" placeholder="Escriba o seleccione especialidad..." required autocomplete="off"
                                   class="w-full px-3 py-2 pr-8 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#1B7D8F] focus:border-[#1B7D8F] cursor-pointer">
                            <div class="absolute inset-y-0 right-0 pr-2.5 flex items-center pointer-events-none text-gray-400">
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </div>
                        </div>
                        <div id="dropEspecialidades" class="hidden absolute z-30 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-xl max-h-48 overflow-y-auto divide-y divide-gray-50">
                            @foreach($especialidades as $esp)
                                <div class="option-item px-3 py-2.5 hover:bg-[#1B7D8F]/10 hover:text-[#1B7D8F] text-sm text-gray-700 cursor-pointer transition-colors" data-value="{{ $esp->nombre }}">
                                    {{ $esp->nombre }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Cirujano -->
                    <div class="relative custom-dropdown-container">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Cirujano</label>
                        <div class="relative">
                            <input type="text" name="cirujano" id="progCirujano" placeholder="Escriba o seleccione cirujano..." autocomplete="off"
                                   class="w-full px-3 py-2 pr-8 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#1B7D8F] focus:border-[#1B7D8F] cursor-pointer">
                            <div class="absolute inset-y-0 right-0 pr-2.5 flex items-center pointer-events-none text-gray-400">
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </div>
                        </div>
                        <div id="dropCirujanos" class="hidden absolute z-30 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-xl max-h-48 overflow-y-auto divide-y divide-gray-50">
                            @foreach($cirujanos as $cir)
                                <div class="option-item px-3 py-2.5 hover:bg-[#1B7D8F]/10 hover:text-[#1B7D8F] text-sm text-gray-700 cursor-pointer transition-colors" data-value="{{ $cir->nombre }} {{ $cir->apellido }}">
                                    {{ $cir->apellido }}, {{ $cir->nombre }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Procedimiento / Cirugía -->
                <div class="relative custom-dropdown-container">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Procedimiento / Cirugía</label>
                    <div class="relative">
                        <input type="text" name="procedimiento" id="progProcedimiento" placeholder="Escriba o seleccione procedimiento..." autocomplete="off"
                               class="w-full px-3 py-2 pr-8 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#1B7D8F] focus:border-[#1B7D8F] cursor-pointer">
                        <div class="absolute inset-y-0 right-0 pr-2.5 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                    <div id="dropProcedimientos" class="hidden absolute z-30 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-xl max-h-48 overflow-y-auto divide-y divide-gray-50">
                        <!-- Populated dynamically via JS -->
                    </div>
                </div>

                <!-- Observaciones -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Observaciones</label>
                    <textarea name="observaciones" id="progObservaciones" rows="2" placeholder="Detalles de preparación, equipo requerido u observaciones adicionales..."
                              class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#1B7D8F] focus:border-[#1B7D8F]"></textarea>
                </div>

                <!-- Estado de la cirugía (Opcionales) -->
                <div class="p-3 bg-gray-50 border border-gray-200 rounded-xl flex items-center gap-6">
                    <span class="text-xs font-bold text-gray-700 uppercase tracking-wider">Estado:</span>
                    <label class="inline-flex items-center gap-2 text-sm font-medium text-emerald-700 cursor-pointer select-none">
                        <input type="checkbox" name="realizada" id="modalProgRealizada" value="1"
                               onchange="if(this.checked){ document.getElementById('modalProgSuspendida').checked = false; }"
                               class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-gray-300">
                        <span>Realizada</span>
                    </label>
                    <label class="inline-flex items-center gap-2 text-sm font-medium text-rose-700 cursor-pointer select-none">
                        <input type="checkbox" name="suspendida" id="modalProgSuspendida" value="1"
                               onchange="if(this.checked){ document.getElementById('modalProgRealizada').checked = false; }"
                               class="w-4 h-4 rounded text-rose-600 focus:ring-rose-500 border-gray-300">
                        <span>Suspendida</span>
                    </label>
                </div>

                <div class="pt-3 border-t border-gray-100 flex justify-end gap-3">
                    <button type="button" onclick="cerrarModalProgramacion()"
                            class="px-4 py-2 border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-50 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-6 py-2 bg-[#1B7D8F] hover:bg-[#156370] text-white text-sm font-bold rounded-xl shadow-md transition-colors flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        <span>Guardar Programación</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .card, .shadow-sm { box-shadow: none !important; border: none !important; }
        }
        .dataTables_wrapper .dataTables_length, 
        .dataTables_wrapper .dataTables_filter { display: none !important; }
        
        table.dataTable.no-footer { border-bottom: none !important; }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #1B7D8F !important;
            color: white !important;
            border: none !important;
            border-radius: 0.5rem !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #e5e7eb !important;
            color: #374151 !important;
            border: none !important;
            border-radius: 0.5rem !important;
        }
    </style>
@endsection

@push('scripts')
    <!-- jsPDF y autoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- SheetJS para generar archivos Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    
    <script>
        function cambiarTab(tab) {
            if (tab === 'programacion') {
                $('#contentProgramacion').removeClass('hidden');
                $('#contentHistorico').addClass('hidden');
                $('#btnTabProgramacion').addClass('border-[#1B7D8F] text-[#1B7D8F]').removeClass('border-transparent text-gray-500');
                $('#btnTabHistorico').removeClass('border-[#1B7D8F] text-[#1B7D8F]').addClass('border-transparent text-gray-500');
            } else {
                $('#contentHistorico').removeClass('hidden');
                $('#contentProgramacion').addClass('hidden');
                $('#btnTabHistorico').addClass('border-[#1B7D8F] text-[#1B7D8F]').removeClass('border-transparent text-gray-500');
                $('#btnTabProgramacion').removeClass('border-[#1B7D8F] text-[#1B7D8F]').addClass('border-transparent text-gray-500');
            }
        }

        const todosLosProcedimientos = [
            @foreach($procedimientos as $proc)
                {
                    nombre: @json($proc->nombre_procedimiento),
                    especialidad: @json(optional($proc->get_especialidad)->nombre ?? '')
                },
            @endforeach
        ];

        function renderDropdownProcedimientos() {
            const espSeleccionada = $('#progEspecialidad').val().trim().toLowerCase();
            const $drop = $('#dropProcedimientos');
            $drop.empty();

            const procsFiltrados = todosLosProcedimientos.filter(p => {
                if (!espSeleccionada) return true;
                return p.especialidad.toLowerCase() === espSeleccionada;
            });

            const aMostrar = procsFiltrados.length > 0 ? procsFiltrados : todosLosProcedimientos;

            if (aMostrar.length === 0) {
                $drop.append(`<div class="px-3 py-2 text-xs text-gray-400">No hay procedimientos disponibles</div>`);
                return;
            }

            aMostrar.forEach(p => {
                const label = p.especialidad ? `${p.nombre} <span class="text-xs text-gray-400">(${p.especialidad})</span>` : p.nombre;
                $drop.append(`
                    <div class="option-item px-3 py-2.5 hover:bg-[#1B7D8F]/10 hover:text-[#1B7D8F] text-sm text-gray-700 cursor-pointer transition-colors" data-value="${p.nombre}">
                        ${label}
                    </div>
                `);
            });
        }

        // Eventos para desplegables personalizados
        $(document).on('focus click', '.custom-dropdown-container input', function(e) {
            e.stopPropagation();
            $('.custom-dropdown-container div[id^="drop"]').addClass('hidden');
            const $container = $(this).closest('.custom-dropdown-container');
            const $drop = $container.find('div[id^="drop"]');
            
            if (this.id === 'progProcedimiento') {
                renderDropdownProcedimientos();
            }
            
            $drop.removeClass('hidden');
            // Filtrar las opciones según el valor actual del input
            const query = $(this).val().trim().toLowerCase();
            $drop.find('.option-item').each(function() {
                const text = $(this).text().toLowerCase();
                const val = ($(this).data('value') || '').toString().toLowerCase();
                if (text.includes(query) || val.includes(query)) {
                    $(this).removeClass('hidden');
                } else {
                    $(this).addClass('hidden');
                }
            });
        });

        $(document).on('input keyup', '.custom-dropdown-container input', function() {
            const query = $(this).val().trim().toLowerCase();
            const $container = $(this).closest('.custom-dropdown-container');
            const $drop = $container.find('div[id^="drop"]');
            $drop.removeClass('hidden');

            if (this.id === 'progEspecialidad') {
                renderDropdownProcedimientos();
            }

            $drop.find('.option-item').each(function() {
                const text = $(this).text().toLowerCase();
                const val = ($(this).data('value') || '').toString().toLowerCase();
                if (text.includes(query) || val.includes(query)) {
                    $(this).removeClass('hidden');
                } else {
                    $(this).addClass('hidden');
                }
            });
        });

        $(document).on('click', '.custom-dropdown-container .option-item', function(e) {
            e.stopPropagation();
            const val = $(this).data('value');
            const $container = $(this).closest('.custom-dropdown-container');
            const $input = $container.find('input');
            $input.val(val);
            $container.find('div[id^="drop"]').addClass('hidden');

            if ($input.attr('id') === 'progEspecialidad') {
                renderDropdownProcedimientos();
            }
        });

        $(document).on('click', function() {
            $('.custom-dropdown-container div[id^="drop"]').addClass('hidden');
        });

        function abrirModalProgramacion(quirofanoNombre = '') {
            $('#formProgramacion')[0].reset();
            $('#formMethod').val('POST');
            $('#progId').val('');
            $('#modalProgRealizada').prop('checked', false);
            $('#modalProgSuspendida').prop('checked', false);
            $('#formProgramacion').attr('action', "{{ route('programacion.store') }}");
            $('#modalTitle span').text('Nueva Programación de Cirugía');

            // Convertir la fecha visible (dd/mm/aaaa) al formato ISO (yyyy-mm-dd)
            // que requiere <input type="date">. El fallback PHP ya viene en formato ISO.
            const rawFecha = $('#fechaProgramacionInput').val();
            let fechaISO = "{{ $fechaProgramacion }}";
            if (rawFecha && rawFecha.includes('/')) {
                const parts = rawFecha.split('/');
                if (parts.length === 3) {
                    fechaISO = `${parts[2]}-${parts[1].padStart(2, '0')}-${parts[0].padStart(2, '0')}`;
                }
            }
            $('#progFecha').val(fechaISO);

            if (quirofanoNombre) {
                $('#progQuirofano').val(quirofanoNombre);
            }

            renderDropdownProcedimientos();

            $('#modalProgramacion').removeClass('hidden');
            if (typeof lucide !== 'undefined') lucide.createIcons();
        }

        function editarProgramacion(prog) {
            $('#formProgramacion')[0].reset();
            $('#formMethod').val('PUT');
            $('#progId').val(prog.id);
            $('#formProgramacion').attr('action', "/programacion/" + prog.id);
            $('#modalTitle span').text('Editar Programación de Cirugía');

            $('#progFecha').val(prog.fecha);
            $('#progQuirofano').val(prog.quirofano);
            $('#progHora').val(prog.hora ? prog.hora.substring(0, 5) : '');
            $('#progPaciente').val(prog.paciente);
            $('#progEspecialidad').val(prog.especialidad);
            $('#progProcedimiento').val(prog.procedimiento);
            $('#progCirujano').val(prog.cirujano);
            $('#progObservaciones').val(prog.observaciones || '');
            $('#modalProgRealizada').prop('checked', !!prog.realizada);
            $('#modalProgSuspendida').prop('checked', !!prog.suspendida);

            renderDropdownProcedimientos();

            $('#modalProgramacion').removeClass('hidden');
            if (typeof lucide !== 'undefined') lucide.createIcons();
        }

        function toggleEstadoProgramacion(id, campo, checked) {
            $.ajax({
                url: `/programacion/${id}/toggle-estado`,
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    campo: campo,
                    valor: checked ? 1 : 0
                },
                success: function(res) {
                    if (res.success) {
                        const $card = $(`#prog-card-${id}`);
                        const $chkRealizada = $(`#chk-realizada-${id}`);
                        const $chkSuspendida = $(`#chk-suspendida-${id}`);
                        const $badgeRealizada = $(`#badge-realizada-${id}`);
                        const $badgeSuspendida = $(`#badge-suspendida-${id}`);
                        const $pacienteText = $(`#paciente-text-${id}`);

                        $chkRealizada.prop('checked', res.realizada);
                        $chkSuspendida.prop('checked', res.suspendida);

                        if (res.realizada) {
                            $badgeRealizada.removeClass('hidden');
                            $badgeSuspendida.addClass('hidden');
                            $card.removeClass('bg-gray-50 bg-rose-50/70 border-gray-200/80 border-rose-300 opacity-75')
                                 .addClass('bg-emerald-50/70 border-emerald-300');
                            $pacienteText.removeClass('line-through text-gray-500');
                        } else if (res.suspendida) {
                            $badgeSuspendida.removeClass('hidden');
                            $badgeRealizada.addClass('hidden');
                            $card.removeClass('bg-gray-50 bg-emerald-50/70 border-gray-200/80 border-emerald-300')
                                 .addClass('bg-rose-50/70 border-rose-300 opacity-75');
                            $pacienteText.addClass('line-through text-gray-500');
                        } else {
                            $badgeRealizada.addClass('hidden');
                            $badgeSuspendida.addClass('hidden');
                            $card.removeClass('bg-emerald-50/70 border-emerald-300 bg-rose-50/70 border-rose-300 opacity-75')
                                 .addClass('bg-gray-50 hover:bg-white border-gray-200/80 hover:border-[#1B7D8F]/50');
                            $pacienteText.removeClass('line-through text-gray-500');
                        }

                        if (typeof lucide !== 'undefined') lucide.createIcons();
                    }
                },
                error: function() {
                    alert('Ocurrió un error al actualizar el estado de la programación.');
                    location.reload();
                }
            });
        }

        function confirmarEliminarProgramacion(id, checkbox) {
            if (confirm('¿Estás seguro de que deseas eliminar esta programación de cirugía?')) {
                document.getElementById(`form-delete-${id}`).submit();
            } else {
                checkbox.checked = false;
            }
        }

        function guardarObservaciones(id, btn) {
            const texto = document.getElementById(`obs-textarea-${id}`).value;
            btn.disabled = true;
            btn.textContent = 'Guardando…';

            $.ajax({
                url: `/programacion/${id}/observaciones`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'PATCH',
                    observaciones: texto,
                },
                success: function(res) {
                    // Actualizar el bloque "Editado por" en la tarjeta
                    const auditDiv = document.getElementById(`audit-editado-${id}`);
                    if (auditDiv) {
                        auditDiv.querySelector('span:last-child').textContent = res.editor_name;
                        auditDiv.title = `Última edición por ${res.editor_name}`;
                        auditDiv.classList.remove('hidden');
                        lucide.createIcons({ nodes: [auditDiv] });
                    }

                    btn.textContent = '✓ Guardado';
                    btn.classList.remove('bg-[#1B7D8F]', 'hover:bg-[#165f6e]');
                    btn.classList.add('bg-emerald-600');
                    setTimeout(() => {
                        btn.classList.add('hidden');
                        btn.classList.remove('bg-emerald-600');
                        btn.classList.add('bg-[#1B7D8F]', 'hover:bg-[#165f6e]');
                        btn.textContent = 'Guardar';
                        btn.disabled = false;
                    }, 2000);
                },
                error: function() {
                    btn.textContent = '✗ Error';
                    btn.classList.add('bg-rose-600');
                    setTimeout(() => {
                        btn.classList.remove('bg-rose-600');
                        btn.textContent = 'Guardar';
                        btn.disabled = false;
                    }, 2500);
                }
            });
        }

        function cerrarModalProgramacion() {
            $('#modalProgramacion').addClass('hidden');
        }

        $(document).ready(function() {
            // Inicializar DataTables para el histórico
            const table = $('#miTabla').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                },
                "order": [[0, "desc"]],
                "pageLength": 10,
                "dom": 'rtip',
                "drawCallback": function(settings) {
                    const api  = this.api();
                    const info = api.page.info();

                    // Texto de resultados — usa recordsDisplay (con filtros aplicados)
                    if (info.recordsDisplay === 0) {
                        $('#tableInfo').html('Sin resultados');
                    } else {
                        const desde = info.start + 1;
                        const hasta = info.end;
                        const total = info.recordsDisplay;
                        const totalSinFiltro = info.recordsTotal;
                        const filtrado = total < totalSinFiltro
                            ? ` <span class="text-[#1B7D8F] font-semibold">(filtrado de ${totalSinFiltro})</span>`
                            : '';
                        $('#tableInfo').html(`Mostrando ${desde}–${hasta} de ${total} registros${filtrado}`);
                    }

                    // Mover el paginador nativo al contenedor personalizado
                    const $paginator = $('.dataTables_paginate');
                    if ($paginator.length) {
                        $('#tablePagination').empty().append($paginator);
                    }

                    if (typeof lucide !== 'undefined') lucide.createIcons();
                }
            });

            $('#customSearch').on('keyup', function() {
                table.search(this.value).draw();
            });

            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                const desde = $('#fechaDesde').val();
                const hasta = $('#fechaHasta').val();
                const especialidadId = $('#filtroEspecialidad').val();
                
                const row = table.row(dataIndex).node();
                const fechaRow = $(row).find('td[data-fecha]').attr('data-fecha');
                const rowEspecialidadId = $(row).attr('data-especialidad-id');

                if (especialidadId && rowEspecialidadId != especialidadId) {
                    return false;
                }

                if (desde && fechaRow < desde) return false;
                if (hasta && fechaRow > hasta) return false;

                return true;
            });

            $('#fechaDesde, #fechaHasta, #filtroEspecialidad').on('change', function() {
                table.draw();
            });

            $('#limpiarFechas').on('click', function() {
                fpDesde.clear();
                fpHasta.clear();
                $('#filtroEspecialidad').val('');
                $('#customSearch').val('');
                table.search('').draw();
            });
        });

        function imprimirTablaCompleta() {
            window.print();
        }

        function exportarFiltradoPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('l', 'mm', 'a4');
            const tablaDT = $('#miTabla').DataTable();
            const datos = tablaDT.rows({ search: 'applied' }).data().toArray();

            const headers = [["Fecha", "Hora", "N°Q", "Paciente", "DNI", "Procedimiento", "Cirujano", "Anestesiologo", "Anestesia"]];
            const body = [];

            datos.forEach(value => {
                const clean = (html) => {
                    const tmp = document.createElement("DIV");
                    tmp.innerHTML = html;
                    return tmp.textContent || tmp.innerText || "";
                }

                body.push([
                    clean(value[0]),
                    clean(value[1]),
                    clean(value[2]),
                    clean(value[5]),
                    clean(value[4]),
                    clean(value[6]),
                    clean(value[7]),
                    clean(value[10]),
                    clean(value[13])
                ]);
            });

            doc.text("Reporte de Cirugías", 14, 20);
            doc.autoTable({
                head: headers,
                body: body,
                startY: 30,
                theme: 'grid',
                styles: { fontSize: 8, cellPadding: 2 },
                headStyles: { fillColor: [27, 125, 143] }
            });
            doc.save('cirugias_filtradas.pdf');
        }

        document.getElementById('btnExportarExcel').addEventListener('click', function() {
            const tablaDT = $('#miTabla').DataTable();
            const datos = tablaDT.rows({ search: 'applied' }).data().toArray();
            
            const clean = (html) => {
                const tmp = document.createElement("DIV");
                tmp.innerHTML = html;
                return tmp.textContent || tmp.innerText || "";
            }

            const dataExport = datos.map(row => ({
                Fecha: clean(row[0]),
                Hora: clean(row[1]),
                Quirofano: clean(row[2]),
                Edad: clean(row[3]),
                DNI: clean(row[4]),
                Paciente: clean(row[5]),
                Procedimiento: clean(row[6]),
                Cirujano: clean(row[7]),
                Anestesiologo: clean(row[10]),
                Instrumentador: clean(row[11]),
                Enfermero: clean(row[12]),
                Anestesia: clean(row[13]),
                Urgencia: clean(row[14]),
                Obito: clean(row[15])
            }));

            const ws = XLSX.utils.json_to_sheet(dataExport);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Cirugias");
            XLSX.writeFile(wb, "reporte_cirugias.xlsx");
        });

        // ==============================================
        // EXPORTACIÓN DE PROGRAMACIÓN (PDF Y EXCEL)
        // ==============================================
        function obtenerDatosProgramacion() {
            const fechaStr = $('#fechaProgramacionInput').val() || "{{ $fechaProgramacion }}";
            const programacionesObj = @json($programaciones);
            const datos = [];

            if (programacionesObj && typeof programacionesObj === 'object') {
                Object.values(programacionesObj).forEach(collectionOrArray => {
                    const list = Array.isArray(collectionOrArray) 
                        ? collectionOrArray 
                        : (collectionOrArray ? Object.values(collectionOrArray) : []);
                    
                    list.forEach(prog => {
                        let estadoStr = 'Pendiente';
                        if (prog.realizada) estadoStr = 'Realizada';
                        else if (prog.suspendida) estadoStr = 'Suspendida';

                        datos.push({
                            fecha: prog.fecha,
                            quirofano: prog.quirofano,
                            hora: prog.hora ? prog.hora.substring(0, 5) + ' hs' : 'Sin hora',
                            paciente: prog.paciente,
                            especialidad: prog.especialidad,
                            procedimiento: prog.procedimiento,
                            cirujano: prog.cirujano,
                            estado: estadoStr,
                            observaciones: prog.observaciones || ''
                        });
                    });
                });
            }

            return { fechaStr, datos };
        }

        window.exportarProgramacionPDF = function() {
            const { fechaStr, datos } = obtenerDatosProgramacion();
            if (datos.length === 0) {
                alert('No hay cirugías programadas para exportar en esta fecha.');
                return;
            }
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('l', 'mm', 'a4');

            const headers = [["Quirófano", "Hora", "Paciente", "Especialidad", "Procedimiento", "Cirujano", "Estado", "Observaciones"]];
            const body = datos.map(d => [
                d.quirofano,
                d.hora,
                d.paciente,
                d.especialidad,
                d.procedimiento,
                d.cirujano,
                d.estado,
                d.observaciones
            ]);

            doc.setFontSize(16);
            doc.setTextColor(27, 125, 143);
            doc.text("Programación de Cirugías - Fecha: " + fechaStr, 14, 15);
            doc.setFontSize(10);
            doc.setTextColor(100);
            doc.text("Total de cirugías programadas: " + datos.length, 14, 22);

            doc.autoTable({
                head: headers,
                body: body,
                startY: 27,
                theme: 'grid',
                styles: { fontSize: 8, cellPadding: 2.5 },
                headStyles: { fillColor: [27, 125, 143], textColor: 255, fontStyle: 'bold' },
                alternateRowStyles: { fillColor: [248, 250, 252] },
                didParseCell: function(data) {
                    if (data.section === 'body' && data.column.index === 6) {
                        const val = data.cell.raw;
                        if (val === 'Realizada') {
                            data.cell.styles.textColor = [16, 185, 129];
                            data.cell.styles.fontStyle = 'bold';
                        } else if (val === 'Suspendida') {
                            data.cell.styles.textColor = [239, 68, 68];
                            data.cell.styles.fontStyle = 'bold';
                        }
                    }
                }
            });

            doc.save(`programacion_cirugias_${fechaStr}.pdf`);
        };

        window.exportarProgramacionExcel = function() {
            const { fechaStr, datos } = obtenerDatosProgramacion();
            if (datos.length === 0) {
                alert('No hay cirugías programadas para exportar en esta fecha.');
                return;
            }

            const dataExport = datos.map(d => ({
                "Fecha": d.fecha,
                "Quirófano": d.quirofano,
                "Hora": d.hora,
                "Paciente": d.paciente,
                "Especialidad": d.especialidad,
                "Procedimiento": d.procedimiento,
                "Cirujano": d.cirujano,
                "Estado": d.estado,
                "Observaciones": d.observaciones
            }));

            const ws = XLSX.utils.json_to_sheet(dataExport);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Programación");
            XLSX.writeFile(wb, `programacion_cirugias_${fechaStr}.xlsx`);
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <script>
        $(document).ready(function() {
            flatpickr.localize(flatpickr.l10ns.es);

            const fpProg = flatpickr("#fechaProgramacionInput", {
                dateFormat: "d/m/Y",
                allowInput: true,
                clickOpens: true,
                defaultDate: "{{ \Carbon\Carbon::parse($fechaProgramacion)->format('d/m/Y') }}",
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length > 0) {
                        const yyyy = selectedDates[0].getFullYear();
                        const mm = String(selectedDates[0].getMonth() + 1).padStart(2, '0');
                        const dd = String(selectedDates[0].getDate()).padStart(2, '0');
                        const isoDate = `${yyyy}-${mm}-${dd}`;
                        window.location.href = `{{ route('cirugias.index') }}?tab=programacion&fecha_programacion=${isoDate}&fecha=${isoDate}`;
                    }
                }
            });

            $('#fechaProgramacionInput').next('.absolute').addBack().on('click', function() {
                fpProg.open();
            });

            const fpDesde = flatpickr("#fechaDesde", {
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d/m/Y",
                allowInput: true,
                onChange: function() { $('#miTabla').DataTable().draw(); }
            });

            const fpHasta = flatpickr("#fechaHasta", {
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d/m/Y",
                allowInput: true,
                onChange: function() { $('#miTabla').DataTable().draw(); }
            });

            // Si hay errores de validación del form de programación, reabrir el modal
            // con los valores anteriores para que el usuario pueda corregir y reenviar.
            @if($errors->any() && old('fecha'))
                (function() {
                    $('#formMethod').val('{{ old('_method', 'POST') }}');
                    const oldId = '{{ old('programacion_id', '') }}';
                    $('#progId').val(oldId);
                    if (oldId) {
                        $('#formProgramacion').attr('action', '/programacion/' + oldId);
                        $('#modalTitle span').text('Editar Programación de Cirugía');
                    } else {
                        $('#formProgramacion').attr('action', "{{ route('programacion.store') }}");
                        $('#modalTitle span').text('Nueva Programación de Cirugía');
                    }

                    $('#progFecha').val('{{ old('fecha') }}');
                    $('#progQuirofano').val('{{ old('quirofano') }}');
                    $('#progHora').val('{{ old('hora') }}');
                    $('#progPaciente').val(@json(old('paciente', '')));
                    $('#progEspecialidad').val(@json(old('especialidad', '')));
                    $('#progProcedimiento').val(@json(old('procedimiento', '')));
                    $('#progCirujano').val(@json(old('cirujano', '')));
                    $('#progObservaciones').val(@json(old('observaciones', '')));
                    $('#modalProgRealizada').prop('checked', {{ old('realizada') ? 'true' : 'false' }});
                    $('#modalProgSuspendida').prop('checked', {{ old('suspendida') ? 'true' : 'false' }});

                    renderDropdownProcedimientos();
                    $('#modalProgramacion').removeClass('hidden');
                    if (typeof lucide !== 'undefined') lucide.createIcons();

                    // Scroll al mensaje de error
                    const alertEl = document.getElementById('alertError');
                    if (alertEl) alertEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
                })();
            @endif
        });
    </script>
@endpush
