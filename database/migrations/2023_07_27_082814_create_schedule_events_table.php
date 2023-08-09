<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_events', function (Blueprint $table) {
            $table->id();
            $table->string('instructor_user_id', 10)->nullable();
            $table->string('student_user_id',10)->nullable();
            $table->string('booked_schedule_events_id',100)->nullable();
            $table->string('title');
            $table->date('start');
            $table->date('end');
            $table->string('status',10)->default(0);
            $table->string('type',100);
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
        Schema::dropIfExists('schedule_events');
    }
}
