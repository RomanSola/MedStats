<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_profesion', 
        'descripcion',
        'rol_id'
    ];

    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
    public function get_rol()
    {
        return $this->belongsTo(Rol_profesion::class, 'rol_id', 'id');
    }
}
