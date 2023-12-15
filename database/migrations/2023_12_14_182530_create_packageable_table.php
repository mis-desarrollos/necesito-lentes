<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('packageables', function (Blueprint $table) {
            $table->id();
            $table->morphs('packageable');
            $table->unsignedBigInteger('package_id');
            $table->timestamps();

            $table->foreign('package_id')->references('id')->on('packages');
        });
        
        Schema::table('packages', function (Blueprint $table) {
            $table->unsignedInteger('level')->after('description')->default(1);
        });
        
        Schema::table('frames', function (Blueprint $table) {
            $table->string('image')->after('description')->nullable();
            $table->dropConstrainedForeignId('materials_id');
            $table->dropConstrainedForeignId('packages_id');
        });

        Schema::table('antireflectives', function (Blueprint $table) {
            $table->string('color')->after('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packageables');

        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('level');
        });
        
        Schema::table('frames', function (Blueprint $table) {
            $table->dropColumn('image');
            
            $table->unsignedBigInteger('materials_id')->nullable();;
            $table->unsignedBigInteger('packages_id')->nullable();;

            $table->foreign('materials_id')->references('id')->on('materials');
            $table->foreign('packages_id')->references('id')->on('packages');
        });

        Schema::table('antireflectives', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
}
