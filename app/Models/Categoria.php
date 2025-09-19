<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
     use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];

    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class, 'id_categoria');
    }

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'id_categoria');
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_categoria');
    }
}
