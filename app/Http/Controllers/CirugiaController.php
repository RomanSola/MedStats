<?php
namespace App\Http\Controllers;

use App\Models\Cirugia;
use App\Models\Paciente;
use App\Models\Empleado;
use App\Models\Especialidad;
use App\Models\Procedimiento;
use App\Models\Quirofano;
use App\Models\Tipo_anestesia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CirugiaController extends Controller
{

    //Muestra todos los datos
    public function index() //Pagina inicial
    {
        $cirugias = Cirugia::with([
            'get_paciente',
            'get_especialidad',
            'get_procedimiento',
            'get_quirofano',
            'get_cirujano',
            'get_ayudante1',
            'get_ayudante2',
            'get_ayudante3',
            'get_anestesista',
            'get_instrumentador',
            'get_instrumentador2',
            'get_enfermero',
            'get_enfermero2',
            'get_tipo_anestesia',
            'get_tipo_anestesia2',
            'modificador',
        ])->get();
        return view('cirugias.index', compact('cirugias')); //Llama a la vista y le pasa las Cirugias obtenidas
    }

    public function show(Cirugia $cirugia)
    {
        return view('cirugias.show', compact('cirugia'));
    }
    public function create()
    {
        $pacientes = Paciente::orderBy('apellido')->orderBy('nombre')->get();
        $empleados = Empleado::orderBy('apellido')->orderBy('nombre')->get();
        $especialidades = Especialidad::orderBy('nombre')->get();
        $procedimientos = Procedimiento::orderBy('nombre_procedimiento')->get();
        $quirofanos = Quirofano::orderBy('nombre')->get();
        $tipoAnestesias = Tipo_anestesia::orderBy('nombre')->get();
        return view('cirugias.create', compact('pacientes', 'empleados', 'especialidades', 'procedimientos', 'quirofanos', 'tipoAnestesias'));
    }


    public function store(Request $request)
    {   
        // try{
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'especialidad_id' => 'required|exists:especialidads,id',
            'procedimiento_id' => 'required|exists:procedimientos,id',
            'quirofano_id' => 'required|exists:quirofanos,id',
            'cirujano_id' => 'required|exists:empleados,id',
            'anestesista_id' => 'nullable|exists:empleados,id',
            'tipo_anestesia_id' => 'nullable|exists:tipo_anestesias,id',
            'instrumentador_id' => 'nullable|exists:empleados,id',
            'enfermero_id' => 'required|exists:empleados,id',
            'fecha_cirugia' => 'required',
            'hora_cirugia' => 'required',
            'duracion_horas' => 'nullable|integer|min:0',
            'duracion_minutos' => 'nullable|integer|min:0|max:59',
        ], [
            'paciente_id.required' => 'Seleccioná un paciente antes de continuar.',
            'paciente_id.exists' => 'El paciente seleccionado no existe en el sistema.',

            'especialidad_id.required' => 'Indicá la especialidad a realizar.',
            'especialidad_id.exists' => 'La especialidad no está registrada.',

            'procedimiento_id.required' => 'Indicá el procedimiento a realizar.',
            'procedimiento_id.exists' => 'El procedimiento no está registrado.',

            'quirofano_id.required' => 'Seleccioná el quirófano asignado.',
            'quirofano_id.exists' => 'Ese quirófano no está disponible o no existe.',

            'cirujano_id.required' => 'Asigná un cirujano para la cirugía.',
            'cirujano_id.exists' => 'El cirujano seleccionado no está registrado.',

            'anestesista_id.required' => 'Asigná un anestesiologo para el procedimiento.',
            'anestesista_id.exists' => 'El anestesiologo seleccionado no está registrado.',

            'tipo_anestesia_id.required' => 'Indicá el tipo de anestesia.',
            'tipo_anestesia_id.exists' => 'Ese tipo de anestesia no está registrado.',

            'instrumentador_id.exists' => 'El instrumentador seleccionado no está registrado.',

            'enfermero_id.required' => 'Asigná un enfermero/a para la cirugía.',
            'enfermero_id.exists' => 'El enfermero/a seleccionado no está registrado.',

            'fecha_cirugia.required' => 'Indicá la fecha programada para la cirugía.',
            'hora_cirugia.required' => 'Indicá la hora programada para la cirugía.',
        ]);
        if ($request->input('ayudante_1_id') != null) {
            $request->validate([
                'ayudante_1_id' => 'exists:empleados,id|nullable|different:cirujano_id',
            ], [
                'ayudante_1_id.different' => 'El ayudante 1 debe ser distinto a los demas.',
            ]);
        }
        if ($request->input('ayudante_2_id') != null) {
            $request->validate([
                'ayudante_2_id' => 'exists:empleados,id|nullable|different:ayudante_1_id',
            ], [
                'ayudante_2_id.different' => 'El ayudante 2 debe ser distinto a los demas.',
            ]);
        }
        if ($request->input('ayudante_3_id') != null) {
            $request->validate([
                'ayudante_3_id' => 'exists:empleados,id|nullable|different:ayudante_1_id|different:ayudante_2_id',
            ], [
                'ayudante_3_id.different' => 'El ayudante 3 debe ser distinto a los demas.',
            ]);
        }
        if ($request->input('procedimiento_2_id') != null) {
            $request->validate([
                'procedimiento_2_id' => 'exists:procedimientos,id|nullable|different:procedimiento_id',
            ], [
                'procedimiento_2_id.different' => 'El Procedimiento 2 debe ser distinto a Procedimiento.',
            ]);
        }
        if ($request->input('instrumentador_2_id') != null) {
            $request->validate([
                'instrumentador_2_id' => 'exists:empleados,id|nullable|different:instrumentador_id',
            ], [
                'instrumentador_2_id.different' => 'El Instrumentador 2 debe ser distinto a Insturmentador.',
            ]);
        }
        if ($request->input('enfermero_2_id') != null) {
            $request->validate([
                'enfermero_2_id' => 'exists:empleados,id|nullable|different:enfermero_id',
            ], [
                'enfermero_2_id.different' => 'El Enfermero 2 debe ser distinto a Enfermero.',
            ]);
        }
        if ($request->input('tipo_anestesia_2_id') != null) {
            $request->validate([
                'tipo_anestesia_2_id' => 'exists:tipo_anestesias,id|nullable|different:tipo_anestesia_id',
            ], [
                'tipo_anestesia_2_id.different' => 'El tipo de anestesia 2 debe ser distinto a tipo de anestesia.',
            ]);
        }
        // } catch(\Illuminate\Validation\ValidationException $e){
        //     dd($e->errors());
        // }
        $cirugia = new Cirugia();
        //Datos del POST se obtiene en request
        $cirugia->paciente_id = $request->input('paciente_id');
        $cirugia->especialidad_id = $request->input('especialidad_id');
        $cirugia->procedimiento_id = $request->input('procedimiento_id');
        $cirugia->procedimiento_2_id = $request->input('procedimiento_2_id');
        $cirugia->quirofano_id = $request->input('quirofano_id');
        $cirugia->cirujano_id = $request->input('cirujano_id');
        $cirugia->ayudante_1_id = $request->input('ayudante_1_id');
        $cirugia->ayudante_2_id = $request->input('ayudante_2_id');
        $cirugia->ayudante_3_id = $request->input('ayudante_3_id');
        $cirugia->anestesista_id = $request->input('anestesista_id');
        $cirugia->tipo_anestesia_id = $request->input('tipo_anestesia_id');
        $cirugia->tipo_anestesia_2_id = $request->input('tipo_anestesia_2_id');
        $cirugia->instrumentador_id = $request->input('instrumentador_id');
        $cirugia->instrumentador_2_id = $request->input('instrumentador_2_id');
        $cirugia->enfermero_id = $request->input('enfermero_id');
        $cirugia->enfermero_2_id = $request->input('enfermero_2_id');
        $cirugia->fecha_cirugia = $request->input('fecha_cirugia');
        $cirugia->hora_cirugia = $request->input('hora_cirugia');

        //Formatear duración
        $horas = $request->input('duracion_horas', 0);
        $minutos = $request->input('duracion_minutos', 0);
        $duracion = sprintf('%02d:%02d', $horas, $minutos);
        $cirugia->duracion = $duracion;
        $cirugia->creado_por = auth()->id();
        $cirugia->modificado_por = auth()->id();

        if ($request->input('urgencia') != null) {
            $cirugia->urgencia = true;
        } else {
            $cirugia->urgencia = false;
        }
        if ($request->input('obito') != null) {
            $cirugia->obito = true;
        } else {
            $cirugia->obito = false;
        }
        // dd($cirugia);
        $cirugia->save(); //Guarda en la BD, si existe lo actualiza, sino crea
        if ($request->input('action') === 'cargar_medicamentos') {
            return redirect()->route('cirugias.medicamentos', $cirugia);
        }
        return redirect()->route('cirugias.index');
    }

    public function edit(Cirugia $cirugia)
    {
        $pacientes = Paciente::orderBy('apellido')->orderBy('nombre')->get();
        $empleados = Empleado::with('get_profesion')->orderBy('apellido')->orderBy('nombre')->get();
        $especialidades = Especialidad::orderBy('nombre')->get();
        $procedimientos = Procedimiento::with('get_especialidad')->orderBy('nombre_procedimiento')->get();
        $quirofanos = Quirofano::orderBy('nombre')->get();
        $tipoAnestesias = Tipo_anestesia::orderBy('nombre')->get();
        return view('cirugias.edit', compact('cirugia', 'pacientes', 'empleados', 'especialidades', 'procedimientos', 'quirofanos', 'tipoAnestesias'));
    }

    public function update(Request $request, Cirugia $cirugia)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'especialidad_id' => 'required|exists:especialidads,id',
            'procedimiento_id' => 'required|exists:procedimientos,id',
            'quirofano_id' => 'required|exists:quirofanos,id',
            'cirujano_id' => 'required|exists:empleados,id',
            'anestesista_id' => 'nullable|exists:empleados,id',
            'tipo_anestesia_id' => 'nullable|exists:tipo_anestesias,id',
            'instrumentador_id' => 'nullable|exists:empleados,id',
            'enfermero_id' => 'nullable|exists:empleados,id',
            'fecha_cirugia' => 'required',
            'hora_cirugia' => 'required',
            'duracion_horas' => 'nullable|integer|min:0',
            'duracion_minutos' => 'nullable|integer|min:0|max:59',
        ]);

        if ($request->input('ayudante_1_id') != null) {
            $request->validate([
                'ayudante_1_id' => 'exists:empleados,id|nullable|different:cirujano_id',
            ], [
                'ayudante_1_id.different' => 'El ayudante 1 debe ser distinto a los demas.',
            ]);
        }
        if ($request->input('ayudante_2_id') != null) {
            $request->validate([
                'ayudante_2_id' => 'exists:empleados,id|nullable|different:ayudante_1_id',
            ], [
                'ayudante_2_id.different' => 'El ayudante 2 debe ser distinto a los demas.',
            ]);
        }
        if ($request->input('ayudante_3_id') != null) {
            $request->validate([
                'ayudante_3_id' => 'exists:empleados,id|nullable|different:ayudante_1_id|different:ayudante_2_id',
            ], [
                'ayudante_3_id.different' => 'El ayudante 3 debe ser distinto a los demas.',
            ]);
        }
        if ($request->input('procedimiento_2_id') != null) {
            $request->validate([
                'procedimiento_2_id' => 'exists:procedimientos,id|nullable|different:procedimiento_id',
            ], [
                'procedimiento_2_id.different' => 'El Procedimiento 2 debe ser distinto a Procedimiento.',
            ]);
        }
        if ($request->input('instrumentador_2_id') != null) {
            $request->validate([
                'instrumentador_2_id' => 'exists:empleados,id|nullable|different:instrumentador_id',
            ], [
                'instrumentador_2_id.different' => 'El Instrumentador 2 debe ser distinto a Insturmentador.',
            ]);
        }
        if ($request->input('enfermero_2_id') != null) {
            $request->validate([
                'enfermero_2_id' => 'exists:empleados,id|nullable|different:enfermero_id',
            ], [
                'enfermero_2_id.different' => 'El Enfermero 2 debe ser distinto a Enfermero.',
            ]);
        }
        if ($request->input('tipo_anestesia_2_id') != null) {
            $request->validate([
                'tipo_anestesia_2_id' => 'exists:tipo_anestesias,id|nullable|different:tipo_anestesia_id',
            ], [
                'tipo_anestesia_2_id.different' => 'El tipo de anestesia 2 debe ser distinto a tipo de anestesia.',
            ]);
        }


        $cirugia->paciente_id = $request->input('paciente_id');
        $cirugia->especialidad_id = $request->input('especialidad_id');
        $cirugia->procedimiento_id = $request->input('procedimiento_id');
        $cirugia->procedimiento_2_id = $request->input('procedimiento_2_id');
        $cirugia->quirofano_id = $request->input('quirofano_id');
        $cirugia->cirujano_id = $request->input('cirujano_id');
        $cirugia->ayudante_1_id = $request->input('ayudante_1_id');
        $cirugia->ayudante_2_id = $request->input('ayudante_2_id');
        $cirugia->ayudante_3_id = $request->input('ayudante_3_id');
        $cirugia->anestesista_id = $request->input('anestesista_id');
        $cirugia->tipo_anestesia_id = $request->input('tipo_anestesia_id');
        $cirugia->tipo_anestesia_2_id = $request->input('tipo_anestesia_2_id');
        $cirugia->instrumentador_id = $request->input('instrumentador_id');
        $cirugia->instrumentador_2_id = $request->input('instrumentador_2_id');
        $cirugia->enfermero_id = $request->input('enfermero_id');
        $cirugia->enfermero_2_id = $request->input('enfermero_2_id');

        $cirugia->fecha_cirugia = $request->input('fecha_cirugia');
        $cirugia->hora_cirugia = $request->input('hora_cirugia');
        
        //Formatear duración
        $horas = $request->input('duracion_horas', 0);
        $minutos = $request->input('duracion_minutos', 0);
        $duracion = sprintf('%02d:%02d', $horas, $minutos);
        $cirugia->duracion = $duracion;

        if ($request->input('urgencia') != null) {
            $cirugia->urgencia = true;
        } else {
            $cirugia->urgencia = false;
        }

        if ($request->input('obito') != null) {
            $cirugia->obito = true;
        } else {
            $cirugia->obito = false;
        }

        $cirugia->modificado_por = auth()->id();

        $cirugia->save();
        if ($request->input('action') === 'cargar_medicamentos') {
            return redirect()->route('cirugias.medicamentos', $cirugia);
        }
        return redirect()->route('cirugias.index');
    }

    public function destroy(Cirugia $cirugia)
    {
        $cirugia->delete();
        return redirect()->route('cirugias.index');
    }

    public function estadisticas(Request $request)
    {
        $validated = $request->validate([
            'desde' => 'nullable|date|before_or_equal:today',
            'hasta' => 'nullable|date|after_or_equal:desde|before_or_equal:today',
        ], [
            'desde.date' => 'La fecha de inicio no tiene un formato válido.',
            'desde.before_or_equal' => 'La fecha de inicio no puede ser futura.',
            'hasta.date' => 'La fecha de fin no tiene un formato válido.',
            'hasta.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            'hasta.before_or_equal' => 'La fecha de fin no puede ser futura.',
        ]);
        $desde = $validated['desde'] ?? null;
        $hasta = $validated['hasta'] ?? null;
        $especialidadId = $request->input('especialidad_id');
        $especialidades = \App\Models\Especialidad::orderBy('nombre')->get();
        $aniosDisponibles = \App\Models\Cirugia::select(DB::raw('YEAR(created_at) as anio'))
            ->distinct()
            ->orderBy('anio', 'desc')
            ->pluck('anio');

        $cirujanoId = $request->input('cirujano_id');

        // Base query reutilizable
        $baseQuery = \App\Models\Cirugia::query()
        ->when($desde && $hasta, function ($query) use ($desde, $hasta) {
            return $query->whereBetween('created_at', [$desde, $hasta]);
        })
        ->when($especialidadId, function ($query, $especialidadId) {
            return $query->where('especialidad_id', $especialidadId);
        })
        ->when($cirujanoId, function ($query, $cirujanoId) {
            return $query->where('cirujano_id', $cirujanoId);
        });

        // Obtener cirujanos disponibles para el filtro
        // Si hay especialidad seleccionada, mostramos solo los que han operado esa especialidad
        // Si no, mostramos todos los que han operado alguna vez
        $cirujanosDisponibles = \App\Models\Empleado::whereIn('id', function($query) use ($especialidadId) {
            $query->select('cirujano_id')
                  ->from('cirugias')
                  ->when($especialidadId, function($q, $especialidadId) {
                      return $q->where('especialidad_id', $especialidadId);
                  });
        })
        ->orderBy('apellido')
        ->orderBy('nombre')
        ->get();

        $total = $baseQuery->count();
        $meses = (clone $baseQuery)
            ->select(DB::raw('MONTH(created_at) as mes'))
            ->distinct()
            ->count();
        $semanas = (clone $baseQuery)
            ->select(DB::raw('YEARWEEK(created_at, 1) as semana'))
            ->distinct()
            ->count();
        $promedioMensual = $meses > 0 ? round($total / $meses, 2) : 0;
        $promedioSemanal = $semanas > 0 ? round($total / $semanas, 2) : 0;

        // Cirugías por cirujano
        $porCirujano = (clone $baseQuery)
            ->select('cirujano_id', DB::raw('COUNT(*) as total'))
            ->groupBy('cirujano_id')
            ->with('get_cirujano')
            ->get()
            ->sortByDesc('total')
            ->take(5);

        $cirujanoLabels = $porCirujano->map(function ($item) {
            $c = $item->get_cirujano;
            return $c ? $c->nombre . ' ' . $c->apellido : 'Sin asignar';
        })->values();

        $cirujanoValores = $porCirujano->pluck('total')->values();

        // Top enfermeros/as
        $topEnfermeros = (clone $baseQuery)
            ->select('enfermero_id', DB::raw('COUNT(*) as total'))
            ->groupBy('enfermero_id')
            ->with('get_enfermero')
            ->get()
            ->sortByDesc('total')
            ->take(5);

        $enfermeroLabels = $topEnfermeros->map(function ($item) {
            return optional($item->get_enfermero)->nombre . ' ' . optional($item->get_enfermero)->apellido;
        });

        $enfermeroValores = $topEnfermeros->pluck('total');

        // Top instrumentadores
        $topInstrumentadors = (clone $baseQuery)
            ->select('instrumentador_id', DB::raw('COUNT(*) as total'))
            ->groupBy('instrumentador_id')
            ->with('get_instrumentador')
            ->get()
            ->sortByDesc('total')
            ->take(5);

        $instrumentadorLabels = $topInstrumentadors->map(function ($item) {
            return optional($item->get_instrumentador)->nombre . ' ' . optional($item->get_instrumentador)->apellido;
        });

        $instrumentadorValores = $topInstrumentadors->pluck('total');

        // Distribución por mes
        $porMes = (clone $baseQuery)
            ->select(DB::raw('MONTH(created_at) as mes'), DB::raw('COUNT(*) as total'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        $porMes->transform(function ($item) {
            $item->mes_nombre = \Carbon\Carbon::create()->month($item->mes)->translatedFormat('F');
            return $item;
        });

        $porMesLabels = $porMes->pluck('mes')->map(function ($m) {
            return \Carbon\Carbon::create()->month($m)->translatedFormat('F');
        });

        $porMesValores = $porMes->pluck('total');
        $porMes = $porMes->sortBy('mes')->values();

        // Urgentes y programadas
        $urgentes = (clone $baseQuery)->where('urgencia', '1')->count();
        $programadas = (clone $baseQuery)->where('urgencia', '0')->count();

        // Por tipo de anestesia
        $porAnestesia = (clone $baseQuery)
            ->select('tipo_anestesia_id', DB::raw('COUNT(*) as total'))
            ->groupBy('tipo_anestesia_id')
            ->with('get_tipo_anestesia')
            ->get();
        $anioSeleccionado = request('anio') ?? \Carbon\Carbon::parse($desde)->year;
        return view('cirugias.estadisticas', compact(
            'porCirujano',
            'topEnfermeros',
            'topInstrumentadors',
            'instrumentadorLabels',
            'instrumentadorValores',
            'enfermeroLabels',
            'enfermeroValores',
            'porMes',
            'porMesLabels',
            'porMesValores',
            'urgentes',
            'programadas',
            'porAnestesia',
            'promedioMensual',
            'promedioSemanal',
            'cirujanoLabels',
            'cirujanoValores',
            'anioSeleccionado',
            'aniosDisponibles',
            'total',
            'promedioMensual',
            'promedioSemanal',
            'especialidadId',
            'especialidades',
            'cirujanosDisponibles',
            'cirujanoId'
        ));
    }

    public function medicamentos(Cirugia $cirugia)
    {
        $quirofanoServicio = \App\Models\Servicio::where('nombre', 'like', '%quirofano%')->first()
            ?? \App\Models\Servicio::find(3);

        if (!$quirofanoServicio) {
            return redirect()->back()->withErrors(['error' => 'No se encontró el servicio Quirófano en la base de datos.']);
        }

        $stocks = \App\Models\Stock::where('servicio_id', $quirofanoServicio->id)
            ->where('cantidad_act', '>', 0)
            ->with('get_medicamento')
            ->get();

        $consumidos = \App\Models\Historial_stock::where('comentario', 'cirugia ' . $cirugia->id)
            ->where('cantidad', '<', 0)
            ->with('get_stock.get_medicamento')
            ->get();

        return view('cirugias.medicamentos', compact('cirugia', 'stocks', 'consumidos'));
    }

    public function guardarMedicamentos(Request $request, Cirugia $cirugia)
    {
        $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'cantidad' => 'required|integer|min:1',
        ], [
            'stock_id.required' => 'Debe seleccionar un insumo/medicamento.',
            'stock_id.exists' => 'El stock seleccionado no es válido.',
            'cantidad.required' => 'Debe ingresar la cantidad.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad debe ser al menos 1.',
        ]);

        $stock = \App\Models\Stock::find($request->stock_id);
        $quirofanoServicio = \App\Models\Servicio::where('nombre', 'like', '%quirofano%')->first()
            ?? \App\Models\Servicio::find(3);

        if ($stock->servicio_id != $quirofanoServicio->id) {
            return redirect()->back()->withErrors(['stock_id' => 'El stock seleccionado no pertenece al servicio de Quirófano.'])->withInput();
        }

        $cantidad = $request->cantidad;

        if ($stock->cantidad_act < $cantidad) {
            return redirect()->back()->withErrors(['cantidad' => 'No hay suficiente stock de este lote. Stock disponible: ' . $stock->cantidad_act])->withInput();
        }

        $stock->decrement('cantidad_act', $cantidad);

        \App\Models\Historial_stock::create([
            'stock_id' => $stock->id,
            'cantidad' => -$cantidad,
            'fecha' => now()->toDateString(),
            'empleado_id' => $cirugia->cirujano_id,
            'paciente_id' => $cirugia->paciente_id,
            'comentario' => 'cirugia ' . $cirugia->id,
            'creado_por' => auth()->id(),
        ]);

        return redirect()->route('cirugias.medicamentos', $cirugia)->with('success', 'Medicamento cargado y descontado del stock correctamente.');
    }

    public function eliminarMedicamento(Cirugia $cirugia, \App\Models\Historial_stock $historial)
    {
        if ($historial->comentario !== 'cirugia ' . $cirugia->id) {
            return redirect()->back()->withErrors(['error' => 'El registro de historial no pertenece a esta cirugía.']);
        }

        $stock = \App\Models\Stock::find($historial->stock_id);
        if ($stock) {
            $stock->increment('cantidad_act', abs($historial->cantidad));
        }

        $historial->delete();

        return redirect()->route('cirugias.medicamentos', $cirugia)->with('success', 'Carga de medicamento eliminada y stock restaurado.');
    }
}