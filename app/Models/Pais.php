<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;
    
    protected $fillable =  [
        'nombre',
        ];
    
    public function get_provincias()
    {
        return $this->hasMany(Provincia::class);
    }

    public function get_codigos_postales()
    {
        return $this->hasMany(Codigo_postal::class);
    }
}
