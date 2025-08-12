<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception;
use GuzzleHttp\Exception\RequestException;
use App\Prodajalec;

use Illuminate\Support\Facades\Auth;


class MoveStrankeRentabilnostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

 	public function index()
    {        
     
        $datum_od = '2024-01-01';
        $datum_do = '2024-12-31';
        
        return view('move-stranke-rentabilnost', ["naziv_avtohise" => "", "leto" => 2024,   "id_stranke" => "", "datum_od" => $datum_od, "datum_do" => $datum_do, "error" => null]);
    }

 	public function search(Request $request)
    {
       
        $datum_od = $request->input('datum_od');
        $datum_do = $request->input('datum_do');

        $datum_od_ws = $datum_od."T00:00:00";    
        $datum_do_ws = $datum_do."T23:59:59";

        $stat = array();
        $stat_sum = array('sum_stevilo_jamstev' => 0, 'sum_stevilo_okvar' => 0, 'sum_denar_not' => 0,'sum_denar_ven' => 0);    
        
        $stat = MoveStrankeRentabilnostController::getStrankeRentabilnostWS($datum_od_ws, $datum_do_ws);    
                
        if (!is_array($stat)){                        
            $error = "Napaka pri pripravi poročila!";            
            return view('move-stranke-rentabilnost', ["naziv_avtohise" => "Vse avtohiše", "stat" => $stat, "datum_od" => $datum_od, "datum_do" => $datum_do, "stat_sum" => $stat_sum, "error" => $error]);
        }
                                           
        foreach ($stat as $s) {
            $stat_sum['sum_stevilo_jamstev'] += $s->sum_stevilo_jamstev;
            $stat_sum['sum_stevilo_okvar'] += $s->sum_stevilo_okvar;            
            $stat_sum['sum_denar_not'] += $s->sum_denar_not;
            $stat_sum['sum_denar_ven'] += $s->sum_denar_ven;                        
        }

        return view('move-stranke-rentabilnost', ["naziv_avtohise" => "Vse avtohiše", "stat" => $stat, "datum_od" => $datum_od, "datum_do" => $datum_do, "stat_sum" => $stat_sum]);
    }


    //
 	public function getStrankeRentabilnostWS($datum_od, $datum_do)
    {
        $client = new Client();
                
        try {
               $response = $client->get('http://192.168.111.11/api/StrankeRentabilnost?datumOd='.$datum_od.'&datumDo='.$datum_do);
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
