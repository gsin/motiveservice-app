<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVozilaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('sv_vozila', function (Blueprint $table) {
            $table->increments('id');
            $table->string('znamka', 50);
            $table->string('model', 50);
            $table->string('registrska_st', 50);
            $table->string('st_sasije', 50);
            $table->string('moc_motorja', 50);
            $table->string('tip_motorja', 50);
            $table->date('prva_registracija');
            $table->integer('km');
            $table->integer('ccm');
            $table->string('gorivo', 50);
            $table->string('pogon', 50);
            $table->string('menjalnik', 50);
            $table->boolean('komercialno_vozilo');
            $table->dateTime('datum_prodaje');
            $table->dateTime('veljavnost_od');
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
        Schema::dropIfExists('sv_vozila');
    }
}
