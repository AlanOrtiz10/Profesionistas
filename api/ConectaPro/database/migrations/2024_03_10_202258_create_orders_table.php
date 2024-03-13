<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->text('additional_details')->nullable();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('specialist_id');
            $table->unsignedBigInteger('user_id');
            $table->string('order_status')->default('pending'); // Nueva columna para order_status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
