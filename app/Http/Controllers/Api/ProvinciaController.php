<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provincia;

class ProvinciaController extends Controller
{
    public function porPais($pais_id)
    {
        return Provincia::where('pais_id', $pais_id)->get();
    }
}