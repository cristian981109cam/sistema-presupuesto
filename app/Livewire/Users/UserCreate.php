<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserCreate extends Component
{
    public $name, $email, $password, $password_confirmation, $allRoles;
    public $roles = [];

    public function mount()
    {
        $this->allRoles = Role::all();
    }

    public function render()
    {
        return view('livewire.users.user-create');
    }

    // public function submit(){
    //     $this->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required|same:password_confirmation',
    //     ]);

    //     // Create the user
    //     User::create([
    //         'name' => $this->name,
    //         'email' => $this->email,
    //         'password' => Hash::make($this->password),
    //     ]);

    //     return to_route('users.index')->with('success', 'User created successfully.');
    // }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'roles' => 'required',
            'password' => 'required|same:password_confirmation|min:8',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'Este correo ya está registrado.',
            'roles.required' => 'El rol es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        try {
            // Crear el usuario
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            // Asignar el rol al usuario
            $user->syncRoles($this->roles);

            // Resetear los campos
            $this->reset(['name', 'email', 'password', 'password_confirmation']);

            // Redirigir con mensaje de éxito
            return to_route('users.index')->with('success', 'Usuario creado exitosamente.');
        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Ocurrió un error al crear el usuario.');
        }
    }
}
