<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('specialist_id');
            $table->string('comment');
            $table->decimal('rating', 3, 1); 
            $table->integer('service_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('recommendations');
    }
};
