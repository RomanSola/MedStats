<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Historial_stock;
use App\Models\Paciente;
use App\Models\Empleado;
use App\Models\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Servicio;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Stock::with(['get_medicamento', 'get_servicio']);

        // Check if user is restricted to a service
        if ($user->servicio_id) {
            $query->where('servicio_id', $user->servicio_id);
            // Limit available filters
            $servicios = Servicio::where('id', $user->servicio_id)->get();
        } else {
             // Admin/Global: Show all or filter by request
             if ($request->filled('servicio_id')) {
                $query->where('servicio_id', $request->servicio_id);
            }
            $servicios = Servicio::all();
        }

        $stock = $query->get();
        //$servicios = Servicio::all(); // Moved logic up
        return view('stocks.index', compact('stock', 'servicios'));
    }

    public function create()
    {
        $medicamentos = Medicamento::pluck('nombre', 'id');
        
        $user = auth()->user();
        if ($user->servicio_id) {
            $servicios = Servicio::where('id', $user->servicio_id)->get();
        } else {
            $servicios = Servicio::all();
        }
        
        return view('stocks.create', compact('medicamentos', 'servicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cantidad_act' => 'required|integer|min:0',
            // 'servicio_id' => 'required|exists:servicios,id', // Validation logic updated below
        ]);
        
        $user = auth()->user();
        $inputServicio = $request->input('servicio_id');
        
        // If user is restricted, force their service ID
        if ($user->servicio_id) {
            $inputServicio = $user->servicio_id;
        } else {
            // If explicit input is missing for admin, validation fails
            $request->validate(['servicio_id' => 'required|exists:servicios,id']);
        }
        
        $existe = Stock::where('medicamento_id', $request->input('medicamento_id'))
        ->where('lote', $request->input('lote'))
        ->where('servicio_id', $inputServicio)
        ->exists();

        if ($existe) {
            return redirect()->back()
            ->withErrors(['lote' => 'Ya existe un stock para este medicamento con ese lote en este servicio.'])
            ->withInput();
        }

        $stock = new Stock();
        $stock->medicamento_id = $request->input('medicamento_id');
        $stock->fecha_vencimiento = $request->input('fecha_vencimiento');
        $stock->lote = $request->input('lote');
        $stock->cantidad_act = $request->input('cantidad_act');
        $stock->servicio_id = $inputServicio;
        $stock->save();
        //dd($stock);
        Historial_stock::create([
            'stock_id' => $stock->id, // FK a tabla stock
            'cantidad' => $request->input('cantidad_act'),
            'fecha' => now()->toDateString(),
            'comentario' => 'Carga inicial de stock',
            'usuario' => null,
            'paciente_id' => null,
            'creado_por' => auth()->id(),
        ]);
        return redirect()->route('stocks.index')->with('success', 'Medicamento cargado con éxito');

    }

    public function show(Stock $stock)
    {
        $hist_item = Historial_stock::where('stock_id', $stock->id)
            ->paginate(15);
        return view('stocks.show', compact('hist_item', 'stock'));
    }
    public function edit(Stock $stock, Request $request)
    {
        $modo = $request->query('modo'); // puede ser 'agregar' o 'extraer'
        $pacientes = Paciente::all();
        $empleados = Empleado::all();
    
        return view('stocks.edit', compact('stock', 'pacientes', 'empleados', 'modo'));
    }
    
    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'cantidad_agregar' => 'nullable|integer|min:0',
            'cantidad_extraer' => 'nullable|integer|min:0',
        ]);
    
        $existe = Stock::where('medicamento_id', $request->input('medicamento_id'))
            ->where('lote', $stock->lote)
            ->where('servicio_id', $stock->servicio_id)
            ->where('id', '!=', $stock->id)
            ->exists();
    
        if ($existe) {
            return redirect()->back()
                ->withErrors(['lote' => 'Ya existe un stock para este medicamento con ese lote.'])
                ->withInput();
        }
    
        $oldCantidad = $stock->cantidad_act;
        $agregar = $request->input('cantidad_agregar', 0);
        $extraer = $request->input('cantidad_extraer', 0);
    
        // Validación: no permitir agregar y extraer al mismo tiempo
        if ($agregar > 0 && $extraer > 0) {
            return redirect()->back()
                ->withErrors(['cantidad_agregar' => 'Solo se puede agregar o extraer, no ambas acciones a la vez.'])
                ->withInput();
        }
    
        // Si no se modifica nada, salir
        if ($agregar === 0 && $extraer === 0) {
            return redirect()->route('stocks.index');
        }
    
        // Validar que no se descuente más stock del que hay
        $nuevaCantidad = $oldCantidad + $agregar - $extraer;
        if ($nuevaCantidad < 0) {
            return redirect()->back()
                ->withErrors(['cantidad_extraer' => 'No se puede descontar más de lo que hay en stock.'])
                ->withInput();
        }
    
        // Si se está extrayendo, validar datos del paciente, médico y comentario
        if ($extraer > 0) {
            $request->validate([
                'paciente_id' => 'required|exists:pacientes,id',
                'empleado_id' => 'required|exists:empleados,id',
                'comentario' => 'nullable|string|max:255',
            ]);
        }
    
        // Actualizar stock
        $stock->medicamento_id = $request->input('medicamento_id');
        $stock->fecha_vencimiento = $request->filled('fecha_vencimiento')
            ? $request->input('fecha_vencimiento')
            : $stock->fecha_vencimiento;
        $stock->cantidad_act = $nuevaCantidad;
        $stock->save();
    
        // Registrar historial si hubo modificación
        $cantidad_modificada = $agregar > 0 ? $agregar : -$extraer;
        $comentario = $request->input('comentario') ?? ($agregar > 0 ? 'Se aumentó el stock.' : 'Se descontó stock.');
    
        Historial_stock::create([
            'stock_id' => $stock->id,
            'cantidad' => $cantidad_modificada,
            'fecha' => now()->toDateString(),
            'empleado_id' => $request->input('empleado_id'),
            'paciente_id' => $request->input('paciente_id'),
            'comentario' => $comentario,
            'creado_por' => auth()->id(), // si querés registrar el usuario
        ]); 
        return redirect()->route('stocks.index');
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

    // Fechas por defecto si no se envían
    $desde = $validated['desde'] ?? now()->startOfMonth()->toDateString();
    $hasta = $validated['hasta'] ?? now()->endOfMonth()->toDateString();

    // Umbral para "sin movimiento" (dias)
    $umbralDias = max(1, intval($request->input('dias', 30)));
    $fechaLimite = now()->subDays($umbralDias)->toDateString();

    // ---------- CÁLCULO DEL TOTAL DE INSUMOS AL CIERRE DE 'HASTA' ----------
    // Estrategia: partimos del stock actual (cantidad_act) y restamos la suma de movimientos
    // posteriores a la fecha 'hasta' (movimientos con fecha > hasta).
    // Esto nos devuelve el stock que existía al final de la fecha 'hasta'.
    //
    // Nota: los registros de Historial_stock tienen 'cantidad' positiva para entradas y
    // negativa para salidas; por eso sumamos directamente 'cantidad'.

    // 1) Obtener suma de movimientos posteriores a 'hasta' por stock_id
    $movimientosPosteriores = Historial_stock::select('stock_id', DB::raw('SUM(cantidad) as suma_posterior'))
        ->where('fecha', '>', $hasta)
        ->groupBy('stock_id')
        ->get()
        ->keyBy('stock_id');

    // 2) Recuperar todos los stocks y aplicar la corrección por movimientos posteriores
    $stocks = Stock::all(); // con cantidad_act actual
    $totalStockAlCierre = 0;
    foreach ($stocks as $s) {
        $sumaPosterior = $movimientosPosteriores->has($s->id) ? $movimientosPosteriores[$s->id]->suma_posterior : 0;
        // stock al cierre = actual - movimientos posteriores
        $stockAlCierre = $s->cantidad_act - $sumaPosterior;
        // seguridad: no permitir valores negativos en el total agregado
        $totalStockAlCierre += max(0, $stockAlCierre);
    }
    $totalStock = $totalStockAlCierre;
    // -----------------------------------------------------------------------

    // Totales por movimientos entre desde/hasta (ya estaban)
    $totalAgregados = Historial_stock::where('cantidad', '>', 0)
        ->whereBetween('fecha', [$desde, $hasta])
        ->sum('cantidad');

    $totalExtraidos = Historial_stock::where('cantidad', '<', 0)
        ->whereBetween('fecha', [$desde, $hasta])
        ->sum(DB::raw('ABS(cantidad)'));

    // Insumos más utilizados en el período
    $insumos = Historial_stock::select('stock_id', DB::raw('SUM(ABS(cantidad)) as total'))
        ->where('cantidad', '<', 0)
        ->whereBetween('fecha', [$desde, $hasta])
        ->groupBy('stock_id')
        ->with('get_stock.get_medicamento')
        ->orderByDesc('total')
        ->take(5)
        ->get();

    $insumoLabels = $insumos->map(fn($item) =>
        optional($item->get_stock->get_medicamento)->nombre ?? 'Sin nombre'
    );

    $insumoValores = $insumos->pluck('total');

    // Vencimientos próximos (dentro de 60 días)
    $vencimientos = Stock::whereNotNull('fecha_vencimiento')
        ->whereBetween('fecha_vencimiento', [now(), now()->addDays(60)])
        ->with('get_medicamento')
        ->orderBy('fecha_vencimiento')
        ->get();

    // Insumos sin movimiento según umbralDias
    $stocksSinMovimiento = Stock::whereDoesntHave('historial_stock', function ($query) use ($fechaLimite) {
        $query->where('fecha', '>', $fechaLimite);
    })->with('get_medicamento')->get();

    // Proyección de duración de stock (últimos 30 días)
    $periodoAnalisis = 30;
    $fechaInicio = now()->subDays($periodoAnalisis)->toDateString();
    $fechaFin = now()->toDateString();

    $consumos = Historial_stock::join('stocks', 'historial_stocks.stock_id', '=', 'stocks.id')
        ->select('stocks.medicamento_id', DB::raw('SUM(ABS(historial_stocks.cantidad)) as total_consumo'))
        ->where('historial_stocks.cantidad', '<', 0)
        ->whereBetween('historial_stocks.fecha', [$fechaInicio, $fechaFin])
        ->groupBy('stocks.medicamento_id')
        ->get()
        ->keyBy('medicamento_id');

    $proyecciones = Stock::with('get_medicamento')->get()->map(function ($stock) use ($consumos, $periodoAnalisis) {
        $consumoTotal = $consumos[$stock->medicamento_id]->total_consumo ?? 0;
        $consumoDiario = $consumoTotal / $periodoAnalisis;
        $diasRestantes = $consumoDiario > 0 ? round($stock->cantidad_act / $consumoDiario) : null;

        return [
            'medicamento' => optional($stock->get_medicamento)->nombre,
            'lote' => $stock->lote,
            'cantidad_act' => $stock->cantidad_act,
            'consumo_diario' => round($consumoDiario, 2),
            'dias_restantes' => $diasRestantes,
        ];
    });

    return view('stocks.estadisticasstock', compact(
        'totalStock',
        'totalAgregados',
        'totalExtraidos',
        'insumoLabels',
        'insumoValores',
        'vencimientos',
        'desde',
        'hasta',
        'stocksSinMovimiento',
        'umbralDias',
        'proyecciones'
    ));
}
 
}