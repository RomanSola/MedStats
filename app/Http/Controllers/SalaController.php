<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    public function index() // Página inicial
    {
        $salas = Sala::all(); // Hace un select all a la tabla
        return view('salas.index', compact('salas')); // Llama a la vista y le pasa los datos
    }

    public function create()
    {
        return view('salas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
        ]);

        $sala = new Sala();
        $sala->nombre = $request->input('nombre');
        $sala->descripcion = $request->input('descripcion');
        $sala->save();

        return redirect()->route('salas.index');
    }

    public function edit(Sala $sala)
    {
        return view('salas.edit', compact('sala'));
    }

    public function update(Request $request, Sala $sala)
    {
        $request->validate([
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
        if ($sala->habitaciones()->exists()) {
            return redirect()->route('salas.index')
                ->with('error', 'No se puede eliminar una sala que tiene habitaciones asignadas.');
        }
    
        $sala->delete();
    
        return redirect()->route('salas.index')
            ->with('success', 'Sala eliminada correctamente.');
    }
}
