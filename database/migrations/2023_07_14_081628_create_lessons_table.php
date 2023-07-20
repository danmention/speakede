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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->longText('url')->nullable();
            $table->string('course_id',50);
            $table->longText('lesson_name')->nullable();
            $table->string('lesson_title')->nullable();
            $table->string('start_time')->nullable();
            $table->string('description')->nullable();
            $table->string('end_time')->nullable();
            $table->longText('youtube_link')->nullable();
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
        Schema::dropIfExists('lessons');
    }
};
