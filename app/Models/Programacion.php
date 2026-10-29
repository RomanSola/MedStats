<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    use HasFactory;

    protected $table = 'programacion';

    protected $fillable = [
        'fecha',
        'quirofano',
        'paciente',
        'especialidad',
        'procedimiento',
        'cirujano',
        'hora',
        'observaciones',
        'realizada',
        'suspendida',
        'es_reserva',
        'plantilla_programacion_id',
        'user_id',
        'updated_by_user_id',
    ];

    protected $casts = [
        'realizada' => 'boolean',
        'suspendida' => 'boolean',
        'es_reserva' => 'boolean',
    ];

    public function registradoPor()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function editadoPor()
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by_user_id');
    }
}
