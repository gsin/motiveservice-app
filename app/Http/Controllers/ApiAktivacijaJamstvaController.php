<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\KarticaVozila;
use App\ZnamkaVozila;
use App\JamstvoTip;
use App\Prodajalec;
use App\PogodbaStevec;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception;

class ApiAktivacijaJamstvaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getJamstva(Request $request)
    {                 
        $r = $request->json()->all();    
        try
        {
            $u = ApiAktivacijaJamstvaController::validateToken($r['token']);    
            if ($u == null) {
            $ret = array('result' => false,  'message' => 'Napaka pri avtorizaciji', 'data' => '');
            return json_encode($ret);
            }               
        } catch(\Exception $ex){ 
          $ret = array('result' => false,  'message' => $ex->getMessage(), 'data' => '');
            return json_encode($ret);            
        }

            
        $km = $r['km'];
        $ccm = $r['ccm'];
        $starost = $r['starost'];
        $id_stranke = $r['id_stranke'];

        try
        {
            $paketi = ApiAktivacijaJamstvaController::getJamstvaVoziloWS($km, $ccm, $starost, $id_stranke);
        } catch(\Exception $ex){ 
          $ret = array('result' => false,  'message' => $ex->getMessage(), 'data' => '');
            return json_encode($ret);            
        }         

        /*
        $tipiJamstev = JamstvoTip::where('prevozeni_km', '>=', $km)        
                                    ->where('prostornina_motorja_od', '<', $ccm)
                                    ->where('prostornina_motorja_do', '>=', $ccm)
                                    ->where('starost_vozila', '>=', $starost)
                                    ->where('koda', 'not like', "%PK%")        
                                    ->orderBy('naziv', 'ASC')->get();     
        
        $tipiJamstevOptima = JamstvoTip::where('prostornina_motorja_od', '<', $ccm)
                                        ->where('prostornina_motorja_do', '>=', $ccm)
                                        ->where('koda', 'like', "OPTIMA%")
                                        ->orderBy('naziv', 'ASC')->get();

        $tipiJamstev = $tipiJamstev->merge($tipiJamstevOptima);
        */

        //dd($paketi);

        //rename za API
        $data = array_map(function($arr) {
                $arr = get_object_vars($arr);
                return array(
                            'id' => $arr['id_jamstva'],
                            'naziv' => $arr['naziv_jamstva'],
                            'veljavnost_mesecev' => $arr['veljavnost_jamstva'],
                            'cena' => $arr['znesek']
            );
        }, $paketi);

        $ret = array('result' => true,  'message' => '', 'data' => $data);

        return json_encode($ret);
    }    


    public function store(Request $request)
    {
        $r = $request->json()->all();    
        try
        {
            $u = ApiAktivacijaJamstvaController::validateToken($r['token']);    
            if ($u == null) {
            $ret = array('result' => false,  'message' => 'Napaka pri avtorizaciji', 'data' => '');
            return json_encode($ret);
            }               
        } catch(\Exception $ex){ 
          $ret = array('result' => false,  'message' => $ex->getMessage(), 'data' => '');
            return json_encode($ret);            
        }
        

        $validator = Validator::make($request->all(), [
            //'sifra' => 'required',
            'tip_jamstva' => 'required',
            //'oznaka_jamstva' => 'required',

            'id_znamke' => 'required',
            'model' => 'required',

            //'sifra_avtohise' => 'required',
            'ime_priimek' => 'required',
            'naslov' => 'required',
            'postna_st' => 'required',

            //'registrska_st' => 'required',
            'st_sasije' => 'required',            
            'ccm' => 'required',           
            'km' => 'required'                      
            
        ]);
        $data = "";        

        if ($validator->fails()) {            
            $errors = $validator->errors();            
            $ret = array('result' => false,  'message' => $errors->first(), 'data' => $data);
            return json_encode($ret);        
        }


        // oznaka iz števca če ni določena    
        if (!array_key_exists('oznaka_jamstva', $r)){
            $r['oznaka_jamstva'] = ApiAktivacijaJamstvaController::getOznaka();
        }

        if (strlen($r['oznaka_jamstva']) > 10) {
            $ret = array('result' => false,  'message' => 'Oznaka jamstva presega 10 znakov!', 'data' => $data);
            return json_encode($ret);            
        }

        $ref = KarticaVozila::Where('oznaka_jamstva', $r['oznaka_jamstva'])->first();    
        if ($ref != null) {
            $ret = array('result' => false,  'message' => 'Oznaka '.$r['oznaka_jamstva'].' ze obstaja!', 'data' => $data);
            return json_encode($ret);        
        }
        
        // smo čez validacijo    
        $k = $r;        
        
        $k['status'] = 0; // status odprt!

        // 
        $k['userId'] = $u->id;
        
        if (array_key_exists('sifra_avtohise', $k)){
            if ($k['sifra_avtohise'] == null){            
                $k['sifra_avtohise'] = $u->sifra_avtohise;
            }
        }
        else {
            $k['sifra_avtohise'] = $u->sifra_avtohise;
        }

        // defaulti ker umaknjena polja
        $k['pogon'] = '';
        $k['komercialno_vozilo'] = 0;
        $k['kraj_rojstva'] = '';
        $k['datum_rojstva'] = "1900-01-01";
        $k['soglasje_1'] = 0;
        $k['soglasje_2'] = 0;
        $k['soglasje_3'] = 0;

        if (!array_key_exists('registrska_st', $k)){
            $k['registrska_st'] = '';
        }
 
        if (!array_key_exists('opomba', $k)){
            $k['opomba'] = '';
        }
    
        try {        
            $kartica = KarticaVozila::create($k);    
            
        } catch(\Illuminate\Database\QueryException $ex){ 
          $ret = array('result' => false,  'message' => $ex->getMessage(), 'data' => $data);
            return json_encode($ret);        
          
        }
        
        $ret = array('result' => true,  'message' => '', 'data' => $kartica->oznaka_jamstva);

        return json_encode($ret);        
    }


    public function storeActivate(Request $request)
    {
                
        $r = $request->json()->all();            

        try
        {
            $u = ApiAktivacijaJamstvaController::validateToken($r['token']);    
            if ($u == null) {
            $ret = array('result' => false,  'message' => 'Napaka pri avtorizaciji', 'data' => '');
            return json_encode($ret);
            }               
        } catch(\Exception $ex){ 
          $ret = array('result' => false,  'message' => $ex->getMessage(), 'data' => '');
            return json_encode($ret);            
        }
                
        $validator = Validator::make($r, [
            //'sifra' => 'required',
            'tip_jamstva' => 'required',
            //'oznaka_jamstva' => 'required',

            'id_znamke' => 'required',
            'model' => 'required',

            //'sifra_avtohise' => 'required',
            'ime_priimek' => 'required',
            'naslov' => 'required',
            'postna_st' => 'required',

            //'registrska_st' => 'required',
            'st_sasije' => 'required',            
            'ccm' => 'required',           
            'km' => 'required'                      
            
        ]);
        $data = "";        

        if ($validator->fails()) {            
            $errors = $validator->errors();            
            $ret = array('result' => false,  'message' => $errors->first(), 'data' => $data);
            return json_encode($ret);        
        }


         // oznaka iz števca če ni določena    
        if (!array_key_exists('oznaka_jamstva', $r)){
            $r['oznaka_jamstva'] = ApiAktivacijaJamstvaController::getOznaka();
        }

        $ref = KarticaVozila::Where('oznaka_jamstva', $r['oznaka_jamstva'])->first();    
        if ($ref != null) {
            $ret = array('result' => false,  'message' => 'Oznaka '.$r['oznaka_jamstva'].' ze obstaja!', 'data' => $data);
            return json_encode($ret);        

        }

        if (strlen($r['oznaka_jamstva']) > 10) {
            $ret = array('result' => false,  'message' => 'Oznaka jamstva presega 10 znakov!', 'data' => $data);
            return json_encode($ret);            
        }


        $k = $r;        
        $k['status'] = 0; // status odprt!

        // 
        $k['userId'] = $u->id;
        
        if (array_key_exists('sifra_avtohise', $k)){
            if ($k['sifra_avtohise'] == null){            
                $k['sifra_avtohise'] = $u->sifra_avtohise;
            }
        }
        else {
            $k['sifra_avtohise'] = $u->sifra_avtohise;
        }

        // defaulti ker umaknjena polja
        $k['pogon'] = '';
        $k['komercialno_vozilo'] = 0;
        $k['kraj_rojstva'] = '';
        $k['datum_rojstva'] = "1900-01-01";
        $k['soglasje_1'] = 0;
        $k['soglasje_2'] = 0;
        $k['soglasje_3'] = 0;

        if (!array_key_exists('registrska_st', $k)){
            $k['registrska_st'] = '';
        }
 
        if (!array_key_exists('opomba', $k)){
            $k['opomba'] = '';
        }

        try {        
            $kartica = KarticaVozila::create($k);    
            
        } catch(\Illuminate\Database\QueryException $ex){ 
          $ret = array('result' => false,  'message' => $ex->getMessage(), 'data' => $data);
            return json_encode($ret);                  
        }

        try {        
            $ret = ApiAktivacijaJamstvaController::oddaj($kartica->id);
            
        } catch(\Exception $ex){ 
          $ret = array('result' => false,  'message' => $ex->getMessage(), 'data' => $data);
            return json_encode($ret);        
          
        }

        $karticaNew = KarticaVozila::find($kartica->id);

        $result = true;    
        
      

        $status = $karticaNew->status_akt->naziv; 
        $message = $karticaNew->status_msg;

        $ret = array('result' => $result,  'message' => $message, 'data' => $kartica->oznaka_jamstva, 'status_aktivacije'=> $status);

        return json_encode($ret);
    }

    public function getOznaka()
    {
         $stevec = PogodbaStevec::GetStevec();
         return "WEB-".$stevec;
    }

    public function oddaj($id){

        /*
          Prenos v MOVE
        */

        $kartica = KarticaVozila::find($id);
        $client = new Client();
            
                
        try {
               $response = $client->post('http://192.168.111.11/api/KarticeVozil', [
                            RequestOptions::JSON => $kartica
                        ]);
        }
        catch (RequestException $e) {
                $response = $e->getResponse();
                //$responseBodyAsString = $response->getBody()->getContents();
        }
        
        //   v čakanju
        $status = 40;                
        if ($response->getStatusCode() == 200) {
            $kartica->status = $status ;
            $kartica->save();
        }            
                         
        // osvežuj kar vse                    
        try {                   
               $response = $client->get('http://192.168.111.11/api/JamstvoStatus/'.$kartica->id);
        }
        catch (RequestException $e) {
                $response = $e->getResponse();
        }


        $msg = '';
        $zavrnitev = false;                   
        if ($response->getStatusCode() == 200) {

            $statusNew = json_decode($response->getBody()->getContents());

            
            if ($kartica->status != $statusNew->id && $statusNew->id != -100)
            {
                $kartica->status = $statusNew->id;
                $kartica->status_msg = $statusNew->opis;                
                $kartica->save();    

                if ($statusNew->id == 18){
                    $zavrnitev = true;
                    
                }
                $status = $statusNew->id;
                $msg = $statusNew->opis;
                             
            }   
                     
        }            
        $result = true;            
        if ($zavrnitev)
        {         
            $result = false;

        }
        
        try {  
            MailingController::sendMail($kartica->id);
        }
        catch (\Exception $e) {
            //
        }

        $ret = array('result' => $result,  'message' => $msg, 'data' => $status);
        
            
    }

    public function validateToken($token){
        // obstaja uporabnik s tem tokenom?
        $u = User::Where('api_token', $token)->first();    
        if ($u == null)
        {
            return null;
        }
        return $u;
    }


    public function getJamstvaVoziloWS ($km, $ccm, $starost, $id_stranke){
        $client = new Client();
                        
        try {
               $response = $client->get('http://192.168.111.11/api/PaketiVozilo?km='.$km.'&ccm='.$ccm.'&starost='.$starost.'&id_stranke='.$id_stranke);
        }
        catch (RequestException $e) {
                $response = $e->getResponse();                
        }
                        
        if ($response->getStatusCode() == 200) {
            $paketi = $response->getBody()->getContents();
            return json_decode($paketi);
        }            
        
    }

    public function getJamstvoPDF(Request $request)  {


        $r = $request->json()->all();    
        try
        {
            $u = ApiAktivacijaJamstvaController::validateToken($r['token']);    
            if ($u == null) {
            $ret = array('result' => false,  'message' => 'Napaka pri avtorizaciji', 'data' => '');
            return json_encode($ret);
            }                            

            //$id = $r['id'];
            $oznaka_jamstva = $r['oznaka_jamstva'];

            //$k = KarticaVozila::find($id);    
            $k = KarticaVozila::where('oznaka_jamstva', $oznaka_jamstva)->firstOrFail();

            $id = $k->id;            
              
            $filename = $k->oznaka_jamstva. ".pdf";
            $pdf = ApiAktivacijaJamstvaController::getPogodbaPDF($id);            

               

            $ret = array('result' => true,  'message' => $filename, 'data' => base64_encode($pdf));
            
        } catch(\Exception $ex){ 
          $ret = array('result' => false,  'message' => $ex->getMessage(), 'data' => '');
            return json_encode($ret);            
        }

         return json_encode($ret);            
        
        

    }

    public function getPogodbaPDF($id)
    {
        $client = new Client();
         
       
            try {
                   $response = $client->get("http://192.168.111.11/api/PDFObrazci/".$id);
            }
            catch (RequestException $e) {
                    $response = $e->getResponse();
                    //$responseBodyAsString = $response->getBody()->getContents();
            }
                            
            if ($response->getStatusCode() == 200) {
                
               return  $response->getBody()->getContents();
                
            }            
        
    }
}
