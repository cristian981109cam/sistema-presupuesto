<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaccion extends Model
{
    use HasFactory;

    // Indicar explícitamente el nombre de la tabla (soluciona el error)
    protected $table = 'transacciones';
    
    protected $fillable = ['id_categoria', 'id_ingreso_gasto', 'monto', 'nota', 'fecha'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function ingresoGasto()
    {
        return $this->belongsTo(IngresoGasto::class, 'id_ingreso_gasto');
    }
}
