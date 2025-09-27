<?php

namespace App\Livewire\Reportes;

use App\Models\Reporte;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ReporteIndex extends Component
{
    public function render()
    {
        // $reportes = Reporte::with(['categoria','mes','presupuesto'])->get();
        $reportes = DB::table('presupuestos as p')
            ->join('categorias as c', 'p.id_categoria', '=', 'c.id')
            ->join('meses as m', 'p.id_mes', '=', 'm.id')
            ->leftJoin('transacciones as t', function ($join) {
                $join->on('t.id_categoria', '=', 'p.id_categoria')
                     ->whereRaw('MONTH(t.fecha) = p.id_mes');
            })
            ->leftJoin('ingresos_gastos as ig', 't.id_ingreso_gasto', '=', 'ig.id')
            ->select(
                'c.nombre as categoria',
                'm.numero as mes_numero',
                'm.nombre as mes',
                'p.monto as monto_asignado',
                DB::raw("COALESCE(SUM(CASE WHEN ig.tipo = 'ingreso' THEN t.monto ELSE 0 END), 0) as total_ingresos"),
                DB::raw("COALESCE(SUM(CASE WHEN ig.tipo = 'gasto' THEN t.monto ELSE 0 END), 0) as total_gastos"),
                DB::raw("(p.monto 
                          + COALESCE(SUM(CASE WHEN ig.tipo = 'ingreso' THEN t.monto ELSE 0 END), 0)
                          - COALESCE(SUM(CASE WHEN ig.tipo = 'gasto' THEN t.monto ELSE 0 END), 0)
                         ) as saldo_final")
            )
            ->groupBy('p.id', 'c.id', 'c.nombre', 'm.id', 'm.numero', 'm.nombre', 'p.monto')
            ->orderBy('m.numero')
            ->orderBy('c.nombre')
            ->get();
        return view('livewire.reportes.reporte-index', compact('reportes'));
    }
}
