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
            $table->integer('position_id');
            $table->integer('employee_id');
            $table->double('total_hours')->default(0);
            $table->double('non_profit_percent')->default(0);
            $table->double('discount_percent')->default(0);
            $table->double('tips_percent')->default(0);
            $table->double('bonus')->default(0);
            $table->double('hourly_pay')->default(0);
            $table->double('hourly_percent')->default(0);
            $table->double('flat_percent')->default(0);
            $table->double('extra_percent')->default(0);
            $table->double('packing_percent')->default(0);
            $table->double('service_percent')->default(0);
            $table->text('payment_description')->nullable();
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

