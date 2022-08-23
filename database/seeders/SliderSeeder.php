<?php

namespace Database\Seeders;

use App\Models\SliderItem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SliderItem::create([
            'title' => 'Программирование о мыслях',
            'body' => 'Для того чтобы программировать нужно думать о том как бы всё укоплектовать
            с учётом современных тенденций, стандартов и паттернов, перейдя по ссылке вы ознакомитесь с этими основами
            и пройдёте наш курс.',
            'button_name' => 'Перейти на направление "Программирование"',
            'button_link' => '/tracks/2',
            'image' => 'slider_image_1.jpg',
            'active' => true,
            'user_id' => 1,
            'user_updater_id' => 1,
        ]);

        SliderItem::create([
            'title' => 'Дизайн - творчество',
            'body' => 'Много людей хотят выводить своё творчество на уровень повыше, начинать показывать его друзьям или
            даже продавать его. Проходите наш курс и вы научитесь делать это красиво.',
            'button_name' => 'Перейти на направление "Дизайн"',
            'button_link' => '/tracks/1',
            'image' => 'slider_image_2.jpg',
            'active' => true,
            'user_id' => 1,
            'user_updater_id' => 1,
        ]);

        SliderItem::create([
            'title' => 'Матрица',
            'body' => 'Матрица матрица матрица, Киану Ривз знает толк в вёрстке, наверное, но в общем и целом
            вы сможете превзойти самого Киану Ривза, так что переходи и делай сайт похожий на матрицу.. . ... . ..',
            'button_name' => 'Перейти на направление "Вёрстка"',
            'button_link' => '/tracks/3',
            'image' => 'slider_image_3.jpg',
            'active' => true,
            'user_id' => 1,
            'user_updater_id' => 1,
        ]);
    }
}
