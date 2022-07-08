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
            'setting_id' => '1',
        ]);
        SettingEmail::create([
            'email' => 'secondrosmolodezh@mail.tu',
            'setting_id' => '1',
        ]);
    }
}
