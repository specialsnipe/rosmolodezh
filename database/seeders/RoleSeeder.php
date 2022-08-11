<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'student',
            'readable_name' => 'Студент',
        ]);
        Role::create([
            'name' => 'tutor',
            'readable_name' => 'Куратор',
        ]);
        Role::create([
            'name' => 'teacher',
            'readable_name' => 'Учитель',
        ]);
        Role::create([
            'name' => 'admin',
            'readable_name' => 'Администратор',
        ]);
    }
}
