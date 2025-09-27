<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reporte extends Model
{
    use HasFactory;

    protected $fillable = ['id_categoria', 'id_mes', 'id_presupuesto', 'ingresos', 'gastos', 'disponible', 'aviso'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function mes()
    {
        return $this->belongsTo(Mes::class, 'id_mes');
    }

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class, 'id_presupuesto');
    }

    // // Disponible calculado en runtime
    // public function getDisponibleAttribute()
    // {
    //     $montoAsignado = $this->presupuesto ? $this->presupuesto->monto : 0;
    //     return ($montoAsignado + $this->ingresos) - $this->gastos;
    // }

    // // Aviso dinámico
    // public function getAvisoAttribute()
    // {
    //     return $this->disponible > 0 ? '✅ Hay dinero disponible' : '❌ No hay dinero disponible';
    // }
}
