<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\AboutAdvantageItem;
use App\Models\AboutCompetitionItem;
use App\Models\AboutGrantItem;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        for ($i=0; $i < 20; $i++) {
//            $post = Post::create([
//                'title' => fake()->realText(25),
//                'body' => fake()->realTextBetween(120, 360),
//                'excerpt' => fake()->realTextBetween(60, 120),
//                'user_id' => rand(1,3)
//            ]);
//            PostImage::create([
//                'name' => 'tested_image.jpg',
//                'post_id' => $post->id
//            ]);
//        }
        $about = About::create([
            'company_name' => 'NetHummer',
            'company_desc' => 'IT компания по разработке и поддержки веб-проектов.',
            'company_advantages_title' => 'Главные приимущества комании Nethamer',
        ]);
        AboutAdvantageItem::create([
            'description' => '11122Опыт и постоянное соверсшенствовние навыков программирования сотрудн23213иков',
            'about_id' => $about->id,
        ]);
        AboutCompetitionItem::create([
            'title' => 'Конкурс',
            'description' => '11122Опыт и постоянное соверсшенствовние навыков программирования сотрудн23213иков',
            'about_id' => $about->id,
        ]);
        AboutGrantItem::create([
            'title' => 'Конкурс',
            'description' => '11122Опыт и постоянное соверсшенствовние навыков программирования сотрудн23213иков',
            'about_id' => $about->id,
        ]);
    }
}
