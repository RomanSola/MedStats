<?php

namespace App\Http\Controllers;
use App\Models\Sala;
use App\Models\Cama;
use App\Models\Habitacion;
use Illuminate\Http\Request;

class CamaController extends Controller
{
    public function index(Request $request)
{
    // Obtener todas las salas para el select
    $salas = Sala::all();

    // Construir la consulta base con la relación de habitación
    $camas = Cama::with('get_habitacion');

    // Si se seleccionó una sala, filtrar por ella
    if ($request->filled('sala_id')) {
        $camas->whereHas('get_habitacion', function ($query) use ($request) {
            $query->where('sala_id', $request->sala_id);
        });
    }

    // Ejecutar la consulta
    $camas = $camas->get();

    // 🔹 Pacientes que no tienen cama asignada
    $pacientesLibres = \App\Models\Paciente::whereNull('cama_id')->get();

    // Pasar camas, salas y pacientes libres a la vista
    return view('camas.index', compact('camas', 'salas', 'pacientesLibres'));
}

    public function create()
    {
        $salas = Sala::all();
        $habitaciones = Habitacion::where('sala_id', request('sala_id'))->get();

        
        return view('camas.create', compact('habitaciones','salas'));
    }

    public function store(Request $request)
    {   
        $request->validate([
            'codigo' => 'required',
            'habitacion_id' => 'required|exists:habitacions,id',
        ]);

        $cama = new Cama();
        $cama->codigo = $request->input('codigo'); //Datos del POST se obtiene en request
        $cama->habitacion_id = $request->input('habitacion_id'); //Datos del POST se obtiene en request
        $cama->save(); //Guarda en la BD, si existe lo actualiza, sino crea

        return redirect()->route('camas.index');
    }

    public function edit(Cama $cama)
    {
        $habitaciones = Habitacion::all();
        //dd($salas);
        return view('camas.edit', compact('cama', 'habitaciones'));
    }

    public function update(Request $request, Cama $cama)
    {
        $request->validate([
            'codigo' => 'required',
            'habitacion_id' => 'required|exists:habitacions,id',
        ]);
        
        if ($request->input('codigo') != null) {
            $cama->codigo = $request->input('codigo');
        }
        $cama->habitacion_id = $request->input('habitacion_id');
        $cama->save();
        return redirect()->route('camas.index');
    }

    public function destroy(Cama $cama)
    {
        $cama->delete();
        return redirect()->route('camas.index');
    }
}
