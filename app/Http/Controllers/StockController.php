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

    public function edit(Stock $stock)
    {
        $pacientes = Paciente::all();
        $empleados = Empleado::all();
        return view('stocks.edit', compact('stock', 'pacientes', 'empleados'));
    }

    public function update(Request $request, Stock $stock)
    {
        //dd($request->all());
        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'cantidad_mod' => 'required|integer',
        ]);

        $oldCantidad = $stock->cantidad_act;

        if ($request->input('cantidad_mod') != null and $request->input('cantidad_mod') != 0 ) {

            //Validar que no se descuente más stock del que hay
            $dif = $oldCantidad + $request->input('cantidad_mod');

            if ($dif < 0) {
                return redirect()->back()
                    ->withErrors(['cantidad_mod' => 'No se puede descontar más de lo que hay en stock.'])
                    ->withInput();
            } elseif (!($dif > $oldCantidad)) {
                
                $request->validate([
                    'paciente_id' => 'required|exists:pacientes,id',
                    'empleado_id' => 'required|exists:empleados,id',
                    'comentario' => 'required',
                ]);
            }


            $stock->medicamento_id = $request->input('medicamento_id');
            $stock->fecha_vencimiento = $request->filled('fecha_vencimiento')
                ? $request->input('fecha_vencimiento')
                : $stock->fecha_vencimiento;
            $stock->cantidad_act = $oldCantidad + $request->input('cantidad_mod');
            $stock->save();

            if($request->input('comentario') != null){
                $comentario = $request->input('comentario');
            }else{
                $comentario = 'Se aumentó el stock.';
            }

            Historial_stock::create([
                'stock_id' => $stock->id,
                'cantidad' => $request->input('cantidad_mod'), // cantidad positiva o negativa
                'fecha' => now()->toDateString(),
                'empleado_id' => $request->input('empleado_id'),
                'paciente_id' => $request->input('paciente_id'),
                'comentario' => $comentario,
                //'creado_por' => auth()->id(),
            ]);
        }
        return redirect()->route('stocks.index');
    }
}
