<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUporabnikiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('sv_uporabniki', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ime', 50);      
            $table->string('priimek', 100);      
            $table->string('kontaktna_st', 50);      
            $table->string('naslov', 100);      
            $table->string('postna_st', 50);      
            $table->string('posta_kraj', 100);                  
            $table->string('kraj_rojstva', 100);      
            $table->dateTime('datum_rojstva');      
            $table->string('email', 100);  
            $table->integer('id_avtohise');  
            $table->boolean('soglasje_1');      
            $table->boolean('soglasje_2');      
            $table->boolean('soglasje_3');          
            $table->dateTime('datum_pogodbe');       
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
        Schema::dropIfExists('sv_uporabniki');
    }
}
