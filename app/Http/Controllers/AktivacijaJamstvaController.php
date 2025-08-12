<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\KarticaVozila;
use App\ZnamkaVozila;
use App\JamstvoTip;
use App\Prodajalec;
use App\PogodbaStevec;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception;

class AktivacijaJamstvaController extends Controller
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
    public function index($all = false)
    {
        $max_rows = 50;
        if ($all) {
            $max_rows = 1000;
        }    

        ini_set('max_execution_time', '300');

        if (Auth::user()->isAdmin())  
        {
            $aktivacije = KarticaVozila::all()->sortByDesc("id")->take($max_rows);    
        }
        elseif (Auth::user()->isSuperUser()){
$aktivacije = KarticaVozila::where('userid', Auth::user()->id)->get()->sortByDesc("id")->take($max_rows);
        }
        else    
        {
            $aktivacije = KarticaVozila::where('sifra_avtohise', Auth::user()->sifra_avtohise)->get()->sortByDesc("id")->take($max_rows);
        }

        return view('aktivacija', [ "aktivacije" => $aktivacije ]);
    }

    public function show(KarticaVozila $kartica)
    {
        return $kartica;    
        return view('aktivacija-uredi', [ "aktivacija" => $kartica]);
    }

    public function create(Request $request)
    {         

        
        $admin = Auth::user()->isAdmin();
        $sifraAvtohise = Auth::user()->sifra_avtohise;    
        $znamkeVozil = ZnamkaVozila::orderBy('opis', 'ASC')->get();
        $prodajalec = Prodajalec::where('koda', $sifraAvtohise)->first();
        $prodajalci = Prodajalec::orderBy('naziv', 'ASC')->get();

        //if ($admin) {
            $tipiJamstev = JamstvoTip::where('koda', 'not like', "%PK%")->orderBy('naziv', 'ASC')->get();
        /*}else {

            $tipiJamstev = JamstvoTip::where('koda', 'not like', "%PK%")->where('naziv', 'not like', "%CARE%")->orderBy('naziv', 'ASC')->get(); 


        }*/

        $oznakaPredlog = AktivacijaJamstvaController::getOznaka(); 
        $oznake = AktivacijaJamstvaController::getPredzakupljeneWS($sifraAvtohise);

        //$oznake = array();
        array_unshift($oznake, $oznakaPredlog);
         

        return view('aktivacija-dodaj', ['prodajalec' => $prodajalec, 'zv' => $znamkeVozil, 'prodajalci' => $prodajalci, 
                                            'tipiJamstev'=>$tipiJamstev, 'jeAdmin' => Auth::user()->isAdmin(),
                                            'oznake' => $oznake, 'oznakaPredlog' => $oznakaPredlog, 'k' => new KarticaVozila,
                                            'urejanje'=>false, 'dodatek_menj'=>true]);
        
        
    }

    public function edit($id)
    {         
        $admin = Auth::user()->isAdmin();
        $sifraAvtohise = Auth::user()->sifra_avtohise;    
        $znamkeVozil = ZnamkaVozila::orderBy('opis', 'ASC')->get();
        $prodajalec = Prodajalec::where('koda', $sifraAvtohise)->first();
        
        $prodajalci = Prodajalec::orderBy('naziv', 'ASC')->get();


        //$tipiJamstev = JamstvoTip::where('koda', 'not like', "%PK%")->where('naziv', 'not like', "%CARE%")->orderBy('naziv', 'ASC')->get(); 
        //if ($admin) {
            $tipiJamstev = JamstvoTip::where('koda', 'not like', "%PK%")->orderBy('naziv', 'ASC')->get();
        /*}else {

            $tipiJamstev = JamstvoTip::where('koda', 'not like', "%PK%")->where('naziv', 'not like', "%CARE%")->orderBy('naziv', 'ASC')->get(); 


        }*/


        $oznakaPredlog = AktivacijaJamstvaController::getOznaka();
        $oznake = AktivacijaJamstvaController::getPredzakupljeneWS($sifraAvtohise);
        array_unshift($oznake, $oznakaPredlog);
        
        $k = KarticaVozila::findOrFail($id);

        $k->datum_prve_reg =  AktivacijaJamstvaController::convert_date_fmt($k->datum_prve_reg );         
        $k->datum_podpisa =  AktivacijaJamstvaController::convert_date_fmt($k->datum_podpisa );
        $k->datum_predaje =  AktivacijaJamstvaController::convert_date_fmt($k->datum_predaje );
        $k->datum_jamstvo_od =  AktivacijaJamstvaController::convert_date_fmt($k->datum_jamstvo_od );                     

        return view('aktivacija-dodaj', ['prodajalec' => $prodajalec, 'zv' => $znamkeVozil, 'prodajalci' => $prodajalci, 
                                            'tipiJamstev'=>$tipiJamstev, 'jeAdmin' => Auth::user()->isAdmin() || Auth::user()->isSuperUser(),
                                            'oznake' => $oznake, 'oznakaPredlog' => $oznakaPredlog, 'k' => $k,
                                            'urejanje'=>true, 'dodatek_menj'=>true]);
        
        
    }

    public function delete($id)
    {                     
        $k = KarticaVozila::findOrFail($id);
        $k->delete();
        return AktivacijaJamstvaController::index();
    }

 public function show_all()
    {                     
        return AktivacijaJamstvaController::index(true);
    }

    public function createPaket($paket)
    {         
        
 
        $znamkeVozil = ZnamkaVozila::orderBy('opis', 'ASC')->get();
        $sifraAvtohise = Auth::user()->sifra_avtohise;    
 
        $prodajalec = Prodajalec::where('koda', $sifraAvtohise)->first();
        $prodajalci = Prodajalec::orderBy('naziv', 'ASC')->get();

        if ($paket == 'optima-care') {
            $paket = "optima";
            $tipiJamstev = JamstvoTip::where('naziv', 'like', $paket.'%')->where('koda', 'not like', "%PK%")->where('naziv', 'like', "%CARE%")->orderBy('naziv', 'ASC')->get();       

        }
        else {
            $tipiJamstev = JamstvoTip::where('naziv', 'like', $paket.'%')->where('koda', 'not like', "%PK%")->where('naziv', 'not like', "%CARE%")->orderBy('naziv', 'ASC')->get();       
        }    



        
        //  dd($tipiJamstev);

        $oznakaPredlog = AktivacijaJamstvaController::getOznaka();

        $oznake = AktivacijaJamstvaController::getPredzakupljeneWS($sifraAvtohise);
        //$oznake = array();
        array_unshift($oznake, $oznakaPredlog);
        //if (count($oznake) == 0)        
        //{             
        //    $oznake[] = "";$oznaka;  
        //}
         
        //$oznakaPredlog = AktivacijaJamstvaController::getOznaka();
       

        return view('aktivacija-dodaj', ['prodajalec' => $prodajalec, 'zv' => $znamkeVozil, 'prodajalci' => $prodajalci, 
                                            'tipiJamstev'=>$tipiJamstev, 'jeAdmin' => Auth::user()->isAdmin(),
                                            'oznake' => $oznake, 'oznakaPredlog' => $oznakaPredlog,
                                            'k' => new KarticaVozila, 'urejanje'=>false, 'dodatek_menj'=>true]);
        
        
    }

    public function createPaketOznaka(Request $request)
    {         
        
        $opis = $request->input('oznaka_jamstva');

        $oznaka_jamstva = substr($opis, 0, strpos($opis, ' ('));
        $tip_jamstva = substr($opis, strpos($opis, '(')+1, strlen(substr($opis, strpos($opis, '(')+1)) -1);

        

        $znamkeVozil = ZnamkaVozila::orderBy('opis', 'ASC')->get();
        $sifraAvtohise = Auth::user()->sifra_avtohise;    
 
        $prodajalec = Prodajalec::where('koda', $sifraAvtohise)->first();
        $prodajalci = Prodajalec::orderBy('naziv', 'ASC')->get();
        
        
        return view('aktivacija-dodaj-paket', ['prodajalec' => $prodajalec, 'zv' => $znamkeVozil, 'prodajalci' => $prodajalci, 
                                                'jeAdmin' => Auth::user()->isAdmin(),
                                                'oznaka_jamstva' => $oznaka_jamstva,
                                                'tip_jamstva' => $tip_jamstva
                                            ]);
        
        
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

    public function getOznakaWS($tip)
    {
        $client = new Client();
            
        // osvežuj kar vse
        $aktivacije = KarticaVozila::get();
        foreach ($aktivacije as $a) {                
            try {
                   $response = $client->get('http://192.168.111.11/api/OznakaKarticeJamstva?tip='.$tip);
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


    public function getOznaka()
    {
         $stevec = PogodbaStevec::GetStevec();
         return "WEB-".$stevec;
    }

    public function store(Request $request)
    {
    
       

        $validator = Validator::make($request->all(), [
            //'sifra' => 'required',

            'oznaka_jamstva' => 'required',
            'tip_jamstva' => 'required',
            'id_znamke' => 'required',
            'model' => 'required',

            'sifra_avtohise' => 'required',
            'ime_priimek' => 'required',
            'naslov' => 'required',
            'postna_st' => 'required',

            //'registrska_st' => 'required',
            'st_sasije' => 'required|size:17',            
            'ccm' => 'required',           
            'km' => 'required'                      
            
        ]);

        if ($validator->fails()) {
            return redirect('/aktivacija-nova')
                        ->withErrors($validator)
                        ->withInput();
        }

        $k = $request->all();

        $k['datum_prve_reg'] = AktivacijaJamstvaController::convert_date($request->datum_prve_reg);
        $k['datum_rojstva'] = AktivacijaJamstvaController::convert_date($request->datum_rojstva);
        $k['datum_podpisa'] = AktivacijaJamstvaController::convert_date($request->datum_podpisa);
        $k['datum_predaje'] = AktivacijaJamstvaController::convert_date($request->datum_predaje);
        $k['datum_jamstvo_od'] = AktivacijaJamstvaController::convert_date($request->datum_jamstvo_od);
        $k['status'] = 0; // status odprt!

        // defaulti ker umaknjena polja
        $k['pogon'] = '';
        $k['komercialno_vozilo'] = 0;
        $k['kraj_rojstva'] = '';
        $k['datum_rojstva'] = AktivacijaJamstvaController::convert_date("01.01.1900");;
        $k['soglasje_1'] = 0;
        $k['soglasje_2'] = 0;
        $k['soglasje_3'] = 0;


 
        if (!array_key_exists('registrska_st', $k)){
            $k['registrska_st'] = '';
        }
 
        if ($k['registrska_st'] == null){
            $k['registrska_st'] = '';   
        }

        if (!array_key_exists('opomba', $k)){
            $k['opomba'] = '';
        }

        if ($k['opomba'] == null){
            $k['opomba'] = '';   
        }

        if (!array_key_exists('menjalnik', $k)){
            $k['menjalnik'] = 'R';
        }

        if ($k['menjalnik'] == null){
            $k['menjalnik'] = 'R';   
        }

        
        //$k->datum_prve_reg = AktivacijaJamstvaController::convert_date($k->datum_prve_reg);
        //$k->datum_rojstva = AktivacijaJamstvaController::convert_date($k->datum_rojstva);
        //$k->datum_podpisa = AktivacijaJamstvaController::convert_date($k->datum_podpisa);
        //$k->datum_predaje = AktivacijaJamstvaController::convert_date($k->datum_predaje);
        //$k->datum_jamstvo_od = AktivacijaJamstvaController::convert_date($k->datum_jamstvo_od);
        
         //$k->datum_prve_reg = Carbon::parse(str_replace(' ', '', $k->datum_prve_reg))->format('d.m.Y');
         //$k->datum_rojstva = Carbon::parse(str_replace(' ', '', $k->datum_rojstva))->format('d.m.Y');
         //$k->datum_podpisa = Carbon::parse(str_replace(' ', '', $k->datum_podpisa))->format('d.m.Y');
         //$k->datum_predaje = Carbon::parse(str_replace(' ', '', $k->datum_predaje))->format('d.m.Y');
         //$k->datum_jamstvo_od = Carbon::parse(str_replace(' ', '', $k->datum_jamstvo_od))->format('d.m.Y')->format('Y-m-d');
        


        try {
            $kartica = KarticaVozila::create($k);    
        }
        catch (\Illuminate\Database\QueryException $e) {
            $error = "Napaka pri shranjevanju v bazo!";
            if (Auth::user()->isAdmin()){
                $error = $e->getMessage();
            }

            return redirect('/aktivacija-nova')
                        ->withErrors($error)
                        ->withInput();
        }
                  
       
 


        // zasedi števec

        
        if (substr($request->oznaka_jamstva, 0,3) == "WEB")
        {
            $user = PogodbaStevec::create(array('stevec' => substr($request->oznaka_jamstva, 4,10), 
                                                'uporabnik' => $request->userId)
            );             
        }    
        


        /*
        Takojšen prenos v MOVE
        */
         
        /*
        $client = new Client();
            
        // neprenesene aktivacije
        $aktivacije = KarticaVozila::where('status', 0)->get();
        foreach ($aktivacije as $a) {                
            try {
                   $response = $client->post('http://192.168.111.11/api/KarticeVozil', [
                                RequestOptions::JSON => $a
                            ]);
            }
            catch (RequestException $e) {
                    $response = $e->getResponse();
                    //$responseBodyAsString = $response->getBody()->getContents();
            }
                            
            if ($response->getStatusCode() == 200) {
                $a->status = 40;
                $a->save();
            }            
        }

         // osvežuj kar vse
        //$aktivacije = KarticaVozila::get();
        foreach ($aktivacije as $a) {                
            try {
                    $response = $client->get('http://192.168.111.11/api/KarticeVozil/'.$a->id);                   
            }
            catch (RequestException $e) {
                    $response = $e->getResponse();
                    //$responseBodyAsString = $response->getBody()->getContents();
            }
                            
            if ($response->getStatusCode() == 200) {
                $statusNew = $response->getBody()->getContents();
                if ($a->status != $statusNew && $statusNew != -100)
                {
                    $a->status = $statusNew;                
                    $a->save();  

                    MailingController::sendMail($a->id);
                }            
            }            
        }

        // if ($kartica->oznaka_jamstva == "")
        // {
        //     // nima predzakupljene, generira se preko WS
        //     //$oznaka =  AktivacijaJamstvaController::getOznakaWS("-1"); 

        //      // nima predzakupljene, generira se preko števca
        //     $oznaka =  AktivacijaJamstvaController::getOznaka(); 
        //     $kartica->oznaka_jamstva = $oznaka;
        //     $kartica->save();
        // }
        
        */
        return redirect('/aktivacija-jamstva');        
    }

    public function save(Request $request)
    {
    
        $k = $request->all();

        $validator = Validator::make($request->all(), [
            //'sifra' => 'required',
            'tip_jamstva' => 'required',
            'id_znamke' => 'required',
            'model' => 'required',

            'sifra_avtohise' => 'required',
            'ime_priimek' => 'required',
            'naslov' => 'required',
            'postna_st' => 'required',

            //'registrska_st' => 'required',
            'st_sasije' => 'required',            
            'ccm' => 'required',           
            'km' => 'required'                      
            
        ]);

        if ($validator->fails()) {
            return redirect($request->path())
                        ->withErrors($validator)
                        ->withInput();
        }

        $k['datum_prve_reg'] = AktivacijaJamstvaController::convert_date($request->datum_prve_reg);
        $k['datum_rojstva'] = AktivacijaJamstvaController::convert_date($request->datum_rojstva);
        $k['datum_podpisa'] = AktivacijaJamstvaController::convert_date($request->datum_podpisa);
        $k['datum_predaje'] = AktivacijaJamstvaController::convert_date($request->datum_predaje);
        $k['datum_jamstvo_od'] = AktivacijaJamstvaController::convert_date($request->datum_jamstvo_od);
       
        // defaulti ker umaknjena polja
        $k['pogon'] = '';
        $k['komercialno_vozilo'] = 0;
        $k['kraj_rojstva'] = '';
        $k['datum_rojstva'] = AktivacijaJamstvaController::convert_date("01.01.1900");;
        $k['soglasje_1'] = 0;
        $k['soglasje_2'] = 0;
        $k['soglasje_3'] = 0;


        if (!array_key_exists('registrska_st', $k)){
            $k['registrska_st'] = '';
        }
 
        if ($k['registrska_st'] == null){
            $k['registrska_st'] = '';   
        }

        if (!array_key_exists('opomba', $k)){
            $k['opomba'] = '';
        }

        if ($k['opomba'] == null){
            $k['opomba'] = '';   
        }

        if (!array_key_exists('menjalnik', $k)){
            $k['menjalnik'] = 'R';
        }

        if ($k['menjalnik'] == null){
            $k['menjalnik'] = 'R';   
        }


        $kartica = KarticaVozila::find($k['id']);
        $kartica->fill($k);


        $kartica->save();
        
        $request->session()->flash('flash_ok', 'Shranjevanje uspešno!');
      
        return redirect('/aktivacija-jamstva');        
    }

    public function oddaj(Request $request, $id){

        /*
          Prenos v MOVE
        */

         
        $client = new Client();
            
        // neprenesene aktivacije
        $a = KarticaVozila::find($id);

          
        try {
               $response = $client->post('http://192.168.111.11/api/KarticeVozil', [
                            RequestOptions::JSON => $a
                        ]);
        }
        catch (RequestException $e) {
                $response = $e->getResponse();
                //$responseBodyAsString = $response->getBody()->getContents();
        }
                        
        if ($response->getStatusCode() == 200) {
            $a->status = 40;
            $a->save();
        }            
         
        /* 
         // osvežuj kar vse
        //$aktivacije = KarticaVozila::get();
                  
        try {
                $response = $client->get('http://192.168.111.11/api/KarticeVozil/'.$a->id);                   
        }
        catch (RequestException $e) {
                $response = $e->getResponse();
                //$responseBodyAsString = $response->getBody()->getContents();
        }
        
                    
        if ($response->getStatusCode() == 200) {
            $statusNew = $response->getBody()->getContents();
            if ($a->status != $statusNew && $statusNew != -100)
            {
                $a->status = $statusNew;                
                $a->save();  

                

               
            }                
        }            
        */
        $element = "flash_ok";
        $msg = "Oddaja uspešna!";

        // osvežuj kar vse
        
              
        try {                   
               $response = $client->get('http://192.168.111.11/api/JamstvoStatus/'.$a->id);
        }
        catch (RequestException $e) {
                $response = $e->getResponse();
        }



        $zavrnitev = false;                   
        if ($response->getStatusCode() == 200) {

            $statusNew = json_decode($response->getBody()->getContents());

            
            if ($a->status != $statusNew->id && $statusNew->id != -100)
            {
                $a->status = $statusNew->id;
                $a->status_msg = $statusNew->opis;                
                $a->save();    

                if ($statusNew->id == 18){
                    $zavrnitev = true;
                    $msg = $statusNew->opis;
                }
                
              
            }            
        }            
        

        // if ($kartica->oznaka_jamstva == "")
        // {
        //     // nima predzakupljene, generira se preko WS
        //     //$oznaka =  AktivacijaJamstvaController::getOznakaWS("-1"); 
 
        //      // nima predzakupljene, generira se preko števca
        //     $oznaka =  AktivacijaJamstvaController::getOznaka(); 
        //     $kartica->oznaka_jamstva = $oznaka;
        //     $kartica->save();
        // }
              

        if ($zavrnitev)
        {         
            $element = "flash_error";          
        }

        $request->session()->flash($element, $msg);
        
        MailingController::sendMail($a->id);
        return redirect('/aktivacija-jamstva');  
    }

    

    public function convert_date($date){
        return Carbon::parse(str_replace(' ', '', $date))->format('Y-m-d');    
    }

    public function convert_date_fmt($date){
        $carbon = new Carbon($date);
        return $carbon->format('d.m.Y');
    }
}
