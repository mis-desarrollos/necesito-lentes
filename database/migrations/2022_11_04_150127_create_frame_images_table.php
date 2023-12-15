<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrameImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frame_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('frame_id')->nullable();
            $table->unsignedBigInteger('images_id')->nullable();
         
            $table->foreign('frame_id')->references('id')->on('frames');
            $table->foreign('images_id')->references('id')->on('images');

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
        Schema::dropIfExists('frame_images');
    }
}
