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
        Schema::create('class_call_histories', function (Blueprint $table) {
            $table->id();
            $table->string('initiate_user_id',50);
            $table->string('user_id',50);
            $table->longText('url')->nullable();
            $table->string('type');
            $table->string('status',10);
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
        Schema::dropIfExists('class_call_histories');
    }
};
