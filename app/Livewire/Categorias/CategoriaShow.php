<?php

namespace App\Livewire\Categorias;

use App\Models\Categoria;
use Livewire\Component;

class CategoriaShow extends Component
{
    public $categoria;

    public function mount($id)
    {
        $this->categoria = Categoria::find($id);
    }
    public function render()
    {
        return view('livewire.categorias.categoria-show');
    }
}
