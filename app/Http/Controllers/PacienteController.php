<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Codigo_postal;
use Illuminate\Http\Request;

class PacienteController extends Controller
{

    //Muestra todos los datos
    public function index() //Pagina inicial
    {
        $pacientes = Paciente::all(); //Hace un select all a la tabla
        //dd($pacientes);
        return view('pacientes.index', compact('pacientes')); //Llama a la vista y le pasa las pacientes obtenidas
    }

    public function show(Paciente $paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }
    public function create()
    {
        /*
        $paises = Pais::all();
        $provincias = Provincia::all();
        $codigosPostales = Codigo_postal::all();
        */
        
        $paises = Pais::all();
        return view('pacientes.create', compact('paises'));
    }

    public function store(Request $request)
    {
        $request->validate([ //Si el titulo esta vacion no hace nada 
            'dni' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'pais_id' => 'required|exists:pais,id',
            'provincia_id' => 'required|exists:provincias,id',
            'cod_postal_id' => 'required|exists:codigo_postals,id',
        ]);

        $paciente = new paciente();
        //Datos del POST se obtiene en request
        $paciente->dni = $request->input('dni');
        $paciente->nombre = $request->input('nombre');
        $paciente->apellido = $request->input('apellido');
        $paciente->fecha_nacimiento = $request->input('fecha_nacimiento');
        $paciente->telefono = $request->input('genero');
        $paciente->telefono = $request->input('telefono');
        $paciente->pais_id = $request->input('pais_id');
        $paciente->provincia_id = $request->input('provincia_id');
        // $paciente->cod_postal_id = $request->input('cod_postal_id');
        $paciente->direccion = $request->input('direccion');
        //COMPLETAR CON EL USUARIO:
        $paciente->creado_por = '1';
        $paciente->modificado_por = '1';

        $paciente->save(); //Guarda en la BD, si existe lo actualiza, sino crea

        return redirect()->route('pacientes.index');
    }

    public function edit(Paciente $paciente)
    {
        $paises = Pais::all();
        return view('pacientes.edit', compact('paciente', 'paises'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'dni' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'pais_id' => 'required|exists:pais,id',
            'provincia_id' => 'required|exists:provincias,id',
            'cod_postal_id' => 'required|exists:codigo_postals,id',
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
        $paciente->delete();
        return redirect()->route('pacientes.index');
    }
}
