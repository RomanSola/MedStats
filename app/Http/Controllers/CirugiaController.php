<?php

namespace App\Http\Controllers;

use App\Models\Cirugia;
use App\Models\Paciente;
use App\Models\Empleado;
use App\Models\Procedimiento;
use App\Models\Quirofano;
use App\Models\Tipo_anestesia;
use Illuminate\Http\Request;

class CirugiaController extends Controller
{

    //Muestra todos los datos
    public function index() //Pagina inicial
    {
        //$cirugias = Tarea::all(); //Hace un select all a la tabla
        //Llama a la funcion get_categoria del modelo tarea.php
        $cirugias = Cirugia::with(['get_paciente', 'get_procedimiento', 'get_quirofano', 'get_cirujano', 'get_ayudante1', 'get_ayudante2', 'get_ayudante3', 'get_anestesista', 'get_instrumentador', 'get_tipo_anestesia'])->get();
        //dd($cirugias);
        return view('cirugias.index', compact('cirugias')); //Llama a la vista y le pasa las Cirugias obtenidas
    }

    public function show(Cirugia $cirugia)
    {
        return view('cirugias.show', compact('cirugia'));
    }
    public function create()
    {
        $pacientes = Paciente::all();
        $empleados = Empleado::all();
        $procedimientos = Procedimiento::all();
        $quirofanos = Quirofano::all();
        $tipoAnestesias = Tipo_anestesia::all();
        return view('cirugias.create', compact('pacientes', 'empleados', 'procedimientos', 'quirofanos', 'tipoAnestesias'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'procedimiento_id' => 'required|exists:procedimientos,id',
            'quirofano_id' => 'required|exists:quirofanos,id',
            'cirujano_id' => 'required|exists:empleados,id',
            'anestesista_id' => 'required|exists:empleados,id',
            'tipo_anestesia_id' => 'required|exists:tipo_anestesias,id',
            'instrumentador_id' => 'required|exists:empleados,id',
        ]);

        if ($request->input('ayudante_1_id') != null) {
            $request->validate([
                'ayudante_1_id' => 'exists:empleados,id',
            ]);
        }
        if ($request->input('ayudante_2_id') != null) {
            $request->validate([
                'ayudante_2_id' => 'exists:empleados,id',
            ]);
        }
        if ($request->input('ayudante_3_id') != null) {
            $request->validate([
                'ayudante_3_id' => 'exists:empleados,id',
            ]);
        }

        $cirugia = new Cirugia();
        //Datos del POST se obtiene en request
        $cirugia->paciente_id = $request->input('paciente_id');
        $cirugia->procedimiento_id = $request->input('procedimiento_id');
        $cirugia->quirofano_id = $request->input('quirofano_id');
        $cirugia->cirujano_id = $request->input('cirujano_id');
        $cirugia->ayudante_1_id = $request->input('ayudante_1_id');
        $cirugia->ayudante_2_id = $request->input('ayudante_2_id');
        $cirugia->ayudante_3_id = $request->input('ayudante_3_id');
        $cirugia->anestesista_id = $request->input('anestesista_id');
        $cirugia->tipo_anestesia_id = $request->input('tipo_anestesia_id');
        $cirugia->instrumentador_id = $request->input('instrumentador_id');
        //Reemplazar cuando tengamos los usuarios
        $cirugia->creado_por = '1';
        $cirugia->modificado_por = '1';

        if ($request->input('urgencia') != null) {
            $cirugia->urgencia = true;
        } else {
            $cirugia->urgencia = false;
        }

        $cirugia->save(); //Guarda en la BD, si existe lo actualiza, sino crea

        return redirect()->route('cirugias.index');
    }

    public function edit(Cirugia $cirugia)
    {
        $pacientes = Paciente::all();
        $empleados = Empleado::all();
        $procedimientos = Procedimiento::all();
        $quirofanos = Quirofano::all();
        $tipoAnestesias = Tipo_anestesia::all();
    
        return view('cirugias.edit', compact('cirugia', 'pacientes', 'empleados', 'procedimientos', 'quirofanos', 'tipoAnestesias'));
    }

    public function update(Request $request, Cirugia $cirugia)
    {   //dd($request->all());
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'procedimiento_id' => 'required|exists:procedimientos,id',
            'quirofano_id' => 'required|exists:quirofanos,id',
            'cirujano_id' => 'required|exists:empleados,id',
            'anestesista_id' => 'required|exists:empleados,id',
            'tipo_anestesia_id' => 'required|exists:tipo_anestesias,id',
            'instrumentador_id' => 'required|exists:empleados,id',
        ]);
        if ($request->input('ayudante_1_id') != null) {
            $request->validate([
                'ayudante_1_id' => 'exists:empleados,id',
            ]);
        }
        if ($request->input('ayudante_2_id') != null) {
            $request->validate([
                'ayudante_2_id' => 'exists:empleados,id',
            ]);
        }
        if ($request->input('ayudante_3_id') != null) {
            $request->validate([
                'ayudante_3_id' => 'exists:empleados,id',
            ]);
        }

        if ($request->input('paciente_id') != null) {
            $cirugia->paciente_id = $request->input('paciente_id');
        }
        if ($request->input('procedimiento_id') != null) {
            $cirugia->procedimiento_id = $request->input('procedimiento_id');
        }
        if ($request->input('quirofano_id') != null) {
            $cirugia->quirofano_id = $request->input('quirofano_id');
        }
        if ($request->input('cirujano_id') != null) {
            $cirugia->cirujano_id = $request->input('cirujano_id');
        }
        if ($request->input('ayudante_1_id') != null) {
            $cirugia->ayudante_1_id = $request->input('ayudante_1_id');
        }
        if ($request->input('ayudante_2_id') != null) {
            $cirugia->ayudante_2_id = $request->input('ayudante_2_id');
        }
        if ($request->input('ayudante_3_id') != null) {
            $cirugia->ayudante_3_id = $request->input('ayudante_3_id');
        }
        if ($request->input('anestesista_id') != null) {
            $cirugia->anestesista_id = $request->input('anestesista_id');
        }
        if ($request->input('tipo_anestesia_id') != null) {
            $cirugia->tipo_anestesia_id = $request->input('tipo_anestesia_id');
        }
        if ($request->input('instrumentador_id') != null) {
            $cirugia->instrumentador_id = $request->input('instrumentador_id');
        }
        if ($request->input('urgencia') != null) {
            $cirugia->urgencia = true;
        } else {
            $cirugia->urgencia = false;
        }

        $cirugia->save();
        return redirect()->route('cirugias.index');
    }

    public function destroy(Cirugia $cirugia)
    {
        $cirugia->delete();
        return redirect()->route('cirugias.index');
    }
}
