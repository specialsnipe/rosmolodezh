<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partnership_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('body');
            $table->text('image');
            $table->foreignId('partnership_id')->constrained();
            $table->timestamps();
        });

        DB::table('partnership_items')->insert([
            'title' => 'Заголовок краткой статьи для партнёров',
            'body' => 'Краткая статья для партнёров чтобы они ознакомились с нашими предложениями и увидели зачем вообще НУЖНО с нами работать. Краткая статья для партнёров чтобы они ознакомились с нашими предложениями и увидели зачем вообще НУЖНО с нами работать. Краткая статья для партнёров чтобы они ознакомились с нашими предложениями и увидели зачем вообще НУЖНО с нами работать.',
            'partnership_id' => 1,
        ]);
        
        DB::table('partnership_items')->insert([
            'title' => 'Заголовок второй краткой статьи для партнёров',
            'body' => 'Краткая статья для партнёров чтобы они ознакомились с нашими предложениями и увидели зачем вообще НУЖНО с нами работать. Краткая статья для партнёров чтобы они ознакомились с нашими предложениями и увидели зачем вообще НУЖНО с нами работать. Краткая статья для партнёров чтобы они ознакомились с нашими предложениями и увидели зачем вообще НУЖНО с нами работать.',
            'partnership_id' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partnership_items');
    }
};
