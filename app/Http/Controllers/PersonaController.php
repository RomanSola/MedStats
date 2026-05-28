<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
// Ruta AJAX para el autocomplete
public function buscarAjax(Request $request)
{
    $term = $request->get('term');

    if (!$term) {
        return response()->json([]);
    }

    $terms = explode(' ', $term);

    $query = Paciente::query();

    foreach ($terms as $t) {
        $query->where(function($q) use ($t) {
            $q->where('nombre', 'LIKE', "%{$t}%")
              ->orWhere('apellido', 'LIKE', "%{$t}%")
              ->orWhere('dni', 'LIKE', "%{$t}%");
        });
    }

    $personas = $query->limit(10)->get();

    return response()->json($personas->map(function($p) {
        return [
            'id' => $p->id,
            'nombre' => $p->nombre,
            'apellido' => $p->apellido,
            'dni' => $p->dni,
        ];
    }));
}

public function buscar(Request $request)
{
    $busqueda = $request->input('busqueda'); // Nombre del input en el formulario

    if ($request->ajax()) {
        $personas = Paciente::where('nombre', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('apellido', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('dni', 'LIKE', '%' . $busqueda . '%')
            ->get();

        $resultados = $personas->map(function ($p) {
            return [
                'id' => $p->id,
                'nombre' => $p->nombre,
                'apellido' => $p->apellido,
                'dni' => $p->dni
            ];
        });

        return response()->json($resultados);
    }

    // Cuando es búsqueda normal (no AJAX)
    $personas = Paciente::where('nombre', 'LIKE', '%' . $busqueda . '%')
        ->orWhere('apellido', 'LIKE', '%' . $busqueda . '%')
        ->orWhere('dni', 'LIKE', '%' . $busqueda . '%')
        ->get();

    return view('busqueda.resultados', [
        'resultados' => $personas,
        'busqueda' => $busqueda,
    ]);
}


public function ver($id)
{
    $persona = Paciente::findOrFail($id);
    return view('busqueda.resultados', compact('persona'));
}

public function index()
{
    $personas = Paciente::all();
    return view('index', compact('personas'));
}

}
