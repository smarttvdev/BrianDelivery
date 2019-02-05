<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pick_address');
            $table->string('drop_address');
            $table->string('start_time');
            $table->string('finish_time');
            $table->string('labor_hours');
            $table->string('travel_time');
            $table->string('total_hours');
            $table->double('discount')->default(0);
            $table->double('job_total');
            $table->string('truck_license');
            $table->text('comment');
            $table->string('state');
            $table->double('tips')->default(0);
            $table->string('bonus');
            $table->string('attach_file');
            $table->double('non_profit')->default(0);
            $table->string('job_id');
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
        Schema::dropIfExists('events');
    }
}
