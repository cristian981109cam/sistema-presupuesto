<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Ingresos_GastosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            ['tipo' => 'ingreso', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'gasto',   'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('ingresos_gastos')->insert($tipos);
    }
}
