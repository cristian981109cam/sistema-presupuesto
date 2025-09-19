<?php

namespace App\Livewire\Categorias;

use App\Models\Categoria;
use Livewire\Component;

class CategoriaIndex extends Component
{
    public function render()
    {
        $categorias = Categoria::get();
        return view('livewire.categorias.categoria-index', compact('categorias'));
    }

    public function delete($id)
    {
        $categorias = Categoria::find($id);
        if ($categorias) {
            $categorias->delete();
            session()->flash('success', 'Categoria eliminada exitosamente.');
        } else {
            session()->flash('error', 'Categoria no encontrada.');
        }
    }
}
