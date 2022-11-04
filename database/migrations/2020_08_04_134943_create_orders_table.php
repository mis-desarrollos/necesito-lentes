<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->decimal('total',8,2);
            $table->decimal('subtotal',8,2);
            $table->decimal('tax',8,2);
            $table->decimal('shippingCost',8,2)->nullable();
            $table->string('street');
            $table->String('num_ext')->nullable();
            $table->String('num_int')->nullable();
            $table->string('neighborhood');
            $table->string('zipcode');
            $table->string('status');
            
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('town_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('town_id')->references('id')->on('towns');

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
