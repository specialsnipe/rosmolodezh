<?php

namespace Database\Seeders;

use App\Models\Track;
use App\Models\TrackUser;
use App\Models\User;
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
        $users = User::all();
        $tracks = Track::all();
        $tracks_ids = [];
        foreach ($tracks as $track) {
            $tracks_ids[] = $track->id;
        }

        foreach ($users as $user) {
            TrackUser::create([
                'user_id' => $user->id,
                'track_id' => $tracks_ids[array_rand($tracks_ids)],
            ]);
        }
//        TrackUser::create([
//            'user_id' => 2,
//            'track_id' => 1,
//        ]);

    }
}
