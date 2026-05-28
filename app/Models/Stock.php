<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'lote',
        'fecha_vencimiento',
        'cantidad_act',
        'servicio_id',
        'creado_por',
        'modificado_por'
    ];

    public function get_medicamento()
    {
        return $this->belongsTo(Medicamento::class,'medicamento_id', 'id');
    }

    public function get_servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }
    public function get_historial()
    {
        return $this->hasMany(Historial_stock::class, 'stock_id', 'id');
    }
    public function historial_stock()
{
    return $this->hasMany(Historial_stock::class, 'stock_id');
}
}
