<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Exercise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(OccupationSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(SettingEmailSeeder::class);
        $this->call(SettingPhoneSeeder::class);
        $this->call(TrackSeeder::class);
        $this->call(BlockSeeder::class);
        $this->call(TrackUserSeeder::class);
        $this->call(ComplexitySeeder::class);


        Exercise::factory(30)->create();
        Answer::factory(30)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
