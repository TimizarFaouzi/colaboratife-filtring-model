<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historiques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_id_marker');
            $table->Integer('vi_form')->nullable();
            $table->Integer('vi_this')->nullable();
            $table->BigInteger('nb_visite');
            $table->unsignedBigInteger('marker_id');
            $table->text('comm')->nullable();
            $table->double('votes')->nullable();
            $table->double('nb_check')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('user_id_marker')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');

            $table->foreign('marker_id')->references('id')->on('markers')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('historiques');
    }
}
