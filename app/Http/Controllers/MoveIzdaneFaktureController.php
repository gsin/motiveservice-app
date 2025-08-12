<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception;
use App\Prodajalec;
use Auth;   

class MoveIzdaneFaktureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
 	public function index()
    {
        $naziv_avtohise = "";
        $admin = Auth::user()->isAdmin();
        if ($admin)  
        {             
             $title = "Izdane fakture MOVE";             
        }
        else
        {
            $title = "Odprti računi";
            $naziv_avtohise = (Prodajalec::where('koda', Auth::user()->sifra_avtohise)->first())->naziv;
        }

        $stranke = null;
        return view('move-izdane-fakture', ["naziv_avtohise" => $naziv_avtohise, "leto" => -1, "stranke" => $stranke, "id_stranke" => $naziv_avtohise, "title" => $title, "admin" =>$admin]);
    }

 	public function search(Request $request)
    {
        $admin = Auth::user()->isAdmin();
        $leto = $request->input('leto');
        $id_stranke = $request->input('id_stranke');
        if (!isset($id_stranke))
            $id_stranke="TOP1000";

        $fakture = null;     
        if ($admin)  {
            $title = "Izdane fakture MOVE";
            //$title = "Odprti računi";
            //$leto = 1;
            //$fakture = MoveIzdaneFaktureController::getIzdaneFaktureLetoWS($id_stranke, $leto);
            $naziv_avtohise = "TOP1000";
            $fakture = MoveIzdaneFaktureController::getIzdaneFaktureWS($id_stranke);
        }else{
            $title = "Odprti računi";
            $leto = 1;
            $id_stranke = Auth::user()->sifra_avtohise;
            $naziv_avtohise = (Prodajalec::where('koda', Auth::user()->sifra_avtohise)->first())->naziv;
            $fakture = MoveIzdaneFaktureController::getIzdaneFaktureLetoWS($id_stranke, $leto);
        }
            
        
        $stranke = Prodajalec::orderBy('naziv', 'ASC')->get();
        $stat_sum = array('sum_znesek' => 0, 'sum_znesek_placan' => 0, 'sum_znesek_odprto' => 0 );
     
         
        foreach ($fakture as $f) {
            $stat_sum['sum_znesek'] += $f->znesek;
            $stat_sum['sum_znesek_placan'] += $f->znesek_placan;
            $stat_sum['sum_znesek_odprto'] += ($f->znesek - $f->znesek_placan);            
        }


        return view('move-izdane-fakture', ["naziv_avtohise" => $naziv_avtohise, "fakture" => $fakture, "leto" => $leto, "stat_sum" => $stat_sum, "stranke" => $stranke, "id_stranke" => $id_stranke, "title" => $title, "admin" =>$admin]);
    }


    //
 	public function getIzdaneFaktureWS($id_stranke)
    {
        $client = new Client();
         
       
        try {

               $response = $client->get('http://192.168.111.11/api/IzdaneFakturePlacnik?idStranke='.$id_stranke);
        }
        catch (RequestException $e) {
                $response = $e->getResponse();
        }
                        
        if ($response->getStatusCode() == 200) {
            $fakture = $response->getBody()->getContents();
            return json_decode($fakture);
        }            
        
    }

    public function getIzdaneFaktureLetoWS($id_stranke, $leto)
    {
        $client = new Client();
                
        try {
               $response = $client->get('http://192.168.111.11/api/IzdaneFakturePlacnik?idStranke='.$id_stranke.'&leto='.$leto);
        }
        catch (RequestException $e) {
                $response = $e->getResponse();
        }
                        
        if ($response->getStatusCode() == 200) {
            $fakture = $response->getBody()->getContents();
            return json_decode($fakture);
        }            
           
    }
}
