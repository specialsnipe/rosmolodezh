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

        User::create([
            'last_name' => 'student',
            'first_name' => 'student',
            'father_name' => 'student',
            'role_id' => 1,
            'gender_id' => 2,
            'occupation_id' => 1,
            'avatar' => 'default_avatar.jpg',
            'login' => 'student',
            'password' => Hash::make('student'),
            'phone' => '+7 (999) 989 9999',
            'email' => 'student@mail.ru',
        ]);

        User::create([
            'last_name' => 'tutor',
            'first_name' => 'tutor',
            'father_name' => 'tutor',
            'role_id' => 3,
            'gender_id' => 2,
            'occupation_id' => 2,
            'avatar' => 'default_avatar.jpg',
            'login' => 'tutor',
            'password' => Hash::make('tutor'),
            'phone' => '+7 (999) 989 9999',
            'email' => 'tutor@mail.ru',
        ]);

        User::create([
            'last_name' => 'teacher',
            'first_name' => 'teacher',
            'father_name' => 'teacher',
            'role_id' => 3,
            'gender_id' => 2,
            'occupation_id' => 3,
            'avatar' => 'default_avatar.jpg',
            'login' => 'teacher',
            'password' => Hash::make('teacher'),
            'phone' => '+7 (999) 989 9999',
            'email' => 'teacher@mail.ru',
        ]);

        User::create([
            'last_name' => 'admin',
            'first_name' => 'admin',
            'father_name' => 'admin',
            'role_id' => 4,
            'gender_id' => 2,
            'occupation_id' => 3,
            'avatar' => 'default_avatar.jpg',
            'login' => 'admin',
            'password' => Hash::make('admin'),
            'phone' => '+7 (999) 989 9999',
            'email' => 'admin@mail.ru',
        ]);

        User::factory()->count(100)->create();
    }
}
