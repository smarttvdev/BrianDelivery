<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverInformationsTable extends Migration
{

    public function up()
    {
        Schema::create('driver_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->double('rate')->default(0);
            $table->double('earned')->default(0);
            $table->double('lat')->default(0);
            $table->double('lng')->default(0);
            $table->string('last_activity_time')->nullable();
            $table->string('state')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('driver_informations');
    }
}
