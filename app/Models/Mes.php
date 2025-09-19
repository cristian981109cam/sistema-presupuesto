<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mes extends Model
{
    use HasFactory;

    protected $table = 'meses';

    protected $fillable = ['numero', 'nombre'];

    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class, 'id_mes');
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_mes');
    }
}
