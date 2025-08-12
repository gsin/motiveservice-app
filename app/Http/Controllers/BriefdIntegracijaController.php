<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception;

class BriefdIntegracijaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
 	public function index()
    {        
        $pogodbe = BriefdIntegracijaController::getNepreneseniWS();
        
        return view('briefd-nepreneseni', ["pogodbe" => $pogodbe ]);
        
    }

 	public function search(Request $request)
    { 

        $pogodbe  = BriefdIntegracijaController::getNepreneseniWS();
         
        	
        return view('briefd-nepreneseni', ["aktivacije" => $pogodbe  ]);
    }


    public function post(Request $request)
    { 

        BriefdIntegracijaController::postPrenesiPogodbeWS();
        $pogodbe  = BriefdIntegracijaController::getNepreneseniWS(); 
        
       return view('briefd-nepreneseni', ["pogodbe" => $pogodbe ]);
    }


    //
 	public function getNepreneseniWS()
    {
        $client = new Client();
            
         
        try {
               $response = $client->get('http://192.168.111.11/api/BriefdIntegracija?status=0');
        }
        catch (RequestException $e) {
                $response = $e->getResponse();                
        }
                        
        if ($response->getStatusCode() == 200) {
            $pogodbe = $response->getBody()->getContents();
            return json_decode($pogodbe);
        }            
        
    }

    public function postPrenesiPogodbeWS()
    {
        $client = new Client();
            
         
        try {
               $response = $client->post('http://192.168.111.11/api/BriefdIntegracija');
        }
        catch (RequestException $e) {
                $response = $e->getResponse();                
        }                        
        
    }
}
