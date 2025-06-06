<?php

namespace App\Http\Controllers;

use App\Models\Profesion;
use Illuminate\Http\Request;

class ProfesionController extends Controller
{
    public function index() //Pagina inicial
    {
        $profesiones = Profesion::all(); //Hace un select all a la tabla
        //dd($profesiones);
        return view('profesion.index', compact('profesiones')); //Llama a la vista y le pasa los datos
    }

    public function show(Profesion $profesion)
    {
        return view('profesion.show', compact('profesion'));
    }

    public function create()
    {
        return view('profesion.create');
    }

    public function store(Request $request)
    {
        $request->validate([ //Si el titulo esta vacio no hace nada 
            'nombre_profesion' => 'required',
        ]);

        $profesion = new Profesion();
        $profesion->nombre_profesion = $request->input('nombre_profesion'); //Datos del POST se obtiene en request
        $profesion->descripcion = $request->input('descripcion'); //Datos del POST se obtiene en request
        
        //dd($profesion);
        $profesion->save(); //Guarda en la BD, si existe lo actualiza, sino crea
        
        return redirect()->route('profesion.index');
    }

    public function edit(Profesion $profesion)
    {
        return view('profesion.edit', compact('profesion'));
    }

    public function update(Request $request, Profesion $profesion)
    {
        $request->validate([ //Si esta vacio no hace nada 
            'nombre_profesion' => 'required',
        ]);

        if ($request->input('nombre_profesion') != null) {
            $profesion->nombre_profesion = $request->input('nombre_profesion');
        }
        $profesion->descripcion = $request->input('descripcion');
        $profesion->save();
        return redirect()->route('profesion.index');
    }

    public function destroy(Profesion $profesion)
    {
        $profesion->delete();
        return redirect()->route('profesion.index');
    }
}
