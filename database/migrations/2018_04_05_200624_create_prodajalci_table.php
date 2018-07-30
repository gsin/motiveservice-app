<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdajalciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('sv_prodajalci', function (Blueprint $table) {
            $table->increments('id');
            $table->string('koda', 10);            
            $table->string('naziv', 50);            
            $table->integer('status')->default(0);         
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
        Schema::dropIfExists('sv_prodajalci');
    }
}
