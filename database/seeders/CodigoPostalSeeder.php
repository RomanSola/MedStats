<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CodigoPostalSeeder extends Seeder
{
    public function run()
    {
        $json = Storage::get('data/postal_codes.json');
        $codigos = json_decode($json, true);

        if (!is_array($codigos)) {
            dd('Error al cargar el JSON');
        }

        foreach ($codigos as $cp) {
            // Evita errores si faltan campos importantes
            if (!isset($cp['codigo']) || !isset($cp['localidad'])) {
                continue;
            }

            DB::table('codigo_postals')->insert([
                'codigo' => $cp['codigo'],
                'localidad' => $cp['localidad'],
                'pais_id' => $cp['pais_id'],
                'provincia_id' => $cp['provincia_id'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
