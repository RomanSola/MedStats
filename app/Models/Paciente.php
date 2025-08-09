<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni',
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'genero',
        'telefono',
        'pais_id',
        'provincia_id',
        'cod_postal_id',
        'direccion',
        'creado_por',
        'modificado_por'
    ];
    
    public function historial_stock()
    {
        return $this->hasMany(Historial_stock::class, 'paciente_id');
    }

    public function medicamentos()
    {
        return $this->hasManyThrough(
        Medicamento::class,
        Historial_stock::class,
        'paciente_id',        // Foreign key on historial_stock
        'id',                 // Foreign key on medicamento
        'id',                 // Local key on paciente
        'stock_id'            // Local key on historial_stock (vía stock)
    )->join('stock', 'stock.id', '=', 'historial_stock.stock_id')
     ->join('medicamentos', 'medicamentos.id', '=', 'stock.medicamento_id')
     ->select('medicamentos.*')
     ->distinct();
    }

    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
    }
    public function cama()
    {
        return $this->belongsTo(Cama::class);
    }
    public function get_pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id', 'id');
    }
    public function get_provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincia_id', 'id');
    }

    public function get_codigo_postal()
    {
        return $this->belongsTo(Codigo_postal::class, 'cod_postal_id', 'id');
    }
    public function get_cirugias()
    {
        return $this->hasMany(Cirugia::class, 'paciente_id', 'id');
    }
    public function get_historial_stock()
    {
        return $this->hasMany(Historial_stock::class, 'paciente_id', 'id');
    }
    public function get_ocupacion_cama()
    {
        return $this->hasMany(Cirugia::class, 'paciente_id', 'id');
    }
}
