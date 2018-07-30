<?php

use Illuminate\Database\Seeder;

class JamstvoTipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		         
		\App\JamstvoTip::create( [
		'koda'=>'',
		'naziv'=>'',
		'prevozeni_km'=>0,
		'starost_vozila'=>0,
		'prostornina_motorja_od'=>0,
		'prostornina_motorja_do'=>0
		] );
		         
		\App\JamstvoTip::create( [
		'koda'=>'BASE 01',
		'naziv'=>'BASE od 0 do 1300 ccm',
		'prevozeni_km'=>230000,
		'starost_vozila'=>13,
		'prostornina_motorja_od'=>0,
		'prostornina_motorja_do'=>1300
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'BASE 02',
		'naziv'=>'BASE od 1301 do 2500 ccm',
		'prevozeni_km'=>230000,
		'starost_vozila'=>13,
		'prostornina_motorja_od'=>1301,
		'prostornina_motorja_do'=>2500
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'BASE 03',
		'naziv'=>'BASE od 2501 do 4000 ccm',
		'prevozeni_km'=>230000,
		'starost_vozila'=>13,
		'prostornina_motorja_od'=>2501,
		'prostornina_motorja_do'=>4000
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'BASE PKT1',
		'naziv'=>'BASE paket od 0 do 4000',
		'prevozeni_km'=>230000,
		'starost_vozila'=>13,
		'prostornina_motorja_od'=>0,
		'prostornina_motorja_do'=>4000
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'BASE PKT2',
		'naziv'=>'BASE paket od 0 do 2500',
		'prevozeni_km'=>230000,
		'starost_vozila'=>13,
		'prostornina_motorja_od'=>0,
		'prostornina_motorja_do'=>2500
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'INTENSA01',
		'naziv'=>'INTENSA od 0 do 1300 ccm',
		'prevozeni_km'=>180000,
		'starost_vozila'=>10,
		'prostornina_motorja_od'=>0,
		'prostornina_motorja_do'=>1300
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'INTENSA02',
		'naziv'=>'INTENSA od 1301 do 2500 ccm',
		'prevozeni_km'=>180000,
		'starost_vozila'=>10,
		'prostornina_motorja_od'=>1301,
		'prostornina_motorja_do'=>2500
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'INTENSA03',
		'naziv'=>'INTENSA od 2501 do 4000 ccm',
		'prevozeni_km'=>180000,
		'starost_vozila'=>10,
		'prostornina_motorja_od'=>2501,
		'prostornina_motorja_do'=>4000
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'INTENSAPK1',
		'naziv'=>'INTENSA PK1od 0 do 4000 ccm',
		'prevozeni_km'=>180000,
		'starost_vozila'=>10,
		'prostornina_motorja_od'=>0,
		'prostornina_motorja_do'=>4000
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'INTENSAPK2',
		'naziv'=>'INTENSA PK2 od 0 do 2500 ccm',
		'prevozeni_km'=>180000,
		'starost_vozila'=>10,
		'prostornina_motorja_od'=>0,
		'prostornina_motorja_do'=>2500
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'PRIMA01',
		'naziv'=>'PRIMA od 0 do 1300 ccm',
		'prevozeni_km'=>200000,
		'starost_vozila'=>12,
		'prostornina_motorja_od'=>0,
		'prostornina_motorja_do'=>1300
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'PRIMA02',
		'naziv'=>'PRIMA od 1301 do 2500 ccm',
		'prevozeni_km'=>200000,
		'starost_vozila'=>12,
		'prostornina_motorja_od'=>1301,
		'prostornina_motorja_do'=>2500
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'PRIMA03',
		'naziv'=>'PRIMA od 2501 do 4000 ccm',
		'prevozeni_km'=>200000,
		'starost_vozila'=>12,
		'prostornina_motorja_od'=>2501,
		'prostornina_motorja_do'=>4000
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'PRIMAPK1',
		'naziv'=>'PRIMA PK1 od 0 do 4000 ccm',
		'prevozeni_km'=>200000,
		'starost_vozila'=>12,
		'prostornina_motorja_od'=>0,
		'prostornina_motorja_do'=>4000
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'PRIMAPK2',
		'naziv'=>'PRIMA PK2 od 0 do 2500 ccm',
		'prevozeni_km'=>200000,
		'starost_vozila'=>12,
		'prostornina_motorja_od'=>0,
		'prostornina_motorja_do'=>2500
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'SUPREMA01',
		'naziv'=>'SUPREMA od 0 do 1300 ccm',
		'prevozeni_km'=>150000,
		'starost_vozila'=>7,
		'prostornina_motorja_od'=>0,
		'prostornina_motorja_do'=>1300
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'SUPREMA02',
		'naziv'=>'SUPREMA od 1301 do 2500 ccm',
		'prevozeni_km'=>150000,
		'starost_vozila'=>7,
		'prostornina_motorja_od'=>1301,
		'prostornina_motorja_do'=>2500
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'SUPREMA03',
		'naziv'=>'SUPREMA od 2501 do 4000 ccm',
		'prevozeni_km'=>150000,
		'starost_vozila'=>7,
		'prostornina_motorja_od'=>2501,
		'prostornina_motorja_do'=>4000
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'SUPREMAPK1',
		'naziv'=>'SUPREMA PK1 od 0 do 4000 ccm',
		'prevozeni_km'=>150000,
		'starost_vozila'=>7,
		'prostornina_motorja_od'=>0,
		'prostornina_motorja_do'=>4000
		] );


					
		\App\JamstvoTip::create( [
		'koda'=>'SUPREMAPK2',
		'naziv'=>'SUPREMA PK2 od 0 do 2500 ccm',
		'prevozeni_km'=>150000,
		'starost_vozila'=>7,
		'prostornina_motorja_od'=>0,
		'prostornina_motorja_do'=>2500
		] );

    }
}
