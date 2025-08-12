<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception;
use GuzzleHttp\Exception\RequestException;
use App\Prodajalec;

class MoveStrankePaketiStatistikaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
 	public function index()
    {

        $datum_od = '2024-01-01';
        $datum_do = '2024-12-31';

        $stranke = Prodajalec::orderBy('naziv', 'ASC')->get();

        return view('move-stranke-paketi-statistika', ["naziv_avtohise" => "", "leto" => 2024,   "id_stranke" => "", "datum_od" => $datum_od, "datum_do" => $datum_do, "error" => null]);
    }

 	public function search(Request $request)
    {
       
        $datum_od = $request->input('datum_od');
        $datum_do = $request->input('datum_do');

        $datum_od_ws = $datum_od."T00:00:00";    
        $datum_do_ws = $datum_do."T23:59:59";

        $stat = array();
        $stat_sum = array('stevilo_base' => 0, 'stevilo_intensa' => 0, 'stevilo_prima' => 0,'stevilo_suprema' => 0,'stevilo_optima' => 0,'stevilo_skupaj' => 0);    
        
        $stat = MoveStrankePaketiStatistikaController::getStrankePaketiStatistikaWS($datum_od_ws, $datum_do_ws);    
                
        if (!is_array($stat)){                        
            $error = "Napaka pri pripravi poročila!";            
            return view('move-stranke-paketi-statistika', ["naziv_avtohise" => "Vse avtohiše", "stat" => $stat, "datum_od" => $datum_od, "datum_do" => $datum_do, "stat_sum" => $stat_sum, "error" => $error]);
        }
                                           
        foreach ($stat as $s) {
            $stat_sum['stevilo_base'] += $s->stevilo_base;
            $stat_sum['stevilo_intensa'] += $s->stevilo_intensa;
            $stat_sum['stevilo_prima'] += $s->stevilo_prima;
            $stat_sum['stevilo_suprema'] += $s->stevilo_suprema;
            $stat_sum['stevilo_optima'] += $s->stevilo_optima;            
            $stat_sum['stevilo_skupaj'] += $s->stevilo_skupaj;       
        }

        return view('move-stranke-paketi-statistika', ["naziv_avtohise" => "Vse avtohiše", "stat" => $stat, "datum_od" => $datum_od, "datum_do" => $datum_do, "stat_sum" => $stat_sum]);
    }


    //
 	public function getStrankePaketiStatistikaWS($datum_od, $datum_do)
    {
        $client = new Client();
                
        try {
               $response = $client->get('http://192.168.111.11/api/StrankePaketiStatistika?datumOd='.$datum_od.'&datumDo='.$datum_do);
        }
        catch (RequestException $e) {
                $response = $e->getResponse();
        }
        catch (RequestException $e) {
                $response = $e->getResponse();
        }               
        catch (Exception $e) {
                $response = $e->getResponse();
        }               

        if ($response->getStatusCode() == 200) {
            $pogodbe = $response->getBody()->getContents();
            return json_decode($pogodbe);
        }            
        
    }
    
}
