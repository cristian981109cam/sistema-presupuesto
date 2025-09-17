<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleCreate extends Component
{
    public $name;
    public $permissions = [];
    public $allPermissions = [];

    public function mount()
    {
        $this->allPermissions = Permission::get();
    }

    public function render()
    {
        return view('livewire.roles.role-create');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'permissions.required' => 'El permiso es obligatorio.',
        ]);

        try {
            // Crear el rol
            $role = Role::create([
                'name' => $this->name,
            ]);

            // Sincronizar permisos
            $role->syncPermissions($this->permissions);

            // Resetear los campos
            $this->reset(['name', 'permissions']);

            // Redirigir con mensaje de éxito
            return to_route('roles.index')->with('success', 'Rol creado exitosamente.');
        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Ocurrió un error al crear el rol.');
        }
    }
}
