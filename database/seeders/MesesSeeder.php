<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MesesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meses = [
            ['numero' => 1,  'nombre' => 'Enero'],
            ['numero' => 2,  'nombre' => 'Febrero'],
            ['numero' => 3,  'nombre' => 'Marzo'],
            ['numero' => 4,  'nombre' => 'Abril'],
            ['numero' => 5,  'nombre' => 'Mayo'],
            ['numero' => 6,  'nombre' => 'Junio'],
            ['numero' => 7,  'nombre' => 'Julio'],
            ['numero' => 8,  'nombre' => 'Agosto'],
            ['numero' => 9,  'nombre' => 'Septiembre'],
            ['numero' => 10, 'nombre' => 'Octubre'],
            ['numero' => 11, 'nombre' => 'Noviembre'],
            ['numero' => 12, 'nombre' => 'Diciembre'],
        ];

        DB::table('meses')->insert($meses);
    }
}
