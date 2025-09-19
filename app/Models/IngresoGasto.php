<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IngresoGasto extends Model
{
    use HasFactory;

    // Indicar explícitamente el nombre de la tabla (soluciona el error)
    protected $table = 'ingresos_gastos';

    protected $fillable = ['tipo'];

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'id_ingreso_gasto');
    }
}
