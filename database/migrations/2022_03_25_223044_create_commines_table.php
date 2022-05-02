<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComminesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commines', function (Blueprint $table) {
            $table->id();
            $table->string("post_code",6);
            $table->string('name',20);
            $table->unsignedBigInteger('wilaya_id');
            $table->string('ar_name',20);
            $table->double('longitude');
            $table->double('latitude');
            $table->foreign('wilaya_id')->references('id')->on('wilays')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('commines');
    }
}
