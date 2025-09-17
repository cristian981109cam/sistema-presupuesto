<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class ProductCreate extends Component
{
    public $name, $detail;

    public function render()
    {
        return view('livewire.products.product-create');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'detail' => 'required',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'detail.required' => 'El detalle es obligatorio.',
        ]);

        try {
            // Crear el usuario
            Product::create([
                'name' => $this->name,
                'detail' => $this->detail,
            ]);

            // Resetear los campos
            $this->reset(['name', 'detail']);

            // Redirigir con mensaje de éxito
            return to_route('products.index')->with('success', 'Producto creado exitosamente.');
        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Ocurrió un error al crear el producto.');
        }
    }
}
