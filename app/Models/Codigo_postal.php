<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codigo_postal extends Model
{
    use HasFactory;


    protected $fillable = [
        'codigo',
        'localidad',
        'pais_id',
        'provincia_id'
    ];

    public function get_pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function get_provincia()
    {
        return $this->belongsTo(Provincia::class);
    }
}
