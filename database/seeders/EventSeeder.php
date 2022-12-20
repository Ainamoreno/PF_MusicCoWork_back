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
                'is_delete' => false,
                'date' => '2023-04-20',
            ],
            [
                'id' => 1,
                'name' => 'Concierto de opera',
                'description' => 'Tendremos el placer de contar con la soprano Mireia Marí, gran cantante de opera formada en el Conservatorio Superior de Canto de Valencia.',
                'is_delete' => false,
                'date' => '2023-08-12',
            ],
            [
                'id' => 1,
                'name' => 'Certamen ámbito Diputación de Valencia',
                'description' => 'Sala individual totalmente equiada para tu día de estudio.',
                'is_delete' => false,
                'date' => '2023-08-12',
            ],
        ]);
    }
}
