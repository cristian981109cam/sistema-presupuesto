<?php

namespace App\Livewire\Categorias;

use App\Models\Categoria;
use Livewire\Component;

class CategoriaEdit extends Component
{
    public $categoria, $nombre, $descripcion;
    
    public function mount($id)
    {
        $this->categoria = Categoria::find($id);
        $this->nombre = $this->categoria->nombre;
        $this->descripcion = $this->categoria->descripcion;
    }
    public function render()
    {
        return view('livewire.categorias.categoria-edit');
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
            // Actualizar el usuario
            $this->categoria->update([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
            ]);

            // Redirigir con mensaje de éxito
            return to_route('categorias.index')->with('success', 'Categoria actualizada exitosamente.');
        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Ocurrió un error al actualizar la categoria.');
        }
    }
}
