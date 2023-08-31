<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_ratings', function (Blueprint $table) {
            $table->id();
            $table->longText('fullname')->nullable();
            $table->longText('email')->nullable();
            $table->longText('review')->nullable();
            $table->string('user_id')->nullable();
            $table->string('instructor_id')->nullable();
            $table->string('course_id')->nullable();
            $table->string('rating')->nullable();
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
        Schema::dropIfExists('course_ratings');
    }
}
