<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserEdit extends Component
{
    public $user, $name, $email, $password, $password_confirmation, $allRoles;
    public $roles = [];

    public function mount($id)
    {
        $this->user = User::find($id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->allRoles = Role::all();
        $this->roles = $this->user->roles->pluck('name');
    }
    
    public function render()
    {
        return view('livewire.users.user-edit');
    }

    // public function submit(){
    //     $this->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required|same:password_confirmation',
    //     ]);

    //     $this->user->name = $this->name;
    //     $this->user->email = $this->email;

    //     if ($this->password) {
    //         $this->user->password = Hash::make($this->password);
    //     }
    //     $this->user->save();

    //     return to_route('users.index')->with('success', 'User created successfully.');
    // }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'same:password_confirmation|min:8',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        try {
            // Actualizar el usuario
            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password ? Hash::make($this->password) : $this->user->password,
            ]);

            // Asignar el rol al usuario
            $this->user->syncRoles($this->roles);

            // Redirigir con mensaje de éxito
            return to_route('users.index')->with('success', 'Usuario actualizado exitosamente.');
        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Ocurrió un error al actualizar el usuario.');
        }
    }
}
