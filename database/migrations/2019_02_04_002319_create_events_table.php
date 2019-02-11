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
            $table->string('pick_address')->nullable();
            $table->string('drop_address')->nullable();
            $table->string('stop_address')->nullable();
            $table->string('flat')->nullable();
            $table->string('extra')->nullable();
            $table->string('packing')->nullable();
            $table->string('service')->nullable();
            $table->string('non_profit')->nullable();

            $table->string('truck_license')->nullable();;
            $table->text('comment')->nullable();;;
            $table->string('state')->nullable();;;
            $table->string('attach_file');
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
