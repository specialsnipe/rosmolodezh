<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20; $i++) {
            $post = Post::create([
                'title' => fake()->realText(25),
                'body' => fake()->realTextBetween(120, 360),
                'excerpt' => fake()->realTextBetween(60, 120),
                'user_id' => rand(1,3)
            ]);
            PostImage::create([
                'name' => 'tested_image.jpg',
                'post_id' => $post->id
            ]);
        }
    }
}
