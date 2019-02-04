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
            $table->integer('employee_id');
            $table->integer('event_id');
            $table->integer('position_id');
            $table->string('employeement_state');
            $table->double('pay_amount');
            $table->double('bonus')->default(0);
            $table->double('extra')->default(0);
            $table->double('packing')->default(0);
            $table->double('service')->default(0);
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
