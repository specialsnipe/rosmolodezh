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
        Schema::create('partnerships', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('body');
            $table->text('image')->nullable();
            $table->timestamps();
        });
        DB::table('partnerships')->insert([
            'title'=>'Заголовок партнёрства',
            'body'=>'Текстовая информация о партнёрстве с нами',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partnerships');
    }
};
