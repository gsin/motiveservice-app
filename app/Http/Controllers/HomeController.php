<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\KarticaVozila;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sifraAvtohise = Auth::user()->sifra_avtohise;
        $userId = Auth::user()->id; 
        //dd(Auth::user()->id);

        $oznake_proste = HomeController::getPredzakupljeneWS($sifraAvtohise);
        $oznake_aktivirane = KarticaVozila::where('sifra_avtohise', Auth::user()->sifra_avtohise)->get();
        $oznake = array();



        foreach ($oznake_proste as $o) {
            $aktivirano = false;
            $oznaka_jamstva = substr($o, 0, strpos($o, ' ('));
            $tip_jamstva = trim(substr($o, strpos($o, '(')+1, strlen(substr($o, strpos($o, '(')+1)) -1));

            if ($userId == 1) {
                //dd($oznaka_jamstva);
                //if ($tip_jamstva == "999814 SLI") {
                //        
                //}    
            }


            foreach ($oznake_aktivirane as $a) { 
                if ($oznaka_jamstva == $a->oznaka_jamstva) {
                    $aktivirano = true;
                    break;
                }
            }        
            if ($aktivirano == false) {
                $oznake[] = $o;                
            }    

        }

        
        //dd($oznakePrikaz);        

        //$oznake = array();
        /*
        if (Auth::user()->isAdmin())  
        {
            
            $aktivacije = KarticaVozila::limit(10)->get()->sortByDesc("id");    
        }
        else
        {
            $aktivacije = KarticaVozila::limit(10)->where('sifra_avtohise', Auth::user()->sifra_avtohise)->sortByDesc("id")->get();
        }
        */

        //return view('aktivacija', [ "aktivacije" => $aktivacije ]);

        $optima_care_visible = true;
        /*switch ($sifraAvtohise) {
            case '136':
            case '10255':
            case '543':
            case '579': 
                $optima_care_visible = true;
                break;                        
        }*/


        return view('home', [ "oznake" => $oznake, "optima_care_visible" => $optima_care_visible ]);
        //return view('home', [ "aktivacije" => $aktivacije ]);
    }

    public function getPredzakupljeneWS($sifra_avtohise)
    {
        $client = new Client();
            
        // osvežuj kar vse
        $aktivacije = KarticaVozila::get();
        foreach ($aktivacije as $a) {                
            try {
                   $response = $client->get('http://192.168.111.11/api/PogodbeZakupljene?idAvtohise='.$sifra_avtohise);
            }
            catch (RequestException $e) {
                    $response = $e->getResponse();
                    //$responseBodyAsString = $response->getBody()->getContents();
            }
                            
            if ($response->getStatusCode() == 200) {
                $oznake = $response->getBody()->getContents();
                return json_decode($oznake);
            }            
        }
    }
}
