<?php

namespace App\Livewire\Transacciones;

use App\Models\IngresoGasto;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Transaccion;

class TransaccionEdit extends Component
{
    public $transaccion, $id_categoria, $id_ingreso_gasto, $monto, $nota, $fecha, $montoFormat;

    public $allCategorias, $allIngresoGasto;
    
    public function mount($id)
    {
        $this->transaccion = Transaccion::find($id);
        $this->allCategorias = Categoria::all();
        $this->allIngresoGasto = IngresoGasto::all();

        $this->id_categoria = $this->transaccion->id_categoria;
        $this->id_ingreso_gasto = $this->transaccion->id_ingreso_gasto;

        $this->monto = $this->transaccion->monto;
        $this->montoFormat = number_format($this->transaccion->monto, 2, ',', '.');
        
        $this->nota = $this->transaccion->nota;
        $this->fecha = $this->transaccion->fecha;
    }

    public function updatedMontoFormat($value)
    {
        // Quitar puntos y convertir coma a punto
        $numeric = str_replace(['.', ','], ['', '.'], $value);
        $this->monto = is_numeric($numeric) ? $numeric : 0;
    }
    
    public function render()
    {
        return view('livewire.transacciones.transaccion-edit');
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
            // Actualizar la transaccion
            $this->transaccion->update([
            'id_categoria' => $this->id_categoria,
            'id_ingreso_gasto' => $this->id_ingreso_gasto,
            'monto' => $this->monto,
            'nota' => $this->nota,
            'fecha' => $this->fecha,
            ]);

            // Redirigir con mensaje de éxito
            return to_route('transacciones.index')->with('success', 'Transaccion actualizada exitosamente.');
        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Ocurrió un error al actualizar la transaccion.');
        }
    }
}
