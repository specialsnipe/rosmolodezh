<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Alex',
            'last_name' => 'Alex',
            'father_name' => 'Alex',
            'role_id' => 4,
            'gender_id' => 2,
            'occupation_id' => 1,
            'avatar' => 'default_avatar.jpg',
            'login' => 'Alex',
            'password' => Hash::make('123456'),
            'email' => 'alex@mail.ru',
        ]);
        User::create([
            'first_name' => 'Nikita',
            'last_name' => 'Nikita',
            'father_name' => 'Nikita',
            'role_id' => 4,
            'gender_id' => 2,
            'occupation_id' => 1,
            'avatar' => 'default_avatar.jpg',
            'login' => 'Nikita',
            'password' => Hash::make('123456'),
            'email' => 'nikita@mail.ru',
        ]);
    }
}
