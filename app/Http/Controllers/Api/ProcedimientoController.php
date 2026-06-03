<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Procedimiento;

class ProcedimientoController extends Controller
{
    public function porEspecialidad($especialidad_id)
    {
        return Procedimiento::where('especialidad_id', $especialidad_id)->orWhere('especialidad_2_id', $especialidad_id)->orderBy('nombre_procedimiento')->get();
    }
}
