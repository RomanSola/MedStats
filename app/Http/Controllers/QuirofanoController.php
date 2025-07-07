<?php

namespace App\Http\Controllers;

use App\Models\Quirofano;
use Illuminate\Http\Request;

class QuirofanoController extends Controller
{
    //

    public function index() //Pagina inicial
    {
        $quirofanos = Quirofano::all(); //Hace un select all a la tabla
        //dd($quirofanos);
        return view('quirofanos.index', compact('quirofanos')); //Llama a la vista y le pasa los datos
    }

    public function show(Quirofano $quirofano)
    {
        return view('quirofanos.show', compact('quirofano'));
    }

    public function create()
    {
        return view('quirofanos.create');
    }

    public function store(Request $request)
    {
        $request->validate([ //Si el titulo esta vacio no hace nada 
            'nombre' => 'required',
        ]);

        $quirofano = new Quirofano();
        $quirofano->nombre = $request->input('nombre'); //Datos del POST se obtiene en request
        $quirofano->descripcion = $request->input('descripcion'); //Datos del POST se obtiene en request

        //dd($quirofanos);
        $quirofano->save(); //Guarda en la BD, si existe lo actualiza, sino crea

        return redirect()->route('quirofanos.index');
    }

    public function edit(Quirofano $quirofano)
    {
        return view('quirofanos.edit', compact('quirofano'));
    }

    public function update(Request $request, Quirofano $quirofano)
    {
        $request->validate([ //Si esta vacio no hace nada 
            'nombre' => 'required',
        ]);
        if ($request->input('nombre') != null) {
            $quirofano->nombre = $request->input('nombre');
        }
        $quirofano->descripcion = $request->input('descripcion');
        $quirofano->save();
        return redirect()->route('quirofanos.index');
    }

    public function destroy(Quirofano $quirofano)
    {
        $quirofano->delete();
        return redirect()->route('quirofanos.index');
    }

}
