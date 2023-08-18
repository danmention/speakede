<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_classes', function (Blueprint $table) {
            $table->id();
            $table->longText('url')->nullable();
            $table->mediumText('title')->nullable();
            $table->string('price',100)->default(0);
            $table->longText('description')->nullable();
            $table->string('language_id',10)->nullable();
            $table->string('user_id',50);
            $table->string('status',10)->default(1);
            $table->string('slot',10)->default(1);
            $table->date('start_date')->nullable();
            $table->string('duration_in_mins', 100)->nullable();
            $table->longText('zoom_response')->nullable();
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
        Schema::dropIfExists('group_classes');
    }
}
