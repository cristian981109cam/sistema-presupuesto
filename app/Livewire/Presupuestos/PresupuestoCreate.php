<?php

namespace App\Livewire\Presupuestos;

use App\Models\Mes;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Presupuesto;

class PresupuestoCreate extends Component
{
    public $id_categoria, $id_mes, $monto;
    
    public $allCategorias, $allMeses;
    
    public function mount()
    {
        $this->allCategorias = Categoria::all();
        $this->allMeses = Mes::all();
    }

    public function render()
    {
        return view('livewire.presupuestos.presupuesto-create');
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
            // Crear el presupuesto
            Presupuesto::create([
                'id_categoria' => $this->id_categoria,
                'id_mes' => $this->id_mes,
                'monto' => $this->monto,
            ]);

            // Resetear los campos
            $this->reset(['id_categoria', 'id_mes', 'monto']);

            // Redirigir con mensaje de éxito
            return to_route('presupuestos.index')->with('success', 'Presupuesto creado exitosamente.');
        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Ocurrió un error al crear el presupuesto.');
        }
    }
}
