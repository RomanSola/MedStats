<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Pais;
use App\Models\Profesion;
use App\Models\Provincia;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    //Muestra todos los datos
    public function index() //Pagina inicial
    {
        //$empleados = Tarea::all(); //Hace un select all a la tabla
        //Llama a la funcion get_categoria del modelo tarea.php
        $empleados = Empleado::with('get_profesion')->get();
        //dd($empleados);
        return view('empleados.index', compact('empleados')); //Llama a la vista y le pasa las empleados obtenidas
    }

    public function show(Empleado $empleado)
    {
        return view('empleados.show', compact('empleado'));
    }
    public function create()
    {
        $profesiones = Profesion::all();
        $paises = Pais::all();
        $provincias = Provincia::all();
        return view('empleados.create', compact('profesiones', 'paises'));
    }

    public function store(Request $request)
    {
        $request->validate([ //Si el titulo esta vacion no hace nada
            'dni' => 'required|int|unique:empleados,dni',
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'fecha_nacimiento' => 'required',
            'telefono' => 'int|regex:/^\d{1,15}$/',
            'pais_id' => 'required|exists:pais,id',
            'provincia_id' => 'required|exists:provincias,id',
            'cod_postal_id' => 'required|exists:codigo_postals,id',
            'profesion_id' => 'required|exists:profesions,id',
            'matricula' => 'nullable|integer',
        ],[
            'dni.required' => 'El DNI es obligatorio.',
            'dni.int' => 'El DNI debe ser un número entero.',
            'dni.unique' => 'Ya existe un empleado con este DNI.',

            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 50 caracteres.',

            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.max' => 'El apellido no puede tener más de 50 caracteres.',

            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',

            'telefono.int' => 'El teléfono debe contener solo números.',
            'telefono.regex' => 'El teléfono debe tener entre 1 y 15 dígitos.',

            'pais_id.required' => 'Debe seleccionar un país.',
            'pais_id.exists' => 'El país seleccionado no es válido.',

            'provincia_id.required' => 'Debe seleccionar una provincia.',
            'provincia_id.exists' => 'La provincia seleccionada no es válida.',

            'cod_postal_id.required' => 'Debe seleccionar un código postal.',
            'cod_postal_id.exists' => 'El código postal seleccionado no es válido.',

            'profesion_id.required' => 'Debe seleccionar una profesión.',
            'profesion_id.exists' => 'La profesión seleccionada no es válida.',

            'matricula.integer' => 'La matrícula debe ser un número entero.',
        ]);
        // Validar que el empleado no tenga ya esta profesión
        $existe = Empleado::where('dni', $request->dni)
        ->where('profesion_id', $request->profesion_id)->exists();

        if ($existe) {
            return redirect()->back()
            ->withInput()
            ->withErrors(['profesion_id' => 'Este empleado ya tiene asignada esta profesión.']);
        }

        $empleado = new Empleado();
        //Datos del POST se obtiene en request
        $empleado->dni = $request->input('dni');
        $empleado->nombre = $request->input('nombre');
        $empleado->apellido = $request->input('apellido');
        $empleado->fecha_nacimiento = $request->input('fecha_nacimiento');
        $empleado->telefono = $request->input('telefono');
        $empleado->pais_id = $request->input('pais_id');
        $empleado->provincia_id = $request->input('provincia_id');
        $empleado->cod_postal_id = $request->input('cod_postal_id');
        $empleado->direccion = $request->input('direccion');
        $empleado->profesion_id = $request->input('profesion_id');
        $empleado->matricula = $request->input('matricula');
        $empleado->save(); //Guarda en la BD, si existe lo actualiza, sino crea

        return redirect()->route('empleados.index');
    }

    public function edit(Empleado $empleado)
    {
        $profesiones = Profesion::all();
        $paises = Pais::all();
        return view('empleados.edit', compact('empleado', 'profesiones', 'paises'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([ //Si el titulo esta vacion no hace nada
            'dni' => 'required|int',
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'fecha_nacimiento' => 'required',
            'telefono' => 'required|regex:/^\d{1,15}$/',
            'pais_id' => 'required|exists:pais,id',
            'provincia_id' => 'required|exists:provincias,id',
            'cod_postal_id' => 'required|exists:codigo_postals,id',
            'profesion_id' => 'required|exists:profesions,id',
            'matricula' => 'nullable|integer',
        ]);

        if ($request->input('dni') != null) {
            $empleado->dni = $request->input('dni');
        }
        if ($request->input('nombre') != null) {
            $empleado->nombre = $request->input('nombre');
        }
        if ($request->input('apellido') != null) {
            $empleado->apellido = $request->input('apellido');
        }
        if ($request->input('fecha_nacimiento') != null) {
            $empleado->fecha_nacimiento = $request->input('fecha_nacimiento');
        }

        $empleado->telefono = $request->input('telefono');

        if ($request->input('pais_id') != null) {
            $empleado->pais_id = $request->input('pais_id');
        }
        if ($request->input('provincia_id') != null) {
            $empleado->provincia_id = $request->input('provincia_id');
        }
        if ($request->input('cod_postal_id') != null) {
            $empleado->cod_postal_id = $request->input('cod_postal_id');
        }

        $empleado->direccion = $request->input('direccion');

        if ($request->input('profesion_id') != null) {
            $empleado->profesion_id = $request->input('profesion_id');
        }

        $empleado->matricula = $request->input('matricula');

        $empleado->save();
        return redirect()->route('empleados.index');
    }

    public function destroy(Empleado $empleado)
    {
        //Verifico que el empleado no exista en otras tablas antes de borrarlo
        if ($empleado->get_cirujano()->exists() ||
            $empleado->get_ayudante1()->exists() ||
            $empleado->get_ayudante2()->exists() ||
            $empleado->get_ayudante3()->exists() ||
            $empleado->get_anestesista()->exists() ||
            $empleado->get_instrumentador()->exists() ||
            $empleado->get_enfermero()->exists() )
        {
            return redirect()->route('empleados.index')
                ->with('error', 'No se puede eliminar el empleado porque tiene registros asociados.');
        }
        $empleado->delete();
        return redirect()->route('empleados.index');
    }
}
