<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception;

class MovePopustiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
 	public function index()
    {        
        return view('move-popusti', ["naziv_avtohise" => ""]);
    }

 	public function search(Request $request)
    {
        $naziv_avtohise = $request->input('naziv_avtohise');
        if (!isset($naziv_avtohise))
            $naziv_avtohise="TOP1000";

        $popusti = MovePopustiController::getPopustiWS($naziv_avtohise);
         
        	
        return view('move-popusti', ["naziv_avtohise" => $naziv_avtohise, "popusti" => $popusti ]);
    }


    //
 	public function getPopustiWS($naziv)
    {
        $client = new Client();
            
         
        try {
               $response = $client->get('http://192.168.111.11/api/Popusti?naziv='.$naziv);
        }
        catch (RequestException $e) {
                $response = $e->getResponse();                
        }
                        
        if ($response->getStatusCode() == 200) {
            $popusti = $response->getBody()->getContents();
            return json_decode($popusti);
        }            
        
    }
}
