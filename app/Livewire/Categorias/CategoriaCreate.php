<?php

namespace App\Livewire\Categorias;

use App\Models\Categoria;
use Livewire\Component;

class CategoriaCreate extends Component
{
    public $nombre, $descripcion;
    
    public function render()
    {
        return view('livewire.categorias.categoria-create');
    }

    public function submit()
    {
        $this->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'descripcion.required' => 'La descripcion es obligatoria.',
        ]);

        try {
            // Crear el usuario
            Categoria::create([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
            ]);

            // Resetear los campos
            $this->reset(['nombre', 'descripcion']);

            // Redirigir con mensaje de éxito
            return to_route('categorias.index')->with('success', 'Categoria creada exitosamente.');
        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Ocurrió un error al crear la categoria.');
        }
    }
}
