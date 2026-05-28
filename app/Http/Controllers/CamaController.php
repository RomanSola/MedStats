<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Cama;
use App\Models\Habitacion;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CamaController extends Controller
{
    public function index(Request $request)
{
    $salas = Sala::all();
    $camas = Cama::with(['get_habitacion', 'paciente']);

    if ($request->filled('sala_id')) {
        $camas->whereHas('get_habitacion', function ($query) use ($request) {
            $query->where('sala_id', $request->sala_id);
        });
    }

    $camas = $camas->get();
    $pacientesLibres = Paciente::whereNull('cama_id')->get();

    // Detectar si viene desde ajustes
    if (Route::currentRouteName() === 'camas.listar') {
        return view('camas.listar', compact('camas', 'salas', 'pacientesLibres'));
    }

    // Vista por defecto para el acceso desde el inicio
    return view('camas.index', compact('camas', 'salas', 'pacientesLibres'));
}

    public function create()
    {
        $salas = Sala::all();
        $habitaciones = [];

        if (request()->filled('sala_id')) {
            $habitaciones = Habitacion::where('sala_id', request('sala_id'))->get();
        }

        return view('camas.create', compact('salas', 'habitaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:camas,codigo',
            'habitacion_id' => 'required|exists:habitacions,id',
        ]);

        Cama::create([
            'codigo' => $request->codigo,
            'habitacion_id' => $request->habitacion_id,
            'ocupada' => false,
        ]);

        return redirect()->route('camas.index')->with('success', 'Cama creada correctamente.');
    }

    public function edit(Cama $cama)
    {
        $habitaciones = Habitacion::with('get_sala')->get();
        return view('camas.edit', compact('cama', 'habitaciones'));
    }

    public function update(Request $request, Cama $cama)
    {
        $request->validate([
            'codigo' => 'required|unique:camas,codigo,' . $cama->id,
            'habitacion_id' => 'required|exists:habitacions,id',
        ]);

        $cama->update([
            'codigo' => $request->codigo,
            'habitacion_id' => $request->habitacion_id,
        ]);

        return redirect()->route('camas.index')->with('success', 'Cama actualizada correctamente.');
    }

    public function destroy(Cama $cama)
    {
        if ($cama->ocupada) {
            return back()->with('error', 'No se puede eliminar una cama ocupada.');
        }

        $cama->delete();
        return redirect()->route('camas.index')->with('success', 'Cama eliminada correctamente.');
    }
}

