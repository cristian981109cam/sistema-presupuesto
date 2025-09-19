<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presupuesto extends Model
{
    use HasFactory;

    protected $fillable = ['id_categoria', 'id_mes', 'monto'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function mes()
    {
        return $this->belongsTo(Mes::class, 'id_mes');
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_presupuesto');
    }
}
