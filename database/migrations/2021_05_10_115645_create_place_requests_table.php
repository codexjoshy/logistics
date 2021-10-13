<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('pickup_address');
            $table->string('delievery_address');
            $table->string('reciever_name');
            $table->string('reciever_phone');
            $table->enum('status', ['pending', 'accepted', 'in-transit', 'delievered']);
            $table->longText('note')->nullable();
            $table->longText('description')->nullable();
            $table->json('items')->nullable();
            $table->dateTime('pickup_time')->nullable();
            $table->foreignId('route_id')->nullable();
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
        Schema::dropIfExists('place_requests');
    }
}
