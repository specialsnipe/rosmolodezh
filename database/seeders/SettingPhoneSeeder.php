<?php

namespace Database\Seeders;

use App\Models\SettingPhone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingPhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingPhone::create([
            'phone' => '8 800 555 35 35',
            'description' => 'Горячая линия',
            'setting_id' => 1,
        ]);
        SettingPhone::create([
            'phone' => '8 900 555 35 35',
            'description' => 'Телефон менеджера',
            'setting_id' => 1,
        ]);
    }
}
