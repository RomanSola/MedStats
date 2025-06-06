<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;
    
    protected $fillable =  [
        'nombre',
        ];
    public function get_pais()
    {
        //Establece la relación de tipo "pertenece a" (uno a uno o muchos a uno)
        return $this->belongsTo(Pais::class, 'pais_id', 'id');
    }

    public function get_codigos_postales()
    {
        return $this->hasMany(Codigo_postal::class);
    }
}
