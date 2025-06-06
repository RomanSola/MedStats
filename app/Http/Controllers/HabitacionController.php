<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Sala;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    //Muestra todos los datos
    public function index() //Pagina inicial
    {
        //Llama a la funcion get_categoria del modelo tarea.php
        $habitaciones = Habitacion::with('get_sala')->get();
        //dd($habitaciones);
        return view('habitaciones.index', compact('habitaciones')); //Llama a la vista y le pasa las tareas obtenidas
    }
    
    public function create()
    {
        $salas = Sala::all();
        return view('habitaciones.create', compact('salas'));
    }

    public function store(Request $request)
    {   
        //dd($request->input('numero'));
        $request->validate([
            'numero' => 'required',
            'sala_id' => 'required|exists:salas,id',
        ]);

        $habitacion = new Habitacion();
        $habitacion->numero = $request->input('numero'); //Datos del POST se obtiene en request
        $habitacion->sala_id = $request->input('sala_id'); //Datos del POST se obtiene en request
        $habitacion->save(); //Guarda en la BD, si existe lo actualiza, sino crea

        return redirect()->route('habitaciones.index');
    }

    public function edit(Habitacion $habitacion)
    {
        $salas = Sala::all();
        //dd($salas);
        return view('habitaciones.edit', compact('habitacion', 'salas'));
    }

    public function update(Request $request, Habitacion $habitacion)
    {
        $request->validate([
            'numero' => 'required',
            'sala_id' => 'required|exists:salas,id',
        ]);
        
        if ($request->input('numero') != null) {
            $habitacion->numero = $request->input('numero');
        }
        $habitacion->sala_id = $request->input('sala_id');
        $habitacion->save();
        return redirect()->route('habitaciones.index');
    }

    public function destroy(Habitacion $habitacion)
    {
        $habitacion->delete();
        return redirect()->route('habitaciones.index');
    }
}
