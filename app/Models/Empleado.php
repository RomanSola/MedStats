<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni', 
        'nombre', 
        'apellido', 
        'fecha_nacimiento', 
        'telefono', 
        'pais_id', 
        'provincia_id', 
        'cod_postal_id', 
        'direccion', 
        'profesion_id', 
        'creado_por', 
        'modificado_por'];

    public function get_profesion()
    {
        return $this->belongsTo(Profesion::class, 'profesion_id', 'id');
    }

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
    
    public function get_cirujano()
    {
        return $this->hasMany(Cirugia::class, 'cirujano_id', 'id');
    }
    public function get_ayudante1()
    {
        return $this->hasMany(Cirugia::class, 'ayudante_1_id', 'id');
    }
    public function get_ayudante2()
    {
        return $this->hasMany(Cirugia::class, 'ayudante_2_id', 'id');
    }
    public function get_ayudante3()
    {
        return $this->hasMany(Cirugia::class, 'ayudante_3_id', 'id');
    }
    public function get_anestesista()
    {
        return $this->hasMany(Cirugia::class, 'anestesista_id', 'id');
    }
    public function get_instrumentador()
    {
        return $this->hasMany(Cirugia::class, 'instrumentador_id', 'id');
    }
    public function get_enfermero()
    {
        return $this->hasMany(Cirugia::class, 'enfermero_id', 'id');
    }
}
