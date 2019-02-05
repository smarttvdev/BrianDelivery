<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_pays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->integer('event_id');
            $table->double('pay_amount');
            $table->double('bonus')->default(0);
            $table->double('extra')->default(0);
            $table->double('packing')->default(0);
            $table->double('service')->default(0);
            $table->double('tips')->default(0);
            $table->double('non_profit')->default(0);
            $table->double('discount')->default(0);
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
        Schema::dropIfExists('employee_pays');
    }
}
