<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CodigoPostalSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $data = [
            'Ciudad Autónoma de Buenos Aires' => [
                ['codigo' => '1000', 'localidad' => 'Ciudad Autónoma de Buenos Aires']
            ],
            'Buenos Aires' => [
                ['codigo' => '1900', 'localidad' => 'La Plata'],
                ['codigo' => '7600', 'localidad' => 'Mar del Plata'],
                ['codigo' => '8000', 'localidad' => 'Bahía Blanca'],
                ['codigo' => '7000', 'localidad' => 'Tandil'],
                ['codigo' => '1640', 'localidad' => 'Martínez'],
                ['codigo' => '1642', 'localidad' => 'San Isidro'],
                ['codigo' => '1602', 'localidad' => 'Florida'],
                ['codigo' => '1704', 'localidad' => 'Ramos Mejía']
            ],
            'Catamarca' => [
                ['codigo' => '4700', 'localidad' => 'San Fernando del Valle de Catamarca'],
                ['codigo' => '4740', 'localidad' => 'Andalgalá'],
                ['codigo' => '4750', 'localidad' => 'Belén']
            ],
            'Chaco' => [
                ['codigo' => '3500', 'localidad' => 'Resistencia'],
                ['codigo' => '3700', 'localidad' => 'Presidencia Roque Sáenz Peña'],
                ['codigo' => '3730', 'localidad' => 'Charata']
            ],
            'Chubut' => [
                ['codigo' => '9103', 'localidad' => 'Rawson'],
                ['codigo' => '9100', 'localidad' => 'Trelew'],
                ['codigo' => '9000', 'localidad' => 'Comodoro Rivadavia'],
                ['codigo' => '9120', 'localidad' => 'Puerto Madryn'],
                ['codigo' => '9200', 'localidad' => 'Esquel']
            ],
            'Córdoba' => [
                ['codigo' => '5000', 'localidad' => 'Córdoba'],
                ['codigo' => '5900', 'localidad' => 'Villa María'],
                ['codigo' => '5800', 'localidad' => 'Río Cuarto'],
                ['codigo' => '5152', 'localidad' => 'Villa Carlos Paz'],
                ['codigo' => '5600', 'localidad' => 'San Francisco'],
                ['codigo' => '5850', 'localidad' => 'Río Tercero']
            ],
            'Corrientes' => [
                ['codigo' => '3400', 'localidad' => 'Corrientes'],
                ['codigo' => '3450', 'localidad' => 'Goya'],
                ['codigo' => '3470', 'localidad' => 'Paso de los Libres'],
                ['codigo' => '3460', 'localidad' => 'Curuzú Cuatiá']
            ],
            'Entre Ríos' => [
                ['codigo' => '3100', 'localidad' => 'Paraná'],
                ['codigo' => '3200', 'localidad' => 'Concordia'],
                ['codigo' => '2820', 'localidad' => 'Gualeguaychú'],
                ['codigo' => '3260', 'localidad' => 'Concepción del Uruguay']
            ],
            'Formosa' => [
                ['codigo' => '3600', 'localidad' => 'Formosa'],
                ['codigo' => '3610', 'localidad' => 'Clorinda'],
                ['codigo' => '3630', 'localidad' => 'Espinillo']
            ],
            'Jujuy' => [
                ['codigo' => '4600', 'localidad' => 'San Salvador de Jujuy'],
                ['codigo' => '4500', 'localidad' => 'San Pedro de Jujuy'],
                ['codigo' => '4612', 'localidad' => 'Palpalá'],
                ['codigo' => '4624', 'localidad' => 'Humahuaca']
            ],
            'La Pampa' => [
                ['codigo' => '6300', 'localidad' => 'Santa Rosa'],
                ['codigo' => '6360', 'localidad' => 'General Pico'],
                ['codigo' => '6307', 'localidad' => 'Toay']
            ],
            'La Rioja' => [
                ['codigo' => '5300', 'localidad' => 'La Rioja'],
                ['codigo' => '5360', 'localidad' => 'Chilecito'],
                ['codigo' => '5370', 'localidad' => 'Chamical']
            ],
            'Mendoza' => [
                ['codigo' => '5500', 'localidad' => 'Mendoza'],
                ['codigo' => '5600', 'localidad' => 'San Rafael'],
                ['codigo' => '5501', 'localidad' => 'Godoy Cruz'],
                ['codigo' => '5515', 'localidad' => 'Maipú'],
                ['codigo' => '5539', 'localidad' => 'Las Heras']
            ],
            'Misiones' => [
                ['codigo' => '3300', 'localidad' => 'Posadas'],
                ['codigo' => '3360', 'localidad' => 'Oberá'],
                ['codigo' => '3370', 'localidad' => 'Puerto Iguazú'],
                ['codigo' => '3380', 'localidad' => 'Eldorado']
            ],
            'Neuquén' => [
                ['codigo' => '8300', 'localidad' => 'Neuquén'],
                ['codigo' => '8370', 'localidad' => 'San Martín de los Andes'],
                ['codigo' => '8340', 'localidad' => 'Zapala'],
                ['codigo' => '8373', 'localidad' => 'Junín de los Andes']
            ],
            'Río Negro' => [
                ['codigo' => '8500', 'localidad' => 'Viedma'],
                ['codigo' => '8400', 'localidad' => 'San Carlos de Bariloche'],
                ['codigo' => '8332', 'localidad' => 'General Roca'],
                ['codigo' => '8324', 'localidad' => 'Cipolletti']
            ],
            'Salta' => [
                ['codigo' => '4400', 'localidad' => 'Salta'],
                ['codigo' => '4530', 'localidad' => 'San Ramón de la Nueva Orán'],
                ['codigo' => '4560', 'localidad' => 'Tartagal'],
                ['codigo' => '4440', 'localidad' => 'Metán']
            ],
            'San Juan' => [
                ['codigo' => '5400', 'localidad' => 'San Juan'],
                ['codigo' => '5440', 'localidad' => 'Caucete'],
                ['codigo' => '5413', 'localidad' => 'Chimbas']
            ],
            'San Luis' => [
                ['codigo' => '5700', 'localidad' => 'San Luis'],
                ['codigo' => '5730', 'localidad' => 'Villa Mercedes'],
                ['codigo' => '5750', 'localidad' => 'Merlo']
            ],
            'Santa Cruz' => [
                ['codigo' => '9400', 'localidad' => 'Río Gallegos'],
                ['codigo' => '9405', 'localidad' => 'El Calafate'],
                ['codigo' => '9011', 'localidad' => 'Caleta Olivia']
            ],
            'Santa Fe' => [
                ['codigo' => '3000', 'localidad' => 'Santa Fe'],
                ['codigo' => '2000', 'localidad' => 'Rosario'],
                ['codigo' => '2300', 'localidad' => 'Rafaela'],
                ['codigo' => '2600', 'localidad' => 'Venado Tuerto'],
                ['codigo' => '2919', 'localidad' => 'Villa Constitución'],
                ['codigo' => '3560', 'localidad' => 'Reconquista']
            ],
            'Santiago del Estero' => [
                ['codigo' => '4200', 'localidad' => 'Santiago del Estero'],
                ['codigo' => '4300', 'localidad' => 'La Banda'],
                ['codigo' => '4230', 'localidad' => 'Frías']
            ],
            'Tierra del Fuego' => [
                ['codigo' => '9410', 'localidad' => 'Ushuaia'],
                ['codigo' => '9420', 'localidad' => 'Río Grande'],
                ['codigo' => '9411', 'localidad' => 'Tolhuin']
            ],
            'Tucumán' => [
                ['codigo' => '4000', 'localidad' => 'San Miguel de Tucumán'],
                ['codigo' => '4107', 'localidad' => 'Yerba Buena'],
                ['codigo' => '4146', 'localidad' => 'Concepción'],
                ['codigo' => '4105', 'localidad' => 'Tafí Viejo']
            ],
            // Otros países de América del Sur
            'La Paz' => [
                ['codigo' => '0201', 'localidad' => 'La Paz']
            ],
            'Sucre' => [
                ['codigo' => '0101', 'localidad' => 'Sucre']
            ],
            'Distrito Federal' => [
                ['codigo' => '70000', 'localidad' => 'Brasilia']
            ],
            'Región Metropolitana de Santiago' => [
                ['codigo' => '8320000', 'localidad' => 'Santiago']
            ],
            'Bogotá D.C.' => [
                ['codigo' => '110111', 'localidad' => 'Bogotá']
            ],
            'Pichincha' => [
                ['codigo' => '170150', 'localidad' => 'Quito']
            ],
            'Demerara-Mahaica' => [
                ['codigo' => '0000', 'localidad' => 'Georgetown']
            ],
            'Asunción (Distrito Capital)' => [
                ['codigo' => '1001', 'localidad' => 'Asunción']
            ],
            'Lima' => [
                ['codigo' => '15001', 'localidad' => 'Lima']
            ],
            'Paramaribo' => [
                ['codigo' => '0000', 'localidad' => 'Paramaribo']
            ],
            'Montevideo' => [
                ['codigo' => '11000', 'localidad' => 'Montevideo']
            ],
            'Distrito Capital' => [
                ['codigo' => '1010', 'localidad' => 'Caracas']
            ]
        ];

        foreach ($data as $provinciaNombre => $localidades) {
            $provincia = DB::table('provincias')->where('nombre', $provinciaNombre)->first();
            if (!$provincia) {
                continue;
            }

            foreach ($localidades as $loc) {
                DB::table('codigo_postals')->updateOrInsert(
                    [
                        'codigo' => $loc['codigo'],
                        'localidad' => $loc['localidad'],
                        'provincia_id' => $provincia->id
                    ],
                    [
                        'pais_id' => $provincia->pais_id,
                        'created_at' => $now,
                        'updated_at' => $now
                    ]
                );
            }
        }
    }
}
