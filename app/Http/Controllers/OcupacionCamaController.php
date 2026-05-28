<?php

namespace App\Http\Controllers;

use App\Models\Ocupacion_cama;
use App\Models\Cama;
use App\Models\Paciente;
use Illuminate\Http\Request;

class OcupacionCamaController extends Controller
{
    //Muestra todos los datos
    public function index() //Pagina inicial
    {
        //$oc_camas = Tarea::all(); //Hace un select all a la tabla
        //Llama a la funcion get_categoria del modelo tarea.php
        $oc_camas = Ocupacion_cama::with(['get_paciente', 'get_cama'])->get();
        //dd($oc_camas);
        return view('ocupacionCamas.index', compact('oc_camas')); //Llama a la vista y le pasa las camas obtenidas
    }

    public function show(Ocupacion_cama $oc_cama)
    {
        return view('ocupacionCamas.show', compact('oc_cama'));
    }
    public function create()
    {
        $camas = Cama::all();
        $pacientes = Paciente::all();
        //$provincias = Provincia::all();
        return view('ocupacionCamas.create', compact('pacientes', 'camas'));
    }

    public function store(Request $request)
    {
        $request->validate([ //Si no se cumplen no hace nada 
            'cama_id' => 'required|exists:camas,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_ingreso' => 'required',
        ]);

        $oc_cama = new Ocupacion_cama();
        //Datos del POST se obtiene en request
        $oc_cama->cama_id = $request->input('cama_id');
        $oc_cama->paciente_id = $request->input('paciente_id');
        $oc_cama->fecha_ingreso = $request->input('fecha_ingreso');
        $oc_cama->observaciones = $request->input('observaciones');
        $oc_cama->save(); //Guarda en la BD, si existe lo actualiza, sino crea

        return redirect()->route('ocupacionCamas.index');
    }

    public function edit(Ocupacion_cama $oc_cama)
    {
        $camas = Cama::all();
        $pacientes = Paciente::all();
        return view('ocupacionCamas.edit', compact('oc_cama', 'camas', 'pacientes'));
    }

    public function darAlta(Ocupacion_cama $oc_cama)
    {
        return view('ocupacionCamas.darAlta', compact('oc_cama'));
    }

    public function update(Request $request, Ocupacion_cama $oc_cama)
    {
        //dd($request->all());
        $request->validate([ //Si no se cumplen no hace nada 
            'cama_id' => 'required|exists:camas,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_ingreso' => 'required',
            'fecha_egreso' => 'nullable|date|after_or_equal:fecha_ingreso',
        ]);

        if ($request->input('cama_id') != null) {
        $oc_cama->cama_id = $request->input('cama_id');
        }
        if ($request->input('paciente_id') != null) {
        $oc_cama->paciente_id = $request->input('paciente_id');
        }
        if ($request->input('fecha_ingreso') != null) {
        $oc_cama->fecha_ingreso = $request->input('fecha_ingreso');
        }
        if ($request->input('fecha_egreso') != null) {
        $oc_cama->fecha_egreso = $request->input('fecha_egreso');
        }
        if ($request->input('observaciones') != null) {
        $oc_cama->observaciones = $request->input('observaciones');
        }

        $oc_cama->save();
        return redirect()->route('ocupacionCamas.index');
    }

    public function destroy(Ocupacion_cama $oc_cama)
    {
        $oc_cama->delete();
        return redirect()->route('ocupacionCamas.index');
    }
}
