<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->double('moyanne')->nullable();
            $table->double('nb_visited')->nullable();
            $table->double('rsa')->nullable();
            $table->double('rsb')->nullable();
            $table->string('name')->nullable;
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->nullable;// troi role soi admin ou vice  ou visiteur
            $table->unsignedBigInteger('wilay')->nullable();
            $table->unsignedBigInteger('commine')->nullable();
            $table->string('adrss')->nullable();
            $table->foreign('wilay')->references('id')->on('wilays')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('commine')->references('id')->on('commines')->onDelete('restrict')->onUpdate('restrict');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
