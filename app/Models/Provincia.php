<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = 'provincias'; // 👈 esto sí es plural

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }
}

