<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cama extends Model
{
    use HasFactory;

    protected $fillable = [
        'habitacion_id',
        'codigo',
        'ocupada'
    ];
    protected $casts = [
        'ocupada' => 'boolean',
    ];
    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
    }
    public function get_habitacion()
    {
        return $this->belongsTo(Habitacion::class, 'habitacion_id', 'id');
    }

    public function get_ocupaciones()
    {
        return $this->hasMany(Ocupacion_cama::class);
    }
    public function ocupacionActual()
    {
        return $this->hasOne(\App\Models\Ocupacion_cama::class)->latestOfMany();
    }
    public function paciente()
    {
        return $this->hasOne(Paciente::class, 'cama_id');
    }
}
