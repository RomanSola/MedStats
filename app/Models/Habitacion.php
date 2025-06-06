<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'sala_id', 
        'numero'
    ];

    public function get_sala()
    {
        return $this->belongsTo(Sala::class, 'sala_id', 'id');
    }

    public function get_camas()
    {
        return $this->hasMany(Cama::class, 'id', 'habitacion_id');
    }
}
