<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->double('start_lat')->default(0);
            $table->double('start_lng')->default(0);
            $table->double('end_lat')->default(0);
            $table->double('end_lng')->default(0);
            $table->double('stuff_weight')->default(0);
            $table->double('sutff_width')->default(0);
            $table->double('stuff_height')->default(0);
            $table->integer('round_trip')->default(0);
            $table->double('waiting_time')->default(0)->nullable();
            $table->double('min_price')->nullable();
            $table->double('max_price')->nullable();
            $table->double('accepted_price')->nullable();
            $table->string('accepted_time')->nullable();
            $table->integer('accepted_state')->default(0);  // 0: not placed, 1: placed
            $table->integer('accepted_driver_id')->nullable();
            $table->string('ordered_time')->nullable();
            $table->string('order_title')->nullable();
            $table->text('order_content')->nullable();
            $table->integer('order_finished_state')->nullable(); // 0: progressing, 1: finished, -1: cancelled.
            $table->double('order_review_mark_from_customer')->nullable();
            $table->text('order_review_text_from_customer')->nullable();
            $table->double('order_review_mark_from_driver')->nullable();
            $table->text('order_review_text_from_driver')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
