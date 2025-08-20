<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    public function index() //Pagina inicial
    {
        $salas = Sala::all(); //Hace un select all a la tabla
        //dd($salas);
        return view('salas.index', compact('salas')); //Llama a la vista y le pasa los datos
    }

    public function create()
    {
        
        return view('salas.create');
    }

    public function store(Request $request)
    {
        $request->validate([ //Si el titulo esta vacio no hace nada 
            'nombre' => 'required',
        ]);

        $sala = new Sala();
        $sala->nombre = $request->input('nombre'); //Datos del POST se obtiene en request
        $sala->descripcion = $request->input('descripcion'); //Datos del POST se obtiene en request
        
        //dd($sala);
        $sala->save(); //Guarda en la BD, si existe lo actualiza, sino crea
        
        return redirect()->route('salas.index');
    }

    public function edit(Sala $sala)
    {
        return view('salas.edit', compact('sala'));
    }

    public function update(Request $request, Sala $sala)
    {
        $request->validate([ //Si esta vacio no hace nada 
            'nombre' => 'required',
        ]);

        if ($request->input('nombre') != null) {
            $sala->nombre = $request->input('nombre');
        }
        $sala->descripcion = $request->input('descripcion');
        $sala->save();
        return redirect()->route('salas.index');
    }

    public function destroy(Sala $sala)
    {
        $sala->delete();
        return redirect()->route('salas.index');
    }
}
