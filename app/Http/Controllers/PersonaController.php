<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function buscar(Request $request)
{
    $term = $request->get('term');

    // Si viene desde el autocomplete (AJAX), devuelve JSON
    if ($request->ajax()) {
        $personas = Persona::where('nombre', 'LIKE', "%{$term}%")
            ->orWhere('apellido', 'LIKE', "%{$term}%")
            ->orWhere('dni', 'LIKE', "%{$term}%")
            ->get();

        return response()->json($personas);
    }

    // Si viene desde el formulario con "busqueda"
    $busqueda = $request->get('busqueda');
    $resultados = Persona::where('nombre', 'LIKE', "%{$busqueda}%")
        ->orWhere('apellido', 'LIKE', "%{$busqueda}%")
        ->orWhere('dni', 'LIKE', "%{$busqueda}%")
        ->get();

    return view('busqueda.resultados', compact('resultados', 'busqueda'));
}


public function ver($id)
{
    $persona = Persona::findOrFail($id);
    return view('busqueda.resultados', compact('persona'));
}

//public function ver($id)
//{
    //$persona = Persona::with('remedios')->findOrFail($id);//Conecta la tabla persona comn la tabla remedios
    //return view('show', compact('persona'));

//}

}
