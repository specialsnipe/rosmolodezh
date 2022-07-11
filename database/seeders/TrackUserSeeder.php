<?php

namespace Database\Seeders;

use App\Models\TrackUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrackUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        TrackUser::create([
            'user_id' => 1,
            'track_id' => 1,
        ]);
        TrackUser::create([
            'user_id' => 2,
            'track_id' => 1,
        ]);
    }
}
