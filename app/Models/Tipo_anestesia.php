<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_anestesia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre'
    ];

    public function get_cirugias()
    {
        return $this->hasMany(Cirugia::class);
    }
}
