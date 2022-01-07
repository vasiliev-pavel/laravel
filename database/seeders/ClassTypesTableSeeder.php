<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class_types')->delete();

        $data = [
            ['name' => 'Начальная школа', 'code' => 'C'],
            ['name' => 'Основная школа', 'code' => 'PN'],
            ['name' => 'Старшие классы', 'code' => 'N'],
        ];

        DB::table('class_types')->insert($data);

    }
}
