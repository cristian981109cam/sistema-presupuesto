<?php

namespace App\Livewire\Presupuestos;

use Livewire\Component;
use App\Models\Presupuesto;

class PresupuestoIndex extends Component
{
    public function render()
    {
        //$presupuestos = Presupuesto::get();
        $presupuestos = Presupuesto::with(['categoria','mes'])->get();
        return view('livewire.presupuestos.presupuesto-index', compact('presupuestos'));
    }

    public function delete($id)
    {
        $presupuestos = Presupuesto::find($id);
        if ($presupuestos) {
            $presupuestos->delete();
            session()->flash('success', 'Presupuesto eliminado exitosamente.');
        } else {
            session()->flash('error', 'Presupuesto no encontrado.');
        }
    }
}
