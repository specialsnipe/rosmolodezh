<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('vk_url')->nullable();
            $table->string('vk_description')->nullable();
            $table->string('tg_url')->nullable();
            $table->string('tg_description')->nullable();
            $table->string('ok_url')->nullable();
            $table->string('ok_description')->nullable();
            $table->string('location')->nullable();
            $table->string('location_description')->nullable();
            $table->string('location_url')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
