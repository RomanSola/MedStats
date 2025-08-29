<?php

namespace App\Http\Controllers;

use App\Models\Cirugia;
use App\Models\Paciente;
use App\Models\Empleado;
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
        //$cirugias = Tarea::all(); //Hace un select all a la tabla
        //Llama a la funcion get_categoria del modelo tarea.php
        $cirugias = Cirugia::with(['get_paciente', 'get_procedimiento', 'get_quirofano', 'get_cirujano', 'get_ayudante1', 'get_ayudante2', 'get_ayudante3', 'get_anestesista', 'get_instrumentador','get_enfermero', 'get_tipo_anestesia'])->get();
        //dd($cirugias);
        return view('cirugias.index', compact('cirugias')); //Llama a la vista y le pasa las Cirugias obtenidas
    }

    public function show(Cirugia $cirugia)
    {
        return view('cirugias.show', compact('cirugia'));
    }
    public function create()
    {
        $pacientes = Paciente::all();
        $empleados = Empleado::all();
        $procedimientos = Procedimiento::all();
        $quirofanos = Quirofano::all();
        $tipoAnestesias = Tipo_anestesia::all();
        return view('cirugias.create', compact('pacientes', 'empleados', 'procedimientos', 'quirofanos', 'tipoAnestesias'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'procedimiento_id' => 'required|exists:procedimientos,id',
            'quirofano_id' => 'required|exists:quirofanos,id',
            'cirujano_id' => 'required|exists:empleados,id',
            'anestesista_id' => 'required|exists:empleados,id',
            'tipo_anestesia_id' => 'required|exists:tipo_anestesias,id',
            'instrumentador_id' => 'required|exists:empleados,id',
            'enfermero_id' => 'required|exists:empleados,id',
            'fecha_cirugia' => 'required',
            'hora_cirugia' => 'required',
        ]);

        if ($request->input('ayudante_1_id') != null) {
            $request->validate([
                'ayudante_1_id' => 'exists:empleados,id',
            ]);
        }
        if ($request->input('ayudante_2_id') != null) {
            $request->validate([
                'ayudante_2_id' => 'exists:empleados,id',
            ]);
        }
        if ($request->input('ayudante_3_id') != null) {
            $request->validate([
                'ayudante_3_id' => 'exists:empleados,id',
            ]);
        }

        $cirugia = new Cirugia();
        //Datos del POST se obtiene en request
        $cirugia->paciente_id = $request->input('paciente_id');
        $cirugia->procedimiento_id = $request->input('procedimiento_id');
        $cirugia->quirofano_id = $request->input('quirofano_id');
        $cirugia->cirujano_id = $request->input('cirujano_id');
        $cirugia->ayudante_1_id = $request->input('ayudante_1_id');
        $cirugia->ayudante_2_id = $request->input('ayudante_2_id');
        $cirugia->ayudante_3_id = $request->input('ayudante_3_id');
        $cirugia->anestesista_id = $request->input('anestesista_id');
        $cirugia->tipo_anestesia_id = $request->input('tipo_anestesia_id');
        $cirugia->instrumentador_id = $request->input('instrumentador_id');
        $cirugia->enfermero_id = $request->input('enfermero_id');
        //Reemplazar cuando tengamos los usuarios
        $cirugia->creado_por = '1';
        $cirugia->modificado_por = '1';

        if ($request->input('urgencia') != null) {
            $cirugia->urgencia = true;
        } else {
            $cirugia->urgencia = false;
        }

        $cirugia->save(); //Guarda en la BD, si existe lo actualiza, sino crea

        return redirect()->route('cirugias.index');
    }

    public function edit(Cirugia $cirugia)
    {
        $pacientes = Paciente::all();
        $empleados = Empleado::all();
        $procedimientos = Procedimiento::all();
        $quirofanos = Quirofano::all();
        $tipoAnestesias = Tipo_anestesia::all();
    
        return view('cirugias.edit', compact('cirugia', 'pacientes', 'empleados', 'procedimientos', 'quirofanos', 'tipoAnestesias'));
    }

    public function update(Request $request, Cirugia $cirugia)
    {   //dd($request->all());
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'procedimiento_id' => 'required|exists:procedimientos,id',
            'quirofano_id' => 'required|exists:quirofanos,id',
            'cirujano_id' => 'required|exists:empleados,id',
            'anestesista_id' => 'required|exists:empleados,id',
            'tipo_anestesia_id' => 'required|exists:tipo_anestesias,id',
            'instrumentador_id' => 'nullable|exists:empleados,id',
            'enfermero_id' => 'nullable|exists:empleados,id',
            'fecha_cirugia' => 'required',
            'hora_cirugia' => 'required',
        ]);
        if ($request->input('ayudante_1_id') != null) {
            $request->validate([
                'ayudante_1_id' => 'exists:empleados,id',
            ]);
        }
        if ($request->input('ayudante_2_id') != null) {
            $request->validate([
                'ayudante_2_id' => 'exists:empleados,id',
            ]);
        }
        if ($request->input('ayudante_3_id') != null) {
            $request->validate([
                'ayudante_3_id' => 'exists:empleados,id',
            ]);
        }

        if ($request->input('paciente_id') != null) {
            $cirugia->paciente_id = $request->input('paciente_id');
        }
        if ($request->input('procedimiento_id') != null) {
            $cirugia->procedimiento_id = $request->input('procedimiento_id');
        }
        if ($request->input('quirofano_id') != null) {
            $cirugia->quirofano_id = $request->input('quirofano_id');
        }
        if ($request->input('cirujano_id') != null) {
            $cirugia->cirujano_id = $request->input('cirujano_id');
        }
        if ($request->input('ayudante_1_id') != null) {
            $cirugia->ayudante_1_id = $request->input('ayudante_1_id');
        }
        if ($request->input('ayudante_2_id') != null) {
            $cirugia->ayudante_2_id = $request->input('ayudante_2_id');
        }
        if ($request->input('ayudante_3_id') != null) {
            $cirugia->ayudante_3_id = $request->input('ayudante_3_id');
        }
        if ($request->input('anestesista_id') != null) {
            $cirugia->anestesista_id = $request->input('anestesista_id');
        }
        if ($request->input('tipo_anestesia_id') != null) {
            $cirugia->tipo_anestesia_id = $request->input('tipo_anestesia_id');
        }
        if ($request->input('instrumentador_id') != null) {
            $cirugia->instrumentador_id = $request->input('instrumentador_id');
        }
        if ($request->input('enfermero_id') != null) {
            $cirugia->enfermero_id = $request->input('enfermero_id');
        }
        if ($request->input('urgencia') != null) {
            $cirugia->urgencia = true;
        } else {
            $cirugia->urgencia = false;
        }

        $cirugia->save();
        return redirect()->route('cirugias.index');
    }

    public function destroy(Cirugia $cirugia)
    {
        $cirugia->delete();
        return redirect()->route('cirugias.index');
    }

    public function estadisticas()
    {
$desde = request('desde');
$hasta = request('hasta');

// Si no se especifica, se usa el año actual como rango completo
if (!$desde || !$hasta) {
    $anioSeleccionado = request('anio') ?? now()->year;
    $desde = "$anioSeleccionado-01-01";
    $hasta = "$anioSeleccionado-12-31";
}

$aniosDisponibles = \App\Models\Cirugia::select(DB::raw('YEAR(created_at) as anio'))
    ->distinct()
    ->orderBy('anio', 'desc')
    ->pluck('anio');

// Base query reutilizable
$baseQuery = \App\Models\Cirugia::whereBetween('created_at', [$desde, $hasta]);

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
        'promedioSemanal'
        ));
    }
}