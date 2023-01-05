<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Paola',
                'surname' => 'Pérez Díaz',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$14WdyNVj.2N/6bil9PnFhe9tsU5og3aS3shwZhpDel/fVcIM4IhT2',
                // 123456
                'is_active' => true,
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'id' => 2,
                'name' => 'Marta',
                'surname' => 'Pérez Díaz',
                'email' => 'marta@marta.com',
                'password' => '$2y$10$14WdyNVj.2N/6bil9PnFhe9tsU5og3aS3shwZhpDel/fVcIM4IhT2',
                // 123456
                'is_active' => true,
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' =>now()
            ]
        ]);
    }
}
