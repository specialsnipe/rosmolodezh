<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new

class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('icon')->nullable();
            $table->text('body');
            $table->string('tg_url');
            $table->foreignId('curator_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracks');
    }
};
