<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
protected $table = 'pacientes'; //Conexion tabla

//public function remedios()
//{
    //return $this->hasMany(Remedio::class, 'persona_id');
    //Conecta vbarios remedios con una persona
//}
}
