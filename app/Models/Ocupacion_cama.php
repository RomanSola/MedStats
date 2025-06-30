<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ocupacion_cama extends Model
{
    use HasFactory;
    protected $casts = [
    'fecha_ingreso' => 'datetime',
    'fecha_egreso' => 'datetime',
];

    protected $fillable = [
        'cama_id', 
        'paciente_id', 
        'fecha_ingreso', 
        'fecha_egreso', 
        'observaciones'
    ];

    public function get_cama()
    {
        return $this->belongsTo(Cama::class, 'cama_id', 'id');
    }

    public function get_paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'id');
    }

}
