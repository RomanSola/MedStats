<?php

namespace App\Http\Controllers;

use App\Models\Codigo_postal;
use App\Models\Pais;
use App\Models\Provincia;
use Illuminate\Http\Request;

class CodigoPostalController extends Controller
{
    public function index()
    {
        $codigos = Codigo_postal::with(['pais', 'provincia'])->orderBy('localidad')->get();
        return view('codigos_postales.index', compact('codigos'));
    }

    public function create()
    {
        $paises = Pais::orderBy('nombre')->get();
        $provincias = Provincia::orderBy('nombre')->get();
        return view('codigos_postales.create', compact('paises', 'provincias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:10',
            'localidad' => 'required|string|max:50',
            'pais_id' => 'nullable|exists:pais,id',
            'provincia_id' => 'nullable|exists:provincias,id',
        ]);

        $codigo = new Codigo_postal();
        $codigo->codigo = $request->input('codigo');
        $codigo->localidad = $request->input('localidad');
        $codigo->pais_id = $request->input('pais_id');
        $codigo->provincia_id = $request->input('provincia_id');
        $codigo->save();

        return redirect()->route('codigos_postales.index')->with('success', 'Código Postal creado correctamente.');
    }

    public function edit($id) // use generic ID since binding might be wonky with underscores
    {
        $codigo_postale = Codigo_postal::findOrFail($id);
        $paises = Pais::orderBy('nombre')->get();
        $provincias = Provincia::orderBy('nombre')->get();
        return view('codigos_postales.edit', compact('codigo_postale', 'paises', 'provincias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required|string|max:10',
            'localidad' => 'required|string|max:50',
            'pais_id' => 'nullable|exists:pais,id',
            'provincia_id' => 'nullable|exists:provincias,id',
        ]);

        $codigo = Codigo_postal::findOrFail($id);
        $codigo->codigo = $request->input('codigo');
        $codigo->localidad = $request->input('localidad');
        $codigo->pais_id = $request->input('pais_id');
        $codigo->provincia_id = $request->input('provincia_id');
        $codigo->save();

        return redirect()->route('codigos_postales.index')->with('success', 'Código Postal actualizado correctamente.');
    }

    public function destroy($id)
    {
        $codigo = Codigo_postal::findOrFail($id);
        $codigo->delete();
        return redirect()->route('codigos_postales.index')->with('success', 'Código Postal eliminado correctamente.');
    }
}
