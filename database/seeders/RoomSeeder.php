<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            [
                'id' => 1,
                'name' => 'Sala individual de instrumento',
                'description' => 'Sala individual totalmente equiada para tu día de estudio.',
                'price' => 5,
                'horary' => 'De 09:00 a 20:00h',
                'is_active' => true
            ],
            [
                'id' => 2,
                'name' => 'Sala de instrumento y piano',
                'description' => 'Sala totalmente equiada para dos personas, incluyendo piano.',
                'price' => 10,
                'horary' => 'De 09:00 a 20:00h',
                'is_active' => true
            ],
            [
                'id' => 3,
                'name' => 'Sala individual con piano y bajo',
                'description' => 'Sala equipada con piano, aplificadores de guitarra y bajo, además de microfonía.',
                'price' => 15,
                'horary' => 'De 09:00 a 20:00h',
                'is_active' => true
            ],
            [
                'id' => 4,
                'name' => 'Sala individual con escritorio',
                'description' => 'Sala individual con el mobiliario adecuado para estudiar asignaturas teóricas.',
                'price' => 5,
                'horary' => 'De 09:00 a 20:00h',
                'is_active' => true
            ],
            [
                'id' => 5,
                'name' => 'Sala grupal de instrumento',
                'description' => 'Sala totalmente equipada para ensayos grupales (3 o 4 personas).',
                'price' => 20,
                'horary' => 'De 09:00 a 20:00h',
                'is_active' => true
            ],
        ]);
    }
}
