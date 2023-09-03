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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->longText('url')->nullable();
            $table->longText('title')->nullable();
            $table->longText('cover_image')->nullable();
            $table->string('price',100)->default(0);
            $table->longText('description')->nullable();
            $table->longText('youtube_link')->nullable();
            $table->string('language',10)->nullable();
            $table->string('user_id',50);
            $table->string('use_cases_id',50);
            $table->string('type',50);
            $table->string('status',10)->default(1);
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
        Schema::dropIfExists('courses');
    }
};
