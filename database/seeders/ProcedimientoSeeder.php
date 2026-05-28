<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Procedimiento;
use App\Models\Especialidad;

class ProcedimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $procedimientosPorEspecialidad = [
            'Cirugía general' => [
                [
                    'nombre' => 'Apendicectomía',
                    'desc' => 'Extirpación quirúrgica del apéndice vermiforme.'
                ],
                [
                    'nombre' => 'Colecistectomía laparoscópica',
                    'desc' => 'Extirpación de la vesícula biliar mediante laparoscopia.'
                ],
                [
                    'nombre' => 'Hernioplastia inguinal',
                    'desc' => 'Reparación de hernia en la región inguinal mediante colocación de malla.',
                    'laterales' => ['izquierda', 'derecha', 'bilateral']
                ],
                [
                    'nombre' => 'Tiroidectomía total',
                    'desc' => 'Extirpación total de la glándula tiroides.'
                ],
                [
                    'nombre' => 'Tiroidectomía parcial',
                    'desc' => 'Extirpación parcial de la glándula tiroides.'
                ],
                [
                    'nombre' => 'Laparotomía exploradora',
                    'desc' => 'Apertura quirúrgica de la cavidad abdominal para explorar órganos.'
                ],
                [
                    'nombre' => 'Hernioplastia umbilical',
                    'desc' => 'Reparación quirúrgica de una hernia en la región umbilical.'
                ],
                [
                    'nombre' => 'Mastectomía parcial',
                    'desc' => 'Extirpación parcial de tejido mamario.',
                    'laterales' => ['izquierda', 'derecha', 'bilateral']
                ],
                [
                    'nombre' => 'Mastectomía total',
                    'desc' => 'Extirpación total de tejido mamario.',
                    'laterales' => ['izquierda', 'derecha', 'bilateral']
                ],
                [
                    'nombre' => 'Hemicolectomía',
                    'desc' => 'Extirpación quirúrgica de la mitad del colon.',
                    'laterales' => ['izquierda', 'derecha']
                ],
                [
                    'nombre' => 'Esplenectomía',
                    'desc' => 'Extirpación quirúrgica total o parcial del bazo.'
                ],
                [
                    'nombre' => 'Eventroplastía abdominal',
                    'desc' => 'Reparación quirúrgica de una eventración o hernia incisional en la pared abdominal.'
                ]
            ],
            'Ginecología' => [
                [
                    'nombre' => 'Histerectomía total',
                    'desc' => 'Extirpación total del útero.'
                ],
                [
                    'nombre' => 'Histerectomía subtotal',
                    'desc' => 'Extirpación del cuerpo del útero preservando el cuello uterino.'
                ],
                [
                    'nombre' => 'Miomectomía',
                    'desc' => 'Extirpación de miomas uterinos preservando el útero.'
                ],
                [
                    'nombre' => 'Quistectomía ovárica',
                    'desc' => 'Extirpación de un quiste en el ovario.',
                    'laterales' => ['izquierda', 'derecha', 'bilateral']
                ],
                [
                    'nombre' => 'Biopsia de cuello uterino',
                    'desc' => 'Toma de muestra de tejido del cuello del útero para análisis histopatológico.'
                ],
                [
                    'nombre' => 'Salpinguectomía',
                    'desc' => 'Extirpación quirúrgica de las trompas de Falopio.',
                    'laterales' => ['izquierda', 'derecha', 'bilateral']
                ],
                [
                    'nombre' => 'Ooforectomía',
                    'desc' => 'Extirpación quirúrgica de uno o ambos ovarios.',
                    'laterales' => ['izquierda', 'derecha', 'bilateral']
                ],
                [
                    'nombre' => 'Colpoplastia anterior y posterior',
                    'desc' => 'Reparación plástica de la pared vaginal por prolapso.'
                ],
                [
                    'nombre' => 'Laparoscopia ginecológica diagnóstica',
                    'desc' => 'Exploración laparoscópica de la cavidad pélvica femenina.'
                ]
            ],
            'Obstetricia' => [
                [
                    'nombre' => 'Cesárea',
                    'desc' => 'Parto quirúrgico del bebé a través de una incisión en el abdomen y útero.'
                ],
                [
                    'nombre' => 'Cerclaje cervical',
                    'desc' => 'Procedimiento para reforzar el cuello uterino durante el embarazo.'
                ],
                [
                    'nombre' => 'Legrado uterino instrumental',
                    'desc' => 'Limpieza de la cavidad uterina mediante raspado instrumental.'
                ],
                [
                    'nombre' => 'Extracción manual de placenta',
                    'desc' => 'Extracción manual de la placenta retenida en la cavidad uterina.'
                ],
                [
                    'nombre' => 'Histerectomía obstétrica',
                    'desc' => 'Extirpación de útero de urgencia post-parto/cesárea por hemorragia indomable.'
                ]
            ],
            'Urología' => [
                [
                    'nombre' => 'Prostatectomía total',
                    'desc' => 'Extirpación total de la glándula prostática.'
                ],
                [
                    'nombre' => 'Cistoscopia',
                    'desc' => 'Exploración visual del interior de la vejiga y uretra.'
                ],
                [
                    'nombre' => 'Nefrectomía',
                    'desc' => 'Extirpación quirúrgica de un riñón.',
                    'laterales' => ['izquierda', 'derecha']
                ],
                [
                    'nombre' => 'Circuncisión',
                    'desc' => 'Extirpación quirúrgica del prepucio del pene.'
                ],
                [
                    'nombre' => 'Resección transuretral de próstata (RTU)',
                    'desc' => 'Extirpación de tejido prostático obstructivo a través de la uretra.'
                ],
                [
                    'nombre' => 'Varicocelectomía',
                    'desc' => 'Ligadura quirúrgica de venas dilatadas del cordón espermático.',
                    'laterales' => ['izquierda', 'derecha', 'bilateral']
                ],
                [
                    'nombre' => 'Vasectomía',
                    'desc' => 'Ligadura y sección de los conductos deferentes de forma bilateral.'
                ],
                [
                    'nombre' => 'Colocación de catéter doble J',
                    'desc' => 'Inserción de catéter ureteral doble J para drenaje renal.',
                    'laterales' => ['izquierdo', 'derecho', 'bilateral']
                ],
                [
                    'nombre' => 'Retiro de catéter doble J',
                    'desc' => 'Retracción endoscópica del catéter ureteral doble J.',
                    'laterales' => ['izquierdo', 'derecho', 'bilateral']
                ]
            ],
            'Cirugía vascular' => [
                [
                    'nombre' => 'Bypass femoropoplíteo',
                    'desc' => 'Desviación del flujo sanguíneo alrededor de una arteria femoral bloqueada.',
                    'laterales' => ['izquierdo', 'derecho', 'bilateral']
                ],
                [
                    'nombre' => 'Safenectomía',
                    'desc' => 'Extirpación de la vena safena para el tratamiento de várices.',
                    'laterales' => ['izquierda', 'derecha', 'bilateral']
                ],
                [
                    'nombre' => 'Angioplastia transluminal',
                    'desc' => 'Dilatación de un vaso sanguíneo mediante un catéter con balón.',
                    'laterales' => ['izquierda', 'derecha']
                ],
                [
                    'nombre' => 'Fístula arteriovenosa',
                    'desc' => 'Conexión quirúrgica de una arteria con una vena, generalmente para hemodiálisis.',
                    'laterales' => ['izquierda', 'derecha']
                ],
                [
                    'nombre' => 'Amputación supracondílea',
                    'desc' => 'Amputación de extremidad inferior por encima de la rodilla.',
                    'laterales' => ['izquierda', 'derecha']
                ],
                [
                    'nombre' => 'Amputación infracondílea',
                    'desc' => 'Amputación de extremidad inferior por debajo de la rodilla.',
                    'laterales' => ['izquierda', 'derecha']
                ],
                [
                    'nombre' => 'Embolectomía arterial',
                    'desc' => 'Extirpación quirúrgica de un émbolo o coágulo de una arteria.',
                    'laterales' => ['izquierda', 'derecha']
                ]
            ],
            'Traumatología' => [
                [
                    'nombre' => 'Artroplastia de cadera',
                    'desc' => 'Reemplazo total o parcial de la articulación de la cadera por una prótesis.',
                    'laterales' => ['izquierda', 'derecha', 'bilateral']
                ],
                [
                    'nombre' => 'Artroplastia de rodilla',
                    'desc' => 'Reemplazo de la articulación de la rodilla por una prótesis.',
                    'laterales' => ['izquierda', 'derecha', 'bilateral']
                ],
                [
                    'nombre' => 'Artroscopia de rodilla',
                    'desc' => 'Visualización y tratamiento de lesiones internas de la rodilla.',
                    'laterales' => ['izquierda', 'derecha', 'bilateral']
                ],
                [
                    'nombre' => 'Osteosíntesis de fractura',
                    'desc' => 'Unión de fragmentos óseos mediante placas, tornillos o clavos.',
                    'laterales' => ['izquierda', 'derecha']
                ],
                [
                    'nombre' => 'Reducción abierta y fijación interna (RAFI)',
                    'desc' => 'Reparación quirúrgica de un hueso fracturado mediante alineación y fijación.',
                    'laterales' => ['izquierda', 'derecha']
                ],
                [
                    'nombre' => 'Artroscopia de hombro',
                    'desc' => 'Visualización y tratamiento de lesiones internas del hombro.',
                    'laterales' => ['izquierdo', 'derecho']
                ],
                [
                    'nombre' => 'Liberación de túnel carpiano',
                    'desc' => 'Descompresión quirúrgica del nervio mediano en la muñeca.',
                    'laterales' => ['izquierdo', 'derecho', 'bilateral']
                ],
                [
                    'nombre' => 'Tenorrafia',
                    'desc' => 'Sutura o reparación de un tendón seccionado.',
                    'laterales' => ['izquierda', 'derecha']
                ],
                [
                    'nombre' => 'Toilette quirúrgica osteoarticular',
                    'desc' => 'Limpieza y desbridamiento quirúrgico de una articulación o hueso infectado/expuesto.'
                ]
            ],
            'Anestesiología' => [
                [
                    'nombre' => 'Bloqueo epidural',
                    'desc' => 'Administración de anestésico en el espacio epidural para control del dolor.'
                ],
                [
                    'nombre' => 'Bloqueo espinal',
                    'desc' => 'Administración de anestésico en el espacio subaracnoideo.'
                ],
                [
                    'nombre' => 'Anestesia general inhalatoria',
                    'desc' => 'Inducción de anestesia general mediante agentes inhalados.'
                ],
                [
                    'nombre' => 'Anestesia total intravenosa (TIVA)',
                    'desc' => 'Inducción y mantenimiento anestésico utilizando únicamente fármacos intravenosos.'
                ],
                [
                    'nombre' => 'Bloqueo de plexo braquial',
                    'desc' => 'Anestesia regional del miembro superior bloqueando el plexo braquial.',
                    'laterales' => ['izquierdo', 'derecho']
                ]
            ],
            'Neurocirugía' => [
                [
                    'nombre' => 'Craneotomía para evacuación de hematoma',
                    'desc' => 'Apertura del cráneo para extraer acumulación de sangre.',
                    'laterales' => ['izquierda', 'derecha']
                ],
                [
                    'nombre' => 'Discectomía lumbar',
                    'desc' => 'Extirpación de una hernia de disco en la columna lumbar.'
                ],
                [
                    'nombre' => 'Laminectomía',
                    'desc' => 'Extirpación de la lámina de una o más vértebras.'
                ],
                [
                    'nombre' => 'Colocación de válvula de derivación peritoneal',
                    'desc' => 'Colocación de catéter y válvula para drenar líquido cefalorraquídeo.',
                    'laterales' => ['izquierda', 'derecha']
                ],
                [
                    'nombre' => 'Artrodesis de columna',
                    'desc' => 'Fijación quirúrgica de dos o más vértebras mediante injertos o implantes metálicos.'
                ],
                [
                    'nombre' => 'Exéresis de tumor cerebral',
                    'desc' => 'Resección quirúrgica total o parcial de una neoplasia intracraneal.'
                ],
                [
                    'nombre' => 'Craneoplastia',
                    'desc' => 'Corrección quirúrgica de un defecto óseo en el cráneo.'
                ]
            ],
            'Gastroenterología' => [
                [
                    'nombre' => 'Endoscopia digestiva alta',
                    'desc' => 'Exploración visual del esófago, estómago y duodeno.'
                ],
                [
                    'nombre' => 'Colonoscopia',
                    'desc' => 'Exploración visual completa del intestino grueso.'
                ],
                [
                    'nombre' => 'Polipectomía digestiva',
                    'desc' => 'Extirpación de pólipos en el tracto digestivo detectados por endoscopia.'
                ],
                [
                    'nombre' => 'Colangiopancreatografía retrógrada endoscópica (CPRE)',
                    'desc' => 'Estudio y tratamiento endoscópico de las vías biliares y pancreáticas.'
                ],
                [
                    'nombre' => 'Gastrostomía endoscópica percutánea (PEG)',
                    'desc' => 'Colocación de sonda de alimentación directa al estómago asistida por endoscopio.'
                ],
                [
                    'nombre' => 'Ligadura de várices esofágicas',
                    'desc' => 'Tratamiento endoscópico para prevenir o detener el sangrado de várices en el esófago.'
                ]
            ]
        ];

        foreach ($procedimientosPorEspecialidad as $nombreEspecialidad => $procedimientos) {
            $especialidad = Especialidad::where('nombre', $nombreEspecialidad)->first();

            if ($especialidad) {
                foreach ($procedimientos as $proc) {
                    if (isset($proc['laterales'])) {
                        foreach ($proc['laterales'] as $lado) {
                            $nombreCompleto = $proc['nombre'] . ' ' . $lado;
                            $descCompleto = $proc['desc'] . ' (Lado ' . $lado . ')';

                            Procedimiento::updateOrCreate(
                                ['nombre_procedimiento' => $nombreCompleto],
                                [
                                    'descripcion' => $descCompleto,
                                    'especialidad_id' => $especialidad->id
                                ]
                            );
                        }
                    } else {
                        Procedimiento::updateOrCreate(
                            ['nombre_procedimiento' => $proc['nombre']],
                            [
                                'descripcion' => $proc['desc'],
                                'especialidad_id' => $especialidad->id
                            ]
                        );
                    }
                }
            }
        }
    }
}
