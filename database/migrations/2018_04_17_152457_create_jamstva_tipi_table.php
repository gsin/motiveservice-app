<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJamstvaTipiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sv_jamstva_tipi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('koda');     
            $table->string('naziv');     
            $table->integer('prevozeni_km');     
            $table->integer('starost_vozila'); 
            $table->integer('prostornina_motorja_od');     
            $table->integer('prostornina_motorja_do');     

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
        Schema::dropIfExists('sv_jamstva_tipi');
    }
}
