<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunicationPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communication_payments', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('instructor_id');
            $table->longText('reference_no');
            $table->string('schedule_events_id')->nullable();
            $table->string('status')->default(0);
            $table->string('is_active')->default("yes");
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
        Schema::dropIfExists('communication_payments');
    }
}
