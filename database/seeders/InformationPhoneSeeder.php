<?php

namespace Database\Seeders;

use App\Models\InformationPhone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformationPhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InformationPhone::create([
            'phone' => '8 800 555 35 35',
            'description' => 'Горячая линия',
            'information_id' => 1,
        ]);
        InformationPhone::create([
            'phone' => '8 900 555 35 35',
            'description' => 'Телефон менеджера',
            'information_id' => 1,
        ]);
    }
}
