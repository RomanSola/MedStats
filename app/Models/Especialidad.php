<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre' ];
      
    public function get_procedimientos()
    {
        return $this->hasMany(Procedimiento::class);
    }
}
