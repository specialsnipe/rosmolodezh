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
        Schema::create('about_project', function (Blueprint $table) {
            $table->id();
            $table->string('competition');
            $table->text('project_type');
            $table->text('thematic_direction');
            $table->float('request_rating');
            $table->string('request_number');
            $table->float('grant_amount');
            $table->float('co-financing');
            $table->float('all_expenses');
            $table->text('application_date');
            $table->text('implementation_period');
            $table->text('applicant');
            $table->text('inn');
            $table->text('ogrn/ogrnip');
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
        Schema::dropIfExists('about_project');
    }
};
