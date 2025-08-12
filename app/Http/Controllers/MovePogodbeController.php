<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception;
use App\Prodajalec;
use Auth;   

class MovePogodbeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
 	public function index()
    {
        
        $naziv_avtohise = "";
        $admin = Auth::user()->isAdmin();
        $komercialist = Auth::user()->isKomercialist();
        $stranke = array();    

        $id_stranke = "";

        if ($admin)  
        {             
             $title = "Pregled pogodb MOVE";             
             $stranke = MovePogodbeController::getStrankeWS("");       

             if (isset($request))   {
                $id_stranke = $request->input('id_stranke');   
             }
             
        }
        else
        {
            $title = "Pogodbe";
            $naziv_avtohise = (Prodajalec::where('koda', Auth::user()->sifra_avtohise)->first())->naziv;
            
        }

        return view('move-pogodbe', ["naziv_avtohise" => $naziv_avtohise,  "admin" =>$admin, "id_stranke" =>  $id_stranke, "komercialist" =>$komercialist, "stranke" => $stranke ]); 

        //return view('move-pogodbe', ["naziv_avtohise" => $naziv_avtohise,  "admin" =>$admin, "id_stranke" =>  Auth::user()->sifra_avtohise, "komercialist" =>$komercialist, "stranke" => $stranke ]); 
    }

 	public function search(Request $request)
    {
        $admin = Auth::user()->isAdmin();
        $komercialist = Auth::user()->isKomercialist();

        $id_stranke = Auth::user()->sifra_avtohise;
        $stranke = array();     

        $naziv_avtohise = $request->input('naziv_avtohise');
        if (!isset($naziv_avtohise))
            $naziv_avtohise="TOP1000";

        $pogodbe = null;
        $stranke = array();    

        if ($admin) {            
            $stranke = MovePogodbeController::getStrankeWS("");
            $id_stranke = $request->input('id_stranke');        
        } 
        else 
        {
            $id_stranke = Auth::user()->sifra_avtohise;            
        }
        

        $pogodbe = MovePogodbeController::getPogodbeIDWS($id_stranke);  

        $proste = 0;
        if (isset($pogodbe))
        {

			foreach ($pogodbe as $p) {
        		if (!isset($p->vin)){
        			$proste++;		
        		}
        	}
        }
        	
        return view('move-pogodbe', ["naziv_avtohise" => $naziv_avtohise, "pogodbe" => $pogodbe, "st_prostih" => $proste, "admin" =>$admin, "id_stranke" =>  $id_stranke, "komercialist" =>$komercialist, "stranke" => $stranke  ]);
        
    }


    //
 	public function getPogodbeWS($naziv)
    {
        $client = new Client();
            
        // osvežuj kar vse        
       
            try {
                   $response = $client->get('http://192.168.111.11/api/PogodbeJamstva?naziv='.$naziv);
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

    public function getPogodbeIDWS($id)
    {
        $client = new Client();
                    
        try {
               $response = $client->get('http://192.168.111.11/api/PogodbeJamstva?naziv=999&idStranke='.$id);
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

    public function getStrankeWS($naziv)
    {
        $client = new Client();
            
        try {
               $response = $client->get('http://192.168.111.11/api/MoveStrankeIskalnik?naziv='.$naziv);
        }
        catch (RequestException $e) {
                $response = $e->getResponse();
        }
                        
        if ($response->getStatusCode() == 200) {
            $stranke = $response->getBody()->getContents();
            return json_decode($stranke);
        }            
        
    }
}
