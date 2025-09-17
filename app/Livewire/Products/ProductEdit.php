<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class ProductEdit extends Component
{
    public $product, $name, $detail;

    public function mount($id)
    {
        $this->product = Product::find($id);
        $this->name = $this->product->name;
        $this->detail = $this->product->detail;
    }

    public function render()
    {
        return view('livewire.products.product-edit');
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
            // Actualizar el usuario
            $this->product->update([
                'name' => $this->name,
                'detail' => $this->detail,
            ]);

            // Redirigir con mensaje de éxito
            return to_route('products.index')->with('success', 'Producto actualizado exitosamente.');
        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Ocurrió un error al actualizar el producto.');
        }
    }
}
