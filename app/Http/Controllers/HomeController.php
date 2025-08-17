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

        $optima_care_visible = true;
        
        if ($this->isTestUser()) {
            return view('home-new', [ "oznake" => $oznake, "optima_care_visible" => $optima_care_visible ]);
        }
        else {
            return view('home', [ "oznake" => $oznake, "optima_care_visible" => $optima_care_visible ]);
        }
 
    }

    /**
     * Check if the current user is a test user
     * 
     * @return bool
     */
    private function isTestUser()
    {
        $userId = Auth::user()->id;
        return in_array($userId, [10, 5, 18]);
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
