<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Complexity;

class ComplexitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Complexity::create([
            'name' => 'Просто',
            'level' => 'Простой',
            'body' => 'С этим справится даже ребёнок!',
        ]);

        Complexity::create([
            'name' => 'Обычно',
            'level' => 'Обычный',
            'body' => 'С этим справится даже ребёнок чуть повзрослее!',
        ]);

        Complexity::create([
            'name' => 'Комплексно',
            'level' => 'Комплексный',
            'body' => 'К этому нужен особый подход, подумай перед тем как выполнять!',
        ]);

        Complexity::create([
            'name' => 'Сложно',
            'level' => 'Сложный',
            'body' => 'Ну тут без наставника не разобраться!',
        ]);

        Complexity::create([
            'name' => 'Профессионал',
            'level' => 'Профессиональный',
            'body' => 'Если ты его выполнишь то ты просто бог!',
        ]);
    }
}
