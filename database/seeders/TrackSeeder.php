<?php

namespace Database\Seeders;

use App\Models\Track;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Track::create([
            'title' => 'Дизайн',
            'image' => 'track_design.jpg',
            'icon' => 'design_icon.svg',
            'body' => 'Это направление дизайна, здесь вы обучитесь основам как графического дизайна так и дизайна веб-страниц и сделаете свои первые шаги в этом не простом направлении',
            'tg_url' => 'https://t.me/+zkLRoaZN43JmN2Uy',
        ]);
        Track::create([
            'title' => 'Программирование',
            'image' => 'track_dev.jpg',
            'icon' => 'dev_icon.svg',
            'body' => 'Это направление программирования, здесь вы обучитесь основам объектно ориентированного программирования и сделаете свои первые шаги в этом не простом направлении',
            'tg_url' => 'https://t.me/+CHIKjy7S41hiZWQy',
        ]);
        Track::create([
            'title' => 'Вёрстка',
            'image' => 'track_layout.jpg',
            'icon' => 'layout_icon.svg',
            'body' => 'Это направление вёрстки, здесь вы обучитесь основам разметки веб-страниц и сделаете свои первые шаги в этом не простом направлении',
            'tg_url' => 'https://t.me/+ZFz_rliEJNk5ZWFi',
        ]);
    }
}
