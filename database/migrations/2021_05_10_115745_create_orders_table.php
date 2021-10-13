<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('place_requests');
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('rider_id')->constrained('riders');
            $table->enum('status', ['pending', 'accepted', 'in-transit', 'delievered'])->default('pending');
            $table->string('customer_otp')->nullable()->unique();
            $table->string('reciever_otp')->nullable()->unique();
            $table->json('other_info')->nullable()->comment('{reassigned:true, previous_company:company_id}');
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
        Schema::dropIfExists('orders');
    }
}