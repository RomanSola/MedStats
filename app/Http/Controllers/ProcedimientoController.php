<?php

namespace App\Http\Controllers;

use App\Models\Procedimiento;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class ProcedimientoController extends Controller
{
    public function index() //Pagina inicial
    {
        $procedimientos = Procedimiento::with(['get_especialidad', 'get_especialidad_2'])->get();; //Hace un select all a la tabla
        //dd($procedimientos);
        return view('procedimientos.index', compact('procedimientos')); //Llama a la vista y le pasa los datos
    }

    public function show(Procedimiento $procedimiento)
    {
        return view('procedimientos.show', compact('procedimiento'));
    }

    public function create()
    {
        $especialidades = Especialidad::all();
        return view('procedimientos.create', compact('especialidades'));
    }

    public function store(Request $request)
    {
        $request->validate([ //Si el titulo esta vacio no hace nada 
            'nombre_procedimiento' => 'required',
            'especialidad_id' => 'required|exists:especialidads,id',
        ]);

        $procedimiento = new Procedimiento();
        $procedimiento->nombre_procedimiento = $request->input('nombre_procedimiento'); //Datos del POST se obtiene en request
        $procedimiento->descripcion = $request->input('descripcion'); //Datos del POST se obtiene en request
        $procedimiento->especialidad_id = $request->input('especialidad_id'); //Datos del POST se obtiene en request
        $procedimiento->especialidad_2_id = $request->input('especialidad_2_id'); //Datos del POST se obtiene en request

        //dd($procedimientos);
        $procedimiento->save(); //Guarda en la BD, si existe lo actualiza, sino crea

        return redirect()->route('procedimientos.index');
    }

    public function edit(Procedimiento $procedimiento)
    {
        $especialidades = Especialidad::all();
        return view('procedimientos.edit', compact('procedimiento', 'especialidades'));
    }

    public function update(Request $request, Procedimiento $procedimiento)
    {
        $request->validate([ //Si esta vacio no hace nada 
            'nombre_procedimiento' => 'required',
            'especialidad_id' => 'required|exists:especialidads,id',
        ]);
        if ($request->input('nombre_procedimiento') != null) {
            $procedimiento->nombre_procedimiento = $request->input('nombre_procedimiento');
        }
        $procedimiento->descripcion = $request->input('descripcion');
        $procedimiento->especialidad_id = $request->input('especialidad_id');
        $procedimiento->especialidad_2_id = $request->input('especialidad_2_id');
        $procedimiento->save();
        return redirect()->route('procedimientos.index');
    }

    public function destroy(Procedimiento $procedimiento)
    {
        // Si el procedimiento tiene cirugías asociadas, no se puede eliminar
        if ($procedimiento->cirugias()->exists()) {
            return redirect()->route('procedimientos.index')
                ->with('error', 'No se puede eliminar el procedimiento porque está asignado a una cirugía.');
        }

        $procedimiento->delete();

        return redirect()->route('procedimientos.index')->with('success', 'Procedimiento eliminado correctamente.');
    }

}
