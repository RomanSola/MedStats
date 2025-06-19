<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaisSeeder extends Seeder
{
    public function run()
    {
        $json = Storage::get('data/countries.json');
        $paises = json_decode($json, true);

        foreach ($paises as $pais) {
            DB::table('pais')->updateOrInsert(
                ['id' => $pais['id']],
                [
                    'nombre' => $pais['name'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
