<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProvinciaSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Provincias de Argentina
        $paisArg = DB::table('pais')->where('nombre', 'Argentina')->first();
        $paisArgId = $paisArg ? $paisArg->id : 1;

        $provinciasArgentina = [
            'Buenos Aires',
            'Ciudad Autónoma de Buenos Aires',
            'Catamarca',
            'Chaco',
            'Chubut',
            'Córdoba',
            'Corrientes',
            'Entre Ríos',
            'Formosa',
            'Jujuy',
            'La Pampa',
            'La Rioja',
            'Mendoza',
            'Misiones',
            'Neuquén',
            'Río Negro',
            'Salta',
            'San Juan',
            'San Luis',
            'Santa Cruz',
            'Santa Fe',
            'Santiago del Estero',
            'Tierra del Fuego',
            'Tucumán'
        ];

        foreach ($provinciasArgentina as $nombre) {
            DB::table('provincias')->updateOrInsert(
                [
                    'nombre' => $nombre,
                    'pais_id' => $paisArgId
                ],
                [
                    'created_at' => $now,
                    'updated_at' => $now
                ]
            );
        }

        // 2. Regiones/Provincias Capitales de otros países de América del Sur
        $otrasProvincias = [
            'Bolivia' => ['La Paz', 'Sucre'],
            'Brasil' => ['Distrito Federal'],
            'Chile' => ['Región Metropolitana de Santiago'],
            'Colombia' => ['Bogotá D.C.'],
            'Ecuador' => ['Pichincha'],
            'Guyana' => ['Demerara-Mahaica'],
            'Paraguay' => ['Asunción (Distrito Capital)'],
            'Perú' => ['Lima'],
            'Suriname' => ['Paramaribo'],
            'Uruguay' => ['Montevideo'],
            'Venezuela' => ['Distrito Capital']
        ];

        foreach ($otrasProvincias as $paisNombre => $provs) {
            $paisObj = DB::table('pais')->where('nombre', $paisNombre)->first();
            if (!$paisObj) {
                continue;
            }

            foreach ($provs as $provNombre) {
                DB::table('provincias')->updateOrInsert(
                    [
                        'nombre' => $provNombre,
                        'pais_id' => $paisObj->id
                    ],
                    [
                        'created_at' => $now,
                        'updated_at' => $now
                    ]
                );
            }
        }
    }
}
