<?php

namespace App\Http\Controllers;

use App\Models\Procedimiento;
use Illuminate\Http\Request;

class ProcedimientoController extends Controller
{
    public function index() //Pagina inicial
    {
        $procedimientos = Procedimiento::all(); //Hace un select all a la tabla
        //dd($procedimientos);
        return view('procedimientos.index', compact('procedimientos')); //Llama a la vista y le pasa los datos
    }

    public function show(Procedimiento $procedimiento)
    {
        return view('procedimientos.show', compact('procedimiento'));
    }

    public function create()
    {
        return view('procedimientos.create');
    }

    public function store(Request $request)
    {
        $request->validate([ //Si el titulo esta vacio no hace nada 
            'nombre_procedimiento' => 'required',
        ]);

        $procedimiento = new Procedimiento();
        $procedimiento->nombre_procedimiento = $request->input('nombre_procedimiento'); //Datos del POST se obtiene en request
        $procedimiento->descripcion = $request->input('descripcion'); //Datos del POST se obtiene en request

        //dd($procedimientos);
        $procedimiento->save(); //Guarda en la BD, si existe lo actualiza, sino crea

        return redirect()->route('procedimientos.index');
    }

    public function edit(Procedimiento $procedimiento)
    {
        return view('procedimientos.edit', compact('procedimiento'));
    }

    public function update(Request $request, Procedimiento $procedimiento)
    {
        $request->validate([ //Si esta vacio no hace nada 
            'nombre_procedimiento' => 'required',
        ]);
        if ($request->input('nombre_procedimiento') != null) {
            $procedimiento->nombre_procedimiento = $request->input('nombre_procedimiento');
        }
        $procedimiento->descripcion = $request->input('descripcion');
        $procedimiento->save();
        return redirect()->route('procedimientos.index');
    }

    public function destroy(Procedimiento $procedimiento)
    {
        $procedimiento->delete();
        return redirect()->route('procedimientos.index');
    }
}
