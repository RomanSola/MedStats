<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    //Muestra todos los medicamentos
    public function index() //Pagina inicial
    {
        $medicamentos = Medicamento::all(); //Hace un select all a la tabla
        //dd($medicamentos);
        return view('medicamentos.index', compact('medicamentos')); //Llama a la vista y le pasa los datos
    }

    public function create()
    {
        return view('medicamentos.create');
    }

    public function store(Request $request)
    {
        $request->validate([ //Si el nombre esta vacio no hace nada 
            'nombre' => 'required',
        ]);

        $medicamento = new Medicamento();
        $medicamento->nombre = $request->input('nombre'); //Datos del POST se obtiene en request
        $medicamento->save(); //Guarda en la BD, si existe lo actualiza, sino crea
        
        return redirect()->route('medicamentos.index');
    }

    public function edit(Medicamento $medicamento)
    {
        return view('medicamentos.edit', compact('medicamento'));
    }

    public function update(Request $request, Medicamento $medicamento)
    {
        $request->validate([ //Si el nombre esta vacio no hace nada 
            'nombre' => 'required',
        ]);

        if ($request->input('nombre') != null) {
            $medicamento->nombre = $request->input('nombre');
        }
        $medicamento->save();
        return redirect()->route('medicamentos.index');
    }

    public function destroy(Medicamento $medicamento)
    {
        $medicamento->delete();
        return redirect()->route('medicamentos.index');
    }
}
