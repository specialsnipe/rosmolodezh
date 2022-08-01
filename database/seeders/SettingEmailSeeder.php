<?php

namespace Database\Seeders;

use App\Models\SettingEmail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingEmail::create([
            'email' => 'rosmolodezh@mail.tu',
            'description' => 'Наша основная почта',
            'setting_id' => '1',
        ]);
        SettingEmail::create([
            'email' => 'secondrosmolodezh@mail.tu',
            'description' => 'Почта нашего психолога',
            'setting_id' => '1',
        ]);
    }
}
