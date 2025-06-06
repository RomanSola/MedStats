<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cirugia extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'procedimiento_id',
        'cirujano_id',
        'ayudante_1_id',
        'ayudante_2_id',
        'anestesista_id',
        'tipo_anestesia_id',
        'instrumentador_id',
        'urgencia',
        'creado_por',
        'modificado_por'
    ];

    public function get_paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
    public function get_procedimiento()
    {
        return $this->belongsTo(Procedimiento::class);
    }
    public function get_cirujano()
    {
        return $this->belongsTo(Empleado::class, 'cirujano_id');
    }
    public function get_ayudante1()
    {
        return $this->belongsTo(Empleado::class, 'ayudante_1_id');
    }
    public function get_ayudante2()
    {
        return $this->belongsTo(Empleado::class, 'ayudante_2_id');
    }
    public function get_anestesista()
    {
        return $this->belongsTo(Empleado::class, 'anestesista_id');
    }
    public function get_instrumentador()
    {
        return $this->belongsTo(Empleado::class, 'instrumentador_id');
    }
    public function get_tipo_anestesia()
    {
        return $this->belongsTo(Tipo_anestesia::class, 'tipo_anestesia_id');
    }
    /* FALTA TABLA DE USUARIOS
    public function creador() { return $this->belongsTo(Usuario::class, 'creado_por'); }
    public function modificador() { return $this->belongsTo(Usuario::class, 'modificado_por'); }
    */
}
