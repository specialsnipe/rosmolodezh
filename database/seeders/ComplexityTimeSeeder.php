<?php

namespace Database\Seeders;

use App\Models\ComplexityTime;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ComplexityTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ComplexityTime::create([
            'started_at' => 0,
            'ended_at' => 14,
            'class_name' => 'primary',
        ]);
        ComplexityTime::create([
            'started_at' => 15,
            'ended_at' => 29,
            'class_name' => 'success',
        ]);
        ComplexityTime::create([
            'started_at' => 30,
            'ended_at' => 59,
            'class_name' => 'warning',
        ]);
        ComplexityTime::create([
            'started_at' => 60,
            'ended_at' => 119,
            'class_name' => 'danger',
        ]);
        ComplexityTime::create([
            'started_at' => 120,
            'ended_at' => 239,
            'class_name' => 'dark',
        ]);
    }
}
