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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('parent_id')->default(0);
            $table->longText('url')->nullable();
            $table->longText('title')->nullable();
            $table->longText('fa_icon')->nullable();
            $table->longText('featured_img')->nullable();
            $table->string('class_name',50)->nullable();
            $table->string('status',5)->default(1);
            $table->string('user_id',50)->nullable();
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
        Schema::dropIfExists('categories');
    }
};
