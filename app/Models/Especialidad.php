<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre' ];
      
public function procedimientos()
{
    return $this->hasMany(Procedimiento::class, 'especialidad_id');
}
public function procedimientos_secundarios()
{
    return $this->hasMany(Procedimiento::class, 'especialidad_2_id');
}
}
