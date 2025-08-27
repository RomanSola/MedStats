<?php

namespace App\Http\Controllers;

use App\Models\Cama;
use App\Models\Paciente;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Codigo_postal;
use Illuminate\Http\Request;
use App\Models\Habitacion;
use App\Models\Ocupacion_cama;
use App\Models\Sala;

class PacienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Paciente::query();

        if ($request->filled('buscar')) {
            $busqueda = $request->buscar;
            $query->where(function($q) use ($busqueda) {
                $q->where('dni', 'like', "%$busqueda%")
                  ->orWhere('nombre', 'like', "%$busqueda%")
                  ->orWhere('apellido', 'like', "%$busqueda%");
            });
        }

        $pacientes = $query->get();

        // 🔹 Contexto de cama si venís desde "Camas"
        $camaContext = null;
        if ($request->filled('cama')) {
            $camaId = (int) $request->query('cama');
            $camaContext = Cama::with('habitacion.sala')
                ->where('ocupada', false)
                ->find($camaId);
        }

        return view('pacientes.index', compact('pacientes', 'camaContext'));
    }

    public function show(Paciente $paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }

    public function create()
    {
        $paises = Pais::all();
        return view('pacientes.create', compact('paises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|digits_between:6,15|unique:pacientes,dni,',
            'nombre' => 'required',
            'apellido' => 'required',
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'pais_id' => 'required|exists:pais,id',
            'provincia_id' => 'required|exists:provincias,id',
            'cod_postal_id' => 'required|exists:codigo_postals,id',
        ], [
            'dni.digits_between' => 'El DNI debe contener solo números entre 6 y 15 dígitos.',
            'dni.unique' => 'Ya existe otro paciente con ese DNI.',
        ]);

        $paciente = new Paciente();
        $paciente->dni = $request->input('dni');
        $paciente->nombre = $request->input('nombre');
        $paciente->apellido = $request->input('apellido');
        $paciente->fecha_nacimiento = $request->input('fecha_nacimiento');
        $paciente->genero = $request->input('genero');
        $paciente->telefono = $request->input('telefono');
        $paciente->pais_id = $request->input('pais_id');
        $paciente->provincia_id = $request->input('provincia_id');
        $paciente->cod_postal_id = $request->input('cod_postal_id');
        $paciente->direccion = $request->input('direccion');
        $paciente->creado_por = '1';
        $paciente->modificado_por = '1';
        $paciente->save();

        return redirect()->route('pacientes.asignar', $paciente->id)
            ->with('success', 'Paciente registrado. Ahora puede asignarle una cama.');
    }

    public function edit(Paciente $paciente)
    {
        $paises = Pais::all();
        return view('pacientes.edit', compact('paciente', 'paises'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'dni' => 'required|digits_between:6,15|unique:pacientes,dni,' . $paciente->id,
            'nombre' => 'required',
            'apellido' => 'required',
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'pais_id' => 'required|exists:pais,id',
            'provincia_id' => 'required|exists:provincias,id',
            'cod_postal_id' => 'required|exists:codigo_postals,id',
        ], [
            'dni.digits_between' => 'El DNI debe contener solo números entre 6 y 15 dígitos.',
            'dni.unique' => 'Ya existe otro paciente con ese DNI.',
        ]);

        if ($request->input('dni') != null) {
            $paciente->dni = $request->input('dni');
        }
        if ($request->input('nombre') != null) {
            $paciente->nombre = $request->input('nombre');
        }
        if ($request->input('apellido') != null) {
            $paciente->apellido = $request->input('apellido');
        }
        if ($request->input('fecha_nacimiento') != null) {
            $paciente->fecha_nacimiento = $request->input('fecha_nacimiento');
        }
        if ($request->input('genero') != null) {
            $paciente->genero = $request->input('genero');
        }

        $paciente->telefono = $request->input('telefono');

        if ($request->input('pais_id') != null) {
            $paciente->pais_id = $request->input('pais_id');
        }
        if ($request->input('provincia_id') != null) {
            $paciente->provincia_id = $request->input('provincia_id');
        }
        if ($request->input('cod_postal_id') != null) {
            $paciente->cod_postal_id = $request->input('cod_postal_id');
        }

        $paciente->direccion = $request->input('direccion');

        $paciente->save();
        return redirect()->route('pacientes.index');
    }

    public function destroy(Paciente $paciente)
    {
        if ($paciente->get_cirugias()->exists() || $paciente->get_historial_stock()->exists() || $paciente->get_ocupacion_cama()->exists()) {
            return redirect()->route('pacientes.index')
                ->with('error', 'No se puede eliminar el paciente porque tiene registros asociados.');
        }
        $paciente->delete();
        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado.');
    }

    public function asignar(Paciente $paciente)
    {
        $salas = Sala::with(['habitaciones.camas' => function ($query) {
            $query->where('ocupada', false);
        }])->get();

        return view('pacientes.asignar', compact('paciente', 'salas'));
    }

    public function guardarAsignacion(Request $request, Paciente $paciente)
    {
        $request->validate([
            'habitacion_id' => 'required|exists:habitacions,id',
            'cama_id' => 'required|exists:camas,id',
        ]);

        $paciente->habitacion_id = $request->habitacion_id;
        $paciente->cama_id = $request->cama_id;
        $paciente->save();

        $cama = Cama::find($request->cama_id);
        $cama->ocupada = true;
        $cama->save();

        Ocupacion_cama::create([
            'paciente_id' => $paciente->id,
            'cama_id' => $request->cama_id,
            'fecha_ingreso' => now()
        ]);

        return redirect()->route('pacientes.index')->with('success', 'Paciente asignado correctamente.');
    }

    public function asignarDirecta(Request $request, Paciente $paciente)
{
    $request->validate([
        'cama_id' => 'required|exists:camas,id',
    ]);

    $cama = Cama::findOrFail($request->cama_id);

    if ($cama->ocupada) {
        return back()->with('error', 'La cama seleccionada ya está ocupada.');
    }

    if ($paciente->cama_id) {
        return back()->with('error', 'Este paciente ya tiene una cama asignada.');
    }

    $paciente->habitacion_id = $cama->habitacion_id;
    $paciente->cama_id = $cama->id;
    $paciente->save();

    $cama->ocupada = true;
    $cama->save();

    Ocupacion_cama::create([
        'paciente_id' => $paciente->id,
        'cama_id' => $cama->id,
        'fecha_ingreso' => now()
    ]);

    return redirect()->route('camas.index')->with('success', 'Paciente asignado a la cama correctamente.');
}
public function darDeAlta(Paciente $paciente)
{
    if ($paciente->cama) {
        $paciente->cama->ocupada = false;
        $paciente->cama->save();
    }

    $ocupacion = Ocupacion_cama::where('paciente_id', $paciente->id)
        ->whereNull('fecha_egreso')
        ->latest('fecha_ingreso')
        ->first();

    if ($ocupacion) {
        $ocupacion->fecha_egreso = now();
        $ocupacion->save();
    }

    $paciente->cama_id = null;
    $paciente->habitacion_id = null;
    $paciente->save();

    return redirect()->route('pacientes.index')->with('success', 'Paciente dado de alta y cama liberada.');
}



    
  public function liveSearch(Request $request)
{
    $buscar = $request->input('buscar');

    $pacientes = \App\Models\Paciente::query()
        ->where('nombre', 'like', "%{$buscar}%")
        ->orWhere('apellido', 'like', "%{$buscar}%")
        ->orWhere('dni', 'like', "%{$buscar}%")
        ->limit(10)
        ->get(['id', 'nombre', 'apellido', 'dni']); // Solo columnas necesarias

    return response()->json($pacientes);
}



}
