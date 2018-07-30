<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJamstvaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('sv_jamstva', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vozilo_id');
            $table->integer('uporabnik_id');
            $table->integer('status');
            $table->dateTime('status_datum');
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
        Schema::dropIfExists('sv_jamstva');
    }
}
