<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class PogodbaStevec extends Model
{
    //
   	protected $table = 'sv_pogodbe_stevci';
 	protected $fillable = ['stevec', 'uporabnik'];

   	public static function GetStevec(){
		$result = DB::select( 
		                "SELECT LPAD(random_num,6,'0') as stevec
						FROM (
						  SELECT FLOOR(RAND() * 999999) AS random_num 
						  UNION
						  SELECT FLOOR(RAND() * 999999) AS random_num
						) AS numbers_mst_plus_1
						WHERE `random_num` NOT IN (SELECT stevec FROM sv_pogodbe_stevci)
						LIMIT 1"
		            );   	  
		 
		return $result[0]->stevec;
    }
}
