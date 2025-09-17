<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleEdit extends Component
{
    public $name, $role;
    public $permissions = [];
    public $allPermissions = [];

    public function mount($id)
    {
        $this->role = Role::find($id);
        $this->allPermissions = Permission::get();
        $this->name = $this->role->name;
        $this->permissions = $this->role->permissions->pluck('name');
    }
    
    public function render()
    {
        return view('livewire.roles.role-edit');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|unique:roles,name,' . $this->role->id,
            'permissions' => 'required',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'permissions.required' => 'El permiso es obligatorio.',
        ]);

        try {
            // Actualizar el rol
            $this->role->update([
                'name' => $this->name,
            ]);

            // Sincronizar permisos
            $this->role->syncPermissions($this->permissions);

            // Redirigir con mensaje de éxito
            return to_route('roles.index')->with('success', 'Rol actualizado exitosamente.');
        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Ocurrió un error al actualizar el rol.');
        }
    }
}
