<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni', 
        'nombre', 
        'apellido', 
        'fecha_nacimiento', 
        'genero', 
        'telefono', 
        'pais_id', 
        'provincia_id',
        'cod_postal_id', 
        'direccion', 
        'creado_por', 
        'modificado_por'
    ];

    public function get_pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id', 'id');
    }

    public function get_provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincia_id', 'id');
    }

    public function get_codigo_postal()
    {
        return $this->belongsTo(Codigo_postal::class, 'cod_postal_id', 'id');
    }
}
