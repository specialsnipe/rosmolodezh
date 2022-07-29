<?php

namespace Database\Seeders;

use App\Models\Track;
use App\Models\User;
use App\Models\TrackUser;
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
            'father_name' => 'Всеволодович',
            'role_id' => 4,
            'gender_id' => 2,
            'occupation_id' => 1,
            'avatar' => 'default_avatar.jpg',
            'login' => 'Alex',
            'password' => Hash::make('123456'),
            'phone' => '+7 (999) 999 9991',
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
            'phone' => '+7 (999) 999 9999',
            'email' => 'nikita@mail.ru',
        ]);

        User::factory()->count(100)->create();
    }
}
