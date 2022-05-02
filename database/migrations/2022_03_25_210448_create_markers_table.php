<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('wilaya_id')->nullable();
            $table->unsignedBigInteger('commine_id')->nullable();
            $table->string('tetle',100);
            $table->double('lat', 30);
            $table->double('lng', 30);
            $table->string('image')->nullable();
            $table->double('moy')->nullable();
            $table->text('commenter')->nullable();// commenter 
            $table->string('action',10)->nullable;// active ou désactive
            $table->double('nb_visited')->nullable();// commenter 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('wilaya_id')->references('id')->on('wilays')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('commine_id')->references('id')->on('commines')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('markers');
    }
}
