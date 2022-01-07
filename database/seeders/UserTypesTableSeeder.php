<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title' => 'parent', 'name' => 'Родители', 'level' => 4],
            ['title' => 'teacher', 'name' => 'Учитель', 'level' => 3],
            ['title' => 'admin', 'name' => 'Админ', 'level' => 2],
            ['title' => 'super_admin', 'name' => 'Супер Админ', 'level' => 1],
           // ['title' => 'librarian', 'name' => 'librarian', 'level' => 6],
        ];
        DB::table('user_types')->insert($data);
    }
}
