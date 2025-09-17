<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',

            'product.view',
            'product.create',
            'product.edit',
            'product.delete',

            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
        ];

        // foreach( $permissions as $key => $value ) {
        //     Permission::create(['name' => $value]);
        // }
        
        foreach ($permissions as $value) {
            // Solo crea el permiso si no existe
            if (!Permission::where('name', $value)->exists()) {
                Permission::create(['name' => $value]);
            }
        }
    }
}
