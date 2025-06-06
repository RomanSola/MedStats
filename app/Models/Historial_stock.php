<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Historial_stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock_id',
        'cantidad', 
        'fecha', 
        'empleado_id', 
        'paciente_id', 
        'comentario', 
        'creado_por'
    ];

    public function get_stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id', 'id');
    }

    public function get_paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'id');
    }

    public function get_empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
    /* FALTA LA TABLA DE USUARIOS
    public function get_creador()
    {
        return $this->belongsTo(Usuario::class, 'creado_por');
    }
    protected static function booted()
    {   
        //Valida que el stock exista y la cantidad no baje de cero
        static::creating(function ($historial) {
            $stock = Stock::find($historial->stock_id);
            if (!$stock) {
                throw new \Exception('Stock no encontrado');
            }

            $nuevaCantidad = $stock->cantidad_act + $historial->cantidad;

            if ($nuevaCantidad < 0) {
                throw new \Exception('No se puede realizar la operación: stock insuficiente.');
            }
        });

        //Actualiza automaticamente la cantidad actual de stock en la tabla Stock
        static::created(function ($historial) {
            DB::table('stock')->where('id', $historial->stock_id)->increment('cantidad_act', $historial->cantidad);
        });
    }
    */
}
