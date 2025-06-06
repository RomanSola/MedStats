<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_procedimiento', 'descripcion'];

    public function get_cirugias()
    {
        return $this->hasMany(Cirugia::class);
    }
}
