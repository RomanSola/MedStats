<?php

namespace App\Http\Controllers;

use App\Models\PlantillaProgramacion;
use App\Models\Especialidad;
use App\Models\Procedimiento;
use App\Models\Empleado;
use Illuminate\Http\Request;

class PlantillaProgramacionController extends Controller
{
    public function index()
    {
        $plantillas = PlantillaProgramacion::orderBy('dia_semana')
            ->orderBy('quirofano')
            ->orderBy('hora')
            ->get();

        $especialidades = Especialidad::orderBy('nombre')->get();
        $procedimientos = Procedimiento::orderBy('nombre_procedimiento')->get();
        $cirujanos = Empleado::orderBy('apellido')->orderBy('nombre')->get();

        $quirofanosList = ['Quirófano 1', 'Quirófano 2', 'Quirófano 3', 'Quirófano 4'];

        return view('plantillas_programacion.index', compact('plantillas', 'especialidades', 'procedimientos', 'cirujanos', 'quirofanosList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dia_semana' => 'required|integer|between:1,7',
            'quirofano' => 'required|string|max:255',
            'hora' => 'nullable|string|max:50',
            'especialidad' => 'required|string|max:255',
            'procedimiento' => 'nullable|string|max:255',
            'cirujano' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        $validated['activo'] = true;

        PlantillaProgramacion::create($validated);

        return redirect()->route('plantillas-programacion.index')
            ->with('exito', 'Plantilla recurrente creada correctamente.');
    }

    public function update(Request $request, $id)
    {
        $plantilla = PlantillaProgramacion::findOrFail($id);

        $validated = $request->validate([
            'dia_semana' => 'required|integer|between:1,7',
            'quirofano' => 'required|string|max:255',
            'hora' => 'nullable|string|max:50',
            'especialidad' => 'required|string|max:255',
            'procedimiento' => 'nullable|string|max:255',
            'cirujano' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
            'activo' => 'nullable|boolean',
        ]);

        $validated['activo'] = $request->has('activo') ? $request->boolean('activo') : true;

        $plantilla->update($validated);

        return redirect()->route('plantillas-programacion.index')
            ->with('exito', 'Plantilla recurrente actualizada correctamente.');
    }

    public function destroy($id)
    {
        $plantilla = PlantillaProgramacion::findOrFail($id);
        $plantilla->delete();

        return redirect()->route('plantillas-programacion.index')
            ->with('exito', 'Plantilla recurrente eliminada.');
    }
}
