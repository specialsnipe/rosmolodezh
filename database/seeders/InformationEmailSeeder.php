<?php

namespace Database\Seeders;

use App\Models\InformationEmail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformationEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InformationEmail::create([
            'email' => 'rosmolodezh@mail.tu',
            'description' => 'Наша основная почта',
            'information_id' => '1',
        ]);
        InformationEmail::create([
            'email' => 'secondrosmolodezh@mail.tu',
            'description' => 'Почта нашего психолога',
            'information_id' => '1',
        ]);
    }
}
