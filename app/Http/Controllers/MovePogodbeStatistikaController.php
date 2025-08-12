<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception;
use App\Prodajalec;

class MovePogodbeStatistikaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

 	public function index()
    {
        $stranke = Prodajalec::orderBy('naziv', 'ASC')->get();
           
        return view('move-pogodbe-statistika', ["naziv_avtohise" => "", "leto" => 2024,   "id_stranke" => ""]);
    }

 	public function search(Request $request)
    {
       
        $leto = $request->input('leto');
        $id_stranke = $request->input('id_stranke');

        $stat = array();
        if (isset($id_stranke))
        {
            $stat = MovePogodbeStatistikaController::getPogodbeStatistikaStrankaWS($leto, $id_stranke);   

            
        }
        else
        {
            $stat = MovePogodbeStatistikaController::getPogodbeStatistikaWS($leto);
        }
        



        

        $stat_sum = array('januar' => 0, 'februar' => 0, 'marec' => 0,'april' => 0,'maj' => 0,'junij' => 0,'julij' => 0,'avgust' => 0,'september' => 0,'oktober' => 0,'november' => 0,'december' => 0);    
         
        foreach ($stat as $s) {
            $stat_sum['januar'] += $s->januar;
            $stat_sum['februar'] += $s->februar;
            $stat_sum['marec'] += $s->marec;
            $stat_sum['april'] += $s->april;
            $stat_sum['maj'] += $s->maj;
            $stat_sum['junij'] += $s->junij;
            $stat_sum['julij'] += $s->julij;
            $stat_sum['avgust'] += $s->avgust;
            $stat_sum['september'] += $s->september;
            $stat_sum['oktober'] += $s->oktober;
            $stat_sum['november'] += $s->november;
            $stat_sum['december'] += $s->december;             
        }

        return view('move-pogodbe-statistika', ["naziv_avtohise" => "Vse avtohiše", "stat" => $stat, "leto" => $leto, "stat_sum" => $stat_sum, "id_stranke" => $id_stranke]);
    }


    //
 	public function getPogodbeStatistikaWS($leto)
    {
        $client = new Client();
         
       
            try {
                   $response = $client->get('http://192.168.111.11/api/PogodbeJamstvaStatistika?leto='.$leto);
            }
            catch (RequestException $e) {
                    $response = $e->getResponse();
                    //$responseBodyAsString = $response->getBody()->getContents();
            }
                            
            if ($response->getStatusCode() == 200) {
                $pogodbe = $response->getBody()->getContents();
                return json_decode($pogodbe);
            }            
        
    }

    public function getPogodbeStatistikaStrankaWS($leto, $id_stranke)
    {
        $client = new Client();
         
       
            try {
                   $response = $client->get('http://192.168.111.11/api/PogodbeJamstvaStatistika?leto='.$leto.'&idStranke='.$id_stranke);
            }
            catch (RequestException $e) {
                    $response = $e->getResponse();
                    //$responseBodyAsString = $response->getBody()->getContents();
            }
                            
            if ($response->getStatusCode() == 200) {
                $pogodbe = $response->getBody()->getContents();
                return json_decode($pogodbe);
            }            
        
    }
}
