<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleIndex extends Component
{
    public function render()
    {
        $roles = Role::with('permissions')->get();
        return view('livewire.roles.role-index', compact('roles'));
    }

    public function delete($id)
    {
        $roles = Role::find($id);
        if ($roles) {
            $roles->delete();
            session()->flash('success', 'Role deleted successfully.');
        } else {
            session()->flash('error', 'Role not found.');
        }
    }
}
