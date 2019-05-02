<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleInformationsTable extends Migration
{
    public function up()
    {
        Schema::create('vehicle_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('driver_id');
            $table->string('driver_license')->nullable();
            $table->string('vehicle_registration')->nullable();
            $table->string('proof_insurance')->nullable();
            $table->string('vehicle_picture_in')->nullable();
            $table->string('vehicle_picture_out')->nullable();
            $table->integer('max_seats')->nullable();
            $table->double('max_stuff_weight')->nullable();
            $table->double('max_stuff_width')->nullable();
            $table->double('max_stuff_height')->nullable();

            $table->integer('driver_license_agreed_state')->default(0);
            $table->integer('vehicle_registration_agreed_state')->default(0);
            $table->integer('proof_insurance_agreed_state')->default(0);
            $table->integer('vehicle_picture_in_agreed_state')->default(0);
            $table->integer('vehicle_picture_out_agreed_state')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicle_informations');
    }
}
