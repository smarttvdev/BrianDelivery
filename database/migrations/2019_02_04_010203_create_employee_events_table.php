<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->integer('employee_id');
            $table->integer('job_id');
            $table->integer('position_id');
            $table->string('start_time')->nullable();
            $table->string('finish_time')->nullable();
            $table->string('travel_time')->nullable();
            $table->string('total_hours')->nullable();
            $table->string('labor_hours')->nullable();
            $table->string('non_profit_percent')->nullable();
            $table->string('hourly_pay')->nullable();
            $table->string('hourly_percent')->nullable();
            $table->string('flat_percent')->nullable();
            $table->string('extra_percent')->nullable();
            $table->string('packing_percent')->nullable();
            $table->string('service_percent')->nullable();
            $table->string('tips')->nullable();
            $table->string('hourly_rate')->nullable();
            $table->string('discount')->nullable();
            $table->string('bonus')->nullable();
            $table->string('job_total')->nullable();
            $table->string('payment_description')->nullable();
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
        Schema::dropIfExists('employee_events');
    }
}
