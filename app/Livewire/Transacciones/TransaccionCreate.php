<?php

namespace App\Livewire\Transacciones;

use App\Models\IngresoGasto;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Transaccion;

class TransaccionCreate extends Component
{
    public $id_categoria, $id_ingreso_gasto, $monto, $nota, $fecha;
    
    public $allCategorias, $allIngresoGasto;
    
    public function mount()
    {
        $this->allCategorias = Categoria::all();
        $this->allIngresoGasto = IngresoGasto::all();
    }

    public function render()
    {
        return view('livewire.transacciones.transaccion-create');
    }

    public function submit()
    {
        $this->validate([
            'id_categoria' => 'required',
            'id_ingreso_gasto' => 'required',
            'monto' => 'required',
            'nota' => 'required',
            'fecha' => 'required|date',
        ], [
            'id_categoria.required' => 'La categoría es obligatoria.',
            'id_ingreso_gasto.required' => 'El ingreso o gasto es obligatorio.',
            'monto.required' => 'El monto es obligatorio.',
            'monto.numeric' => 'El monto debe ser un número.',
            'nota.required' => 'La nota es obligatoria.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no es válida.',
        ]);

        try {
            // Crear la transaccion
            Transaccion::create([
                'id_categoria' => $this->id_categoria,
                'id_ingreso_gasto' => $this->id_ingreso_gasto,
                'monto' => $this->monto,
                'nota' => $this->nota,
                'fecha' => $this->fecha,
            ]);

            // Resetear los campos
            $this->reset(['id_categoria', 'id_ingreso_gasto', 'monto', 'nota', 'fecha']);

            // Redirigir con mensaje de éxito
            return to_route('transacciones.index')->with('success', 'Transaccion creada exitosamente.');
        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Ocurrió un error al crear la transaccion.');
        }
    }
}
