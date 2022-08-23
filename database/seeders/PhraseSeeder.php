<?php

namespace Database\Seeders;

use App\Models\Phrase;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PhraseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phrases = [
            'Чтобы достичь высот надо к ним идти',
            "Мы лучшие потому-что мы - профессионалы",
            "Профессионализм приходит с практикой",
            "Будь с нами и становись умнее",
            "Чем больше практики тем больше знаний",
            "Уверенность в своих силах - залог успеха!",
        ];

        foreach ($phrases as $phrase) {
            Phrase::create([
                'body' => $phrase
            ]);
        }
    }
}
