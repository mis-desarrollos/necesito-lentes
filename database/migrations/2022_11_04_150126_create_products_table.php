<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('width')->nullable();
            $table->string('high')->nullable();
            $table->string('long')->nullable();
            $table->unsignedBigInteger('materials_id')->nullable();;
            $table->unsignedBigInteger('packages_id')->nullable();;
            $table->unsignedBigInteger('coverings_id')->nullable();;

            $table->foreign('materials_id')->references('id')->on('materials');
            $table->foreign('packages_id')->references('id')->on('packages');
            $table->foreign('coverings_id')->references('id')->on('coverings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
