<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWilaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wilays', function (Blueprint $table) {
            $table->id();
            $table->string("code",3);
            $table->string('name',20);
            $table->string('ar_name',20);
            $table->double('longitude');
            $table->double('latitude');
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
        Schema::dropIfExists('wilays');
    }
}
