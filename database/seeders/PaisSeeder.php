<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaisSeeder extends Seeder
{
    public function run()
    {
        $paises = [
            'Argentina',
            'Bolivia',
            'Brasil',
            'Chile',
            'Colombia',
            'Ecuador',
            'Guyana',
            'Paraguay',
            'Perú',
            'Suriname',
            'Uruguay',
            'Venezuela'
        ];

        foreach ($paises as $nombre) {
            DB::table('pais')->updateOrInsert(
                ['nombre' => $nombre],
                [
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
