<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use App\Models\Pais;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
{
    public function index()
    {
        $provincias = Provincia::with('pais')->orderBy('nombre')->get();
        return view('provincias.index', compact('provincias'));
    }

    public function create()
    {
        $paises = Pais::orderBy('nombre')->get();
        return view('provincias.create', compact('paises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'pais_id' => 'required|exists:pais,id',
        ]);

        $provincia = new Provincia();
        $provincia->nombre = $request->input('nombre');
        $provincia->pais_id = $request->input('pais_id');
        $provincia->save();

        return redirect()->route('provincias.index')->with('success', 'Provincia creada correctamente.');
    }

    public function edit(Provincia $provincia)
    {
        $paises = Pais::orderBy('nombre')->get();
        return view('provincias.edit', compact('provincia', 'paises'));
    }

    public function update(Request $request, Provincia $provincia)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'pais_id' => 'required|exists:pais,id',
        ]);

        $provincia->nombre = $request->input('nombre');
        $provincia->pais_id = $request->input('pais_id');
        $provincia->save();

        return redirect()->route('provincias.index')->with('success', 'Provincia actualizada correctamente.');
    }

    public function destroy(Provincia $provincia)
    {
        // Assuming there could be a relation to Codigo_postal
        $hasCodigoPostal = \App\Models\Codigo_postal::where('provincia_id', $provincia->id)->exists();
        if ($hasCodigoPostal) {
            return redirect()->route('provincias.index')->with('error', 'No se puede eliminar: esta provincia está asociada a códigos postales.');
        }

        $provincia->delete();
        return redirect()->route('provincias.index')->with('success', 'Provincia eliminada correctamente.');
    }
}
