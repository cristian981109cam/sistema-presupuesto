<?php

namespace App\Livewire\Presupuestos;

use App\Models\Categoria;
use App\Models\Mes;
use App\Models\Presupuesto;
use Livewire\Component;

class PresupuestoEdit extends Component
{
    public $presupuesto, $id_categoria, $id_mes, $monto, $montoFormat;

    public $allCategorias, $allMeses;
    
    public function mount($id)
    {
        $this->presupuesto = Presupuesto::find($id);
        $this->allCategorias = Categoria::all();
        $this->allMeses = Mes::all();

        $this->id_categoria = $this->presupuesto->id_categoria;
        $this->id_mes = $this->presupuesto->id_mes;

        $this->monto = $this->presupuesto->monto;
        $this->montoFormat = number_format($this->presupuesto->monto, 2, ',', '.');
    }

    public function updatedMontoFormat($value)
    {
        // Quitar puntos y convertir coma a punto
        $numeric = str_replace(['.', ','], ['', '.'], $value);
        $this->monto = is_numeric($numeric) ? $numeric : 0;
    }

    public function render()
    {
        return view('livewire.presupuestos.presupuesto-edit');
    }

    public function submit()
    {
        $this->validate([
            'id_categoria' => 'required',
            'id_mes' => 'required',
            'monto' => 'required',
        ], [
            'id_categoria.required' => 'La categoría es obligatoria.',
            'id_mes.required' => 'El mes es obligatorio.',
            'monto.required' => 'El monto es obligatorio.',
            'monto.numeric' => 'El monto debe ser un número.',
        ]);

        try {
            // Actualizar el presupuesto
            $this->presupuesto->update([
                'id_categoria' => $this->id_categoria,
                'id_mes' => $this->id_mes,
                'monto' => $this->monto,
            ]);

            // Redirigir con mensaje de éxito
            return to_route('presupuestos.index')->with('success', 'Presupuesto actualizado exitosamente.');
        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Ocurrió un error al actualizar el presupuesto.');
        }
    }
}
