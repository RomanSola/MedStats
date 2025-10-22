<?php

namespace App\Http\Controllers;

use App\Models\Cama;
use App\Models\Cirugia;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Can;

class InicioController extends Controller
{
    //
    //Muestra carga valores de insumos, pacientes, camas y cirugías
    public function index() //Pagina inicial
    {
        //Cantidad de pacientes
        $pacientes = count(Paciente::where('habitacion_id', '!=', null)->where('cama_id', '!=', null)->get());

        //Porcentaje de camas
        $camasOcupadas = count(Cama::where('ocupada', 1)->get());
        $camasTotales = count(Cama::all());
        // $porcentajeCamas = intval( ( $camasOcupadas * 100 ) / $camasTotales );
        $porcentajeCamas = $camasTotales > 0
            ? intval(($camasOcupadas * 100) / $camasTotales)
            : 0;


        //Cantidad de Cirugías
        $cantCirugias = count(Cirugia::whereYear('fecha_cirugia', date('Y'))->get());

        return view('index', compact('pacientes', 'porcentajeCamas', 'cantCirugias')); //Llama a la vista y le pasa los datos
    }
}
