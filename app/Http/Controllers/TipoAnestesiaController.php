<?php

namespace App\Http\Controllers;

use App\Models\Tipo_anestesia;
use Illuminate\Http\Request;

class TipoAnestesiaController extends Controller
{
    public function index() //Pagina inicial
    {
        $anestesias = Tipo_anestesia::all(); //Hace un select all a la tabla
        //dd($anestesias);
        return view('tipoAnestesias.index', compact('anestesias')); //Llama a la vista y le pasa los datos
    }

    public function create()
    {
        return view('tipoAnestesias.create');
    }

    public function store(Request $request)
    {
        $request->validate([ //Si el titulo esta vacio no hace nada 
            'nombre' => 'required',
        ]);

        $anestesia = new Tipo_anestesia();
        $anestesia->nombre = $request->input('nombre'); //Datos del POST se obtiene en request

        //dd($anestesias);
        $anestesia->save(); //Guarda en la BD, si existe lo actualiza, sino crea

        return redirect()->route('tipoAnestesias.index');
    }

    public function edit(Tipo_anestesia $anestesia)
    {
        return view('tipoAnestesias.edit', compact('anestesia'));
    }

    public function update(Request $request, Tipo_anestesia $anestesia)
    {
        $request->validate([ //Si esta vacio no hace nada 
            'nombre' => 'required',
        ]);
        if ($request->input('nombre') != null) {
            $anestesia->nombre = $request->input('nombre');
        }
        $anestesia->save();
        return redirect()->route('tipoAnestesias.index');
    }

    public function destroy(Tipo_anestesia $anestesia)
    {
        $anestesia->delete();
        return redirect()->route('tipoAnestesias.index');
    }
}
