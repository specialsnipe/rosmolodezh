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
        Schema::table('information', function (Blueprint $table) {
            $table->string('tg_bot_url')->default('https://t.me/nethammerOnline_bot');
            $table->string('tg_bot_description')->default('Это телеграм-бот, который связывает участников проекта с кураторами и обеспечивает мотивацией');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('information', function (Blueprint $table) {
            $table->dropColumn('tg_bot_url');
            $table->dropColumn('tg_bot_description');
        });
    }
};
