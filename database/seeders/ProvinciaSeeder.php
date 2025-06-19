<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProvinciaSeeder extends Seeder
{
    public function run()
    {
        $json = Storage::get('data/states.json');
        $provincias = json_decode($json, true);

        foreach ($provincias as $provincia) {
            DB::table('provincias')->updateOrInsert(
                ['id' => $provincia['id']],
                [
                    'nombre' => $provincia['name'],
                    'pais_id' => $provincia['country_id'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
