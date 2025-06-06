<?php

namespace App\Http\Controllers\Api;

use App\Models\Codigo_postal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CodigoPostalController extends Controller
{
    public function porPaisProvincia($pais_id, $provincia_id)
    {
        return Codigo_postal::where('pais_id', $pais_id)
                           ->where('provincia_id', $provincia_id)
                           ->get();
    }
}
