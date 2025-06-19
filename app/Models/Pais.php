<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'pais'; 

    public function provincias()
    {
        return $this->hasMany(Provincia::class);
    }
}
