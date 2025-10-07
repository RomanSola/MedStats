<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_procedimiento', 
        'descripcion', 
        'especialidad_id',
        'especialidad_2_id'];


    public function cirugias()
    {
        return $this->hasMany(Cirugia::class, 'procedimiento_id', 'id');
    }
    
    public function get_especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_id', 'id');
    }
    public function get_especialidad_2()
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_2_id', 'id');
    }
}
