<?php

namespace App\Livewire\Transacciones;

use App\Models\Transaccion;
use Livewire\Component;

class TransaccionIndex extends Component
{
    public function render()
    {
        $transacciones = Transaccion::with(['categoria','ingresoGasto'])->get();
        return view('livewire.transacciones.transaccion-index', compact('transacciones'));
    }

    public function delete($id)
    {
        $transacciones = Transaccion::find($id);
        if ($transacciones) {
            $transacciones->delete();
            session()->flash('success', 'Transaccion eliminada exitosamente.');
        } else {
            session()->flash('error', 'Transaccion no encontrada.');
        }
    }
}
