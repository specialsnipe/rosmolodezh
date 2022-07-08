<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'vk_url' => 'тут вк урл',
            'tg_url' => 'тут тг урл',
            'ok_url' => 'тк ок урл'
        ]);
    }
}
