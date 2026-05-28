<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusquedaController extends Controller
{

public function buscar(Request $request)
{
    $query = $request->input('query');

    // Ejemplo básico: buscar en pacientes por nombre
    $pacientes = \App\Models\Paciente::where('nombre', 'like', "%{$query}%")->get();

    return view('busqueda.resultados', compact('query', 'pacientes'));
}


}
