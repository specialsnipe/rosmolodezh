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
            'last_name' => 'Симонов',
            'first_name' => 'Алексей',
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
            'last_name' => 'Муругов',
            'first_name' => 'Никита',
            'father_name' => 'Сергеевич',
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
