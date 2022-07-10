<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\Track;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tracks = Track::all();

        $block_list = [
            [
                'title' => 'Как стать программистом',
                'body' => 'Узнать, что значит «быть программистом» и как им стать.',
                'image' => 'default_block.jpg',
                'date_start' =>now(),
                'date_end' => now()
            ],
            [
                'title' => 'О программировании',
                'body' => 'Узнать что такое программирование и чем привлекательна эта профессия.',
                'image' => 'default_block.jpg',
                'date_start' =>now(),
                'date_end' => now()
            ],
            [
                'title' => 'Виды компаний и разработки',
                'body' => 'Рассмотреть виды компаний и различные виды разработки.',
                'image' => 'default_block.jpg',
                'date_start' =>now(),
                'date_end' => now()
            ],
            [
                'title' => 'Процесс написания кода',
                'body' => 'Понять, насколько важным является процесс написания кода в программировании, и есть ли другие важные виды деятельности у программиста?',
                'image' => 'default_block.jpg',
                'date_start' =>now(),
                'date_end' => now()
            ],
            [
                'title' => 'Знания, которые не устаревают',
                'body' => 'Рассмотреть знания и навыки, которые не устаревают и не зависят от времени.',
                'image' => 'default_block.jpg',
                'date_start' =>now(),
                'date_end' => now()
            ],
            [
                'title' => 'Дополнительные материалы',
                'body' => 'Статьи и видео, подобранные командой Хекслета. Помогут глубже погрузиться в тему курса',
                'image' => 'default_block.jpg',
                'date_start' =>now(),
                'date_end' => now()
            ],
        ];
        foreach ($tracks as $track) {
            if ($track->id == 2) {
                foreach ($block_list as $block){
                    Block::create([
                        'title' => $block['title'],
                        'body' => $block['body'],
                        'image' => $block['image'],
                        'track_id' => $track->id,
                        'user_id' => $track->curator_id,
                        'date_start' => $block['date_start'],
                        'date_end' => $block['date_end'],
                    ]);
                }
                foreach ($block_list as $block){
                    Block::create([
                        'title' => $block['title'],
                        'body' => $block['body'],
                        'image' => $block['image'],
                        'track_id' => $track->id,
                        'user_id' => $track->curator_id,
                        'date_start' => $block['date_start'],
                        'date_end' => $block['date_end'],
                    ]);
                }
            }
            if ($track->id == 1) {
                foreach ($block_list as $block){
                    Block::create([
                        'title' => $block['title'],
                        'body' => $block['body'],
                        'image' => $block['image'],
                        'track_id' => $track->id,
                        'user_id' => $track->curator_id,
                        'date_start' => $block['date_start'],
                        'date_end' => $block['date_end'],
                    ]);
                }
            }
            foreach ($block_list as $block){
                Block::create([
                    'title' => $block['title'],
                    'body' => $block['body'],
                    'image' => $block['image'],
                    'track_id' => $track->id,
                    'user_id' => $track->curator_id,
                    'date_start' => $block['date_start'],
                    'date_end' => $block['date_end'],
                ]);
            }
        }
    }
}
