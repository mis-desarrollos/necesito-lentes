<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->time('hour')->nullable();

            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->longText('comments')->nullable();

            $table->unsignedBigInteger('users_id_optician')->nullable();;
            $table->unsignedBigInteger('users_id')->nullable();;
            $table->enum('status',['Pendiente','Finalizado','Cancelado'])->nullable();;

            $table->foreign('users_id_optician')->references('id')->on('users');
            $table->foreign('users_id')->references('id')->on('users');
            
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
        Schema::dropIfExists('exams');
    }
}
