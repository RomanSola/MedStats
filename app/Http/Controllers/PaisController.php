<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    public function index()
    {
        $paises = Pais::orderBy('nombre')->get();
        return view('paises.index', compact('paises'));
    }

    public function create()
    {
        return view('paises.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:pais,nombre',
        ]);

        $pais = new Pais();
        $pais->nombre = $request->input('nombre');
        $pais->save();

        return redirect()->route('paises.index')->with('success', 'País creado correctamente.');
    }

    public function edit(Pais $paise) // The variable should match standard binding or we can just use $id
    {
        return view('paises.edit', ['pais' => $paise]);
    }

    public function update(Request $request, Pais $paise)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:pais,nombre,' . $paise->id,
        ]);

        $paise->nombre = $request->input('nombre');
        $paise->save();

        return redirect()->route('paises.index')->with('success', 'País actualizado correctamente.');
    }

    public function destroy(Pais $paise)
    {
        if ($paise->provincias()->exists()) {
            return redirect()->route('paises.index')->with('error', 'No se puede eliminar: este país está asociado a provincias.');
        }

        $paise->delete();
        return redirect()->route('paises.index')->with('success', 'País eliminado correctamente.');
    }
}
