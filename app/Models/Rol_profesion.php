<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol_profesion extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'rol', 
    ];

    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
