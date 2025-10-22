<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioPerfil extends Model
{
    use HasFactory;

    protected $fillable =  [
        'perfil',
        'admin',
        'insumos',
        'estadisticas',
        'pacientes',
        'camas',
        'cirugias'
    ];
}
