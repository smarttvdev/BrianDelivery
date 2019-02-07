<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->integer('job_id');
            $table->integer('position_id');
            $table->string('employeement_state');
            $table->double('hourly_pay');
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
        Schema::dropIfExists('employee_jobs');
    }
}
