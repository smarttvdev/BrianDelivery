<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('variation')->nullable();
            $table->double('hourly_pay')->default(0);
            $table->double('hourly_percent')->default(0);
            $table->double('flat_percent')->default(0);
            $table->double('extra_percent')->default(0);
            $table->double('packing_percent')->default(0);
            $table->double('service_percent')->default(0);
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
        Schema::dropIfExists('jobs');
    }
}
