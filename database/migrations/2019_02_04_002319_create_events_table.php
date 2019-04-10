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
            $table->integer('job_id');
            $table->integer('customer_id');
            $table->string('pick_address')->nullable();
            $table->string('drop_address')->nullable();
            $table->text('stop_address')->nullable();
            $table->double('non_profit')->default(0);
            $table->double('flat')->default(0);
            $table->double('hourly_rate')->default(0);
            $table->double('packing')->default(0);
            $table->double('service')->default(0);
            $table->double('extra')->default(0);
            $table->double('job_total')->default(0);
            $table->double('discount')->default(0);
            $table->double('tips')->default(0);
            $table->string('truck_license')->nullable();
            $table->string('attach_file')->nullable();
            $table->text('comment')->nullable();
            $table->string('start_time')->nullable();
            $table->string('finish_time')->nullable();
            $table->double('labor_hours')->default(0);
            $table->double('travel_time')->default(0);
            $table->double('total_hours')->default(0);
            $table->string('state')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}
