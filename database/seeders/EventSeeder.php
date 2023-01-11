<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'id' => 1,
                'name' => 'Certamen ámbito Diputación de Valencia',
                'description' => 'Concurso oficial de bandas de l"Horta Nord. Se realizará el día 20/04/2022, sábado.',
                'is_active' => true,
                'date' => '2023-04-20',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'id' => 2,
                'name' => 'Concierto de opera',
                'description' => 'Tendremos el placer de contar con la soprano Mireia Marí, gran cantante de opera formada en el Conservatorio Superior de Canto de Valencia.',
                'is_active' => true,
                'date' => '2023-08-12',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'id' => 3,
                'name' => 'Audición de percusión',
                'description' => 'Tendremos el placer de recibir a dos percusionistas Valencianos que han participado en los certámenes más importantes de España.',
                'is_active' => true,
                'date' => '2023-08-12',
                'created_at' => now(),
                'updated_at' =>now()
            ],
        ]);
    }
}
