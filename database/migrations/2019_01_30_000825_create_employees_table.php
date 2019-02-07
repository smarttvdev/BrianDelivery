<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{

    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->double('bonus')->default(0);
            $table->string('gender')->default('male');
            $table->string('pictureID')->nullable();
            $table->dateTime('employeement_time');
            $table->date('promotion_date')->nullable();
            $table->string('state')->default('activate');
            $table->string('paid_method')->nullable();
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
