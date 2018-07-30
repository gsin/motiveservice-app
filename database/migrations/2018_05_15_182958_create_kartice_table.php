<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKarticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('sv_kartice_vozil', function (Blueprint $table) {
            $table->increments('id');

            // Jamstvo    
            $table->integer('sifra')->nullable(); 
            $table->string('tip_jamstva', 20);     
            $table->integer('veljavnost_mesecev');  

            $table->integer('dodatek_avt_menj')->nullable()->default(0);  
            $table->integer('dodatek_km')->nullable()->default(0);  


            $table->string('sifra_avtohise', 20);  
            $table->integer('soglasje_1')->nullable()->default(0);      
            $table->integer('soglasje_2')->nullable()->default(0);      
            $table->integer('soglasje_3')->nullable()->default(0);          
            $table->dateTime('datum_pogodbe')->nullable();     
            $table->dateTime('datum_podpisa')->nullable();     
            $table->dateTime('datum_soglasja')->nullable();     
            
            // Uporabnik 
            $table->string('ime_priimek', 100);      
            $table->string('kontaktna_st', 50)->nullable();      
            $table->string('naslov', 100);      
            $table->string('postna_st', 50);      
            $table->string('kraj', 100)->nullable();                  
            $table->string('kraj_rojstva', 100)->nullable();      
            $table->dateTime('datum_rojstva')->nullable();      
            $table->string('email', 100)->nullable();
            
            // Vozilo 
            $table->integer('id_znamke');
            $table->string('znamka', 50)->nullable();
            $table->string('model', 50);
            $table->string('registrska_st', 50);
            $table->string('st_sasije', 50);
            $table->string('moc_motorja', 50)->nullable();
            $table->string('tip_motorja', 50)->nullable();
            
            $table->dateTime('datum_prve_reg');
            $table->integer('km');
            $table->integer('ccm');
            $table->string('gorivo', 50)->nullable();
            $table->string('pogon', 50)->nullable();            
            $table->string('menjalnik', 50);
            $table->integer('komercialno_vozilo')->nullable()->default(0);
            $table->dateTime('datum_predaje')->nullable();
            $table->dateTime('datum_jamstvo_od')->nullable();

            $table->integer('userId');
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
        Schema::dropIfExists('sv_kartice_vozil');
    }
}
