<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Historial_stock;
use App\Models\Paciente;
use App\Models\Empleado;
use App\Models\Medicamento;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stock = Stock::with('get_medicamento')->get();
        return view('stocks.index', compact('stock'));
    }

    public function create()
    {
        $medicamentos = Medicamento::pluck('nombre', 'id');
        return view('stocks.create', compact('medicamentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'fecha_vencimiento' => 'nullable|date',
            'lote' => 'required',
            'cantidad_act' => 'required|integer|min:0',
        ]);
        $existe = Stock::where('medicamento_id', $request->input('medicamento_id'))
        ->where('lote', $request->input('lote'))
        ->exists();

        if ($existe) {
            return redirect()->back()
            ->withErrors(['lote' => 'Ya existe un stock para este medicamento con ese lote.'])
            ->withInput();
        }

        $stock = new Stock();
        $stock->medicamento_id = $request->input('medicamento_id');
        $stock->fecha_vencimiento = $request->input('fecha_vencimiento');
        $stock->lote = $request->input('lote');
        $stock->cantidad_act = $request->input('cantidad_act');
        $stock->save();
        //dd($stock);
        Historial_stock::create([
            'stock_id' => $stock->id, // FK a tabla stock
            'cantidad' => $request->input('cantidad_act'),
            'fecha' => now()->toDateString(),
            'comentario' => 'Carga inicial de stock',
            'usuario' => null,
            'paciente_id' => null,
            //'creado_por' => auth()->id(),
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
    
        // Verificar si ya existe un stock con mismo medicamento y lote (excluyendo el actual)
        $existe = Stock::where('medicamento_id', $request->input('medicamento_id'))
            ->where('lote', $stock->lote)
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
            // 'creado_por' => auth()->id(), // si querés registrar el usuario
        ]);
    
        return redirect()->route('stocks.index');
    }
}