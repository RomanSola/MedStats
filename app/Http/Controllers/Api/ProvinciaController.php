<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Provincia;

class ProvinciaController extends Controller
{
    public function porPais($pais_id)
    {
        /*
        $json = Storage::get('data/states.json');
        $provincias = collect(json_decode($json, true));

        return $provincias
            ->where('country_id', $pais_id)
            ->sortBy('name')
            ->values()
            ->all();
        */
        return Provincia::where('pais_id', $pais_id)->get();
    }
}
