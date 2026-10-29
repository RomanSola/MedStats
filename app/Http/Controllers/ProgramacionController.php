<?php

namespace App\Http\Controllers;

use App\Models\Programacion;
use Illuminate\Http\Request;

class ProgramacionController extends Controller
{
    /**
     * Store a newly created schedule entry in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha'         => 'required|date',
            'quirofano'     => 'required|string|max:255',
            'paciente'      => 'nullable|string|max:255',
            'especialidad'  => 'required|string|max:255',
            'procedimiento' => 'nullable|string|max:255',
            'cirujano'      => 'nullable|string|max:255',
            'hora'          => 'nullable|string|max:50',
            'observaciones' => 'nullable|string',
            'realizada'     => 'nullable|boolean',
            'suspendida'    => 'nullable|boolean',
        ]);

        $validated['realizada']  = $request->boolean('realizada');
        $validated['suspendida'] = $request->boolean('suspendida');
        $validated['es_reserva'] = empty(trim($validated['paciente'] ?? ''));
        $validated['user_id']    = auth()->id();

        Programacion::create($validated);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Programación agregada correctamente']);
        }

        // Incluir fecha_programacion para que el selector de fecha del tab quede sincronizado
        return redirect()->route('cirugias.index', [
                'tab'               => 'programacion',
                'fecha'             => $validated['fecha'],
                'fecha_programacion' => $validated['fecha'],
            ])->with('exito', 'Programación guardada correctamente.');
    }

    /**
     * Check if the schedule entry is still editable / deletable.
     * Deadline: up to 16:00 hs of the day BEFORE the scheduled date.
     */
    protected function isEditable(Programacion $programacion): bool
    {
        // Limite: 16:00 hs del día anterior a la fecha de la cirugía
        $limite = \Carbon\Carbon::parse($programacion->fecha)->subDay()->setTime(16, 0, 0);
        return \Carbon\Carbon::now()->lessThanOrEqualTo($limite);
    }

    /**
     * Update the specified schedule entry in storage.
     */
    public function update(Request $request, Programacion $programacion)
    {
        if (!$this->isEditable($programacion)) {
            $msg = 'No se puede editar esta programación. El límite de edición es hasta las 16:00 hs del día anterior.';
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $msg], 403);
            }
            return redirect()->back()->with('error', $msg);
        }

        $validated = $request->validate([
            'fecha' => 'required|date',
            'quirofano' => 'required|string|max:255',
            'paciente' => 'nullable|string|max:255',
            'especialidad' => 'required|string|max:255',
            'procedimiento' => 'nullable|string|max:255',
            'cirujano' => 'nullable|string|max:255',
            'hora' => 'nullable|string|max:50',
            'observaciones' => 'nullable|string',
            'realizada' => 'nullable|boolean',
            'suspendida' => 'nullable|boolean',
        ]);

        $validated['realizada'] = $request->boolean('realizada');
        $validated['suspendida'] = $request->boolean('suspendida');
        $validated['es_reserva'] = empty(trim($validated['paciente'] ?? ''));
        $validated['updated_by_user_id'] = auth()->id();

        $programacion->update($validated);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Programación actualizada correctamente']);
        }

        return redirect()->route('cirugias.index', [
                'tab'               => 'programacion',
                'fecha'             => $validated['fecha'],
                'fecha_programacion' => $validated['fecha'],
            ])->with('exito', 'Programación actualizada correctamente.');
    }

    /**
     * Toggle status (realizada / suspendida) via AJAX
     */
    public function toggleEstado(Request $request, Programacion $programacion)
    {
        $validated = $request->validate([
            'campo' => 'required|in:realizada,suspendida',
            'valor' => 'required|boolean',
        ]);

        $campo = $validated['campo'];
        $valor = (bool)$validated['valor'];

        if ($campo === 'realizada') {
            $programacion->realizada = $valor;
            if ($valor) {
                $programacion->suspendida = false;
            }
        } elseif ($campo === 'suspendida') {
            $programacion->suspendida = $valor;
            if ($valor) {
                $programacion->realizada = false;
            }
        }

        $programacion->save();

        return response()->json([
            'success' => true,
            'realizada' => (bool)$programacion->realizada,
            'suspendida' => (bool)$programacion->suspendida,
            'message' => 'Estado actualizado correctamente'
        ]);
    }

    /**
     * Remove the specified schedule entry from storage.
     */
    public function destroy(Request $request, Programacion $programacion)
    {
        if (!$this->isEditable($programacion)) {
            $msg = 'No se puede eliminar esta programación. El límite de eliminación es hasta las 16:00 hs del día anterior.';
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $msg], 403);
            }
            return redirect()->back()->with('error', $msg);
        }

        $fecha = $programacion->fecha;
        $programacion->delete();

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Programación eliminada correctamente']);
        }

        return redirect()->route('cirugias.index', [
                'tab'               => 'programacion',
                'fecha'             => $fecha,
                'fecha_programacion' => $fecha,
            ])->with('exito', 'Programación eliminada correctamente.');
    }

    /**
     * Update only the observaciones field — no time-lock restriction.
     * Allows users to annotate suspension reasons even after the edit deadline.
     */
    public function updateObservaciones(Request $request, Programacion $programacion)
    {
        $validated = $request->validate([
            'observaciones' => 'nullable|string',
        ]);

        $programacion->observaciones      = $validated['observaciones'] ?? null;
        $programacion->updated_by_user_id  = auth()->id();
        $programacion->save();

        return response()->json([
            'success'      => true,
            'message'      => 'Observaciones actualizadas correctamente',
            'editor_name'  => auth()->user()->name,
        ]);
    }
}
