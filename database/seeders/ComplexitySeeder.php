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
            'class_name' => 'success',
            'body' => 'С этим справится даже ребёнок!',
        ]);

        Complexity::create([
            'name' => 'Обычно',
            'level' => 'Обычный',
            'class_name' => 'primary',
            'body' => 'С этим справится даже ребёнок чуть повзрослее!',
        ]);

        Complexity::create([
            'name' => 'Комплексно',
            'level' => 'Комплексный',
            'class_name' => 'warning',
            'body' => 'К этому нужен особый подход, подумай перед тем как выполнять!',
        ]);

        Complexity::create([
            'name' => 'Сложно',
            'level' => 'Сложный',
            'class_name' => 'danger',
            'body' => 'Ну тут без наставника не разобраться!',
        ]);

        Complexity::create([
            'name' => 'Профессионал',
            'level' => 'Профессиональный',
            'class_name' => 'dark',
            'body' => 'Если ты его выполнишь то ты просто бог!',
        ]);
    }
}
