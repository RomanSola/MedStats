<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantillaProgramacion extends Model
{
    use HasFactory;

    protected $table = 'plantilla_programaciones';

    protected $fillable = [
        'dia_semana',
        'quirofano',
        'hora',
        'especialidad',
        'procedimiento',
        'cirujano',
        'observaciones',
        'activo',
    ];

    public static function getNombreDia($num)
    {
        $dias = [
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
            7 => 'Domingo',
        ];

        return $dias[$num] ?? 'Desconocido';
    }
}
