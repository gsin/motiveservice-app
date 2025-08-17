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
            $aktivacije = KarticaVozila::all()->sortByDesc('id')->take($max_rows);    
        }
        elseif (Auth::user()->isSuperUser()){
$aktivacije = KarticaVozila::where('userid', Auth::user()->id)->get()->sortByDesc('id')->take($max_rows);
        }
        else    
        {
            $aktivacije = KarticaVozila::where('sifra_avtohise', Auth::user()->sifra_avtohise)->get()->sortByDesc('id')->take($max_rows);
        }

        return view('aktivacija', [ 'aktivacije' => $aktivacije ]);
    }

    public function show(KarticaVozila $kartica)
    {
        return $kartica;    
        return view('aktivacija-uredi', [ 'aktivacija' => $kartica]);
    }

    public function create(Request $request)
    {         

        
        $admin = Auth::user()->isAdmin();
        $sifraAvtohise = Auth::user()->sifra_avtohise;    
        $znamkeVozil = ZnamkaVozila::orderBy('opis', 'ASC')->get();
        $prodajalec = Prodajalec::where('koda', $sifraAvtohise)->first();
        $prodajalci = Prodajalec::orderBy('naziv', 'ASC')->get();
        $userId = Auth::user()->id; 
 
        $view_name = 'aktivacija-dodaj';
        if ($userId == 1 || $userId == 5 || $userId == 18 ) {
            $tipiJamstev = JamstvoTip::where('koda', 'not like', "%PK%")->where('naziv', 'not like', "%SUPREMA%")->orderBy('naziv', 'ASC')->get(); 
            $view_name = 'aktivacija-dodaj-new';
        }
        else {
            $tipiJamstev = JamstvoTip::where('koda', 'not like', "%PK%")->orderBy('naziv', 'ASC')->get();
        }




        $oznakaPredlog = AktivacijaJamstvaController::getOznaka(); 
        $oznake = AktivacijaJamstvaController::getPredzakupljeneWS($sifraAvtohise);

        //$oznake = array();
        array_unshift($oznake, $oznakaPredlog);
         

        return view($view_name, ['prodajalec' => $prodajalec, 'zv' => $znamkeVozil, 'prodajalci' => $prodajalci, 
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
        $userId = Auth::user()->id; 

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


        $view_name = 'aktivacija-dodaj';
        if ($userId == 1 || $userId == 5 || $userId == 18 ) {
            $tipiJamstev = JamstvoTip::where('koda', 'not like', "%PK%")->where('naziv', 'not like', "%SUPREMA%")->orderBy('naziv', 'ASC')->get(); 
            $view_name = 'aktivacija-dodaj-new';
        }


        return view($view_name, ['prodajalec' => $prodajalec, 'zv' => $znamkeVozil, 'prodajalci' => $prodajalci, 
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
            $paket = 'optima';
            $tipiJamstev = JamstvoTip::where('naziv', 'like', $paket.'%')->where('koda', 'not like', "%PK%")->where('naziv', 'like', "%CARE%")->orderBy('naziv', 'ASC')->get();       

        }
        else {
            $tipiJamstev = JamstvoTip::where('naziv', 'like', $paket.'%')->where('koda', 'not like', "%PK%")->where('naziv', 'not like', "%CARE%")->orderBy('naziv', 'ASC')->get();       
        }    

 
        $oznakaPredlog = AktivacijaJamstvaController::getOznaka();

        $oznake = AktivacijaJamstvaController::getPredzakupljeneWS($sifraAvtohise);
 
        array_unshift($oznake, $oznakaPredlog);
 

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
         return 'WEB-'.$stevec;
    }

    /**
     * Validate warranty conditions for vehicle age, activation date, kilometers, and KW
     * 
     * @param Request $request
     * @return array Array of validation errors
     */
    private function validateWarrantyConditions(Request $request)
    {
        $errors = [];
        
        $tipJamstva = JamstvoTip::where('koda', $request->tip_jamstva)->first();
        if ($tipJamstva) {
            $datumPrveReg = Carbon::parse($request->datum_prve_reg);
            $danes = Carbon::now();
            $starostVozila = $danes->diffInYears($datumPrveReg);
            $nazivKratko = explode(' ', $tipJamstva->naziv)[0];

            if ($starostVozila > $tipJamstva->starost_vozila) {        
                $errors['datum_prve_reg'] = 'Vozilo presega maksimalno starost za tip jamstva ' . $nazivKratko . ' (' . $tipJamstva->starost_vozila . ' let)';
            }

            $maxKm = $tipJamstva->prevozeni_km;
            $dodatekKm = $request->input('dodatek_km', 0);
            
            if ($dodatekKm == 1) {
                $maxKm += 25000;
            }
            
            if ($request->km > $maxKm) {
                if ($dodatekKm == 0) {
                    $errors['km'] = 'Vozilo presega maksimalno število prevoženih kilometrov za ta tip storitve upravljanega jamstva (' . number_format($tipJamstva->prevozeni_km, 0, ',', '.') . ' km)';
                    // Store km modal data in session for the view to access
                    session(['km_modal_data' => [
                        'message' => 'Vozilo presega maksimalno število prevoženih kilometrov za ta tip storitve upravljanega jamstva (' . number_format($tipJamstva->prevozeni_km, 0, ',', '.') . ' km)',
                        'max_km' => $tipJamstva->prevozeni_km,
                        'current_km' => $request->km,
                        'tip_jamstva' => $tipJamstva->naziv
                    ]]);
                } else {
                    $errors['km'] = 'Vozilo presega maksimalno kilometrino za tip jamstva ' . $nazivKratko . ' (osnova ' . $tipJamstva->prevozeni_km . ' km + 25.000 km = ' . $maxKm . ' km)';
                }
            }
        }

        $datumAktivacije = Carbon::parse($request->datum_jamstvo_od);
        $danes = Carbon::now();
        $razlikaDni = abs($danes->diffInDays($datumAktivacije, false));
        
        if ($razlikaDni > 10) {
            $errors['datum_jamstvo_od'] = 'Vozilo presega maksimalen čas za aktivacijo od podpisa pogodbe (10 dni)';
        }

        if ($request->moc_motorja > 210) {
            $errors['moc_motorja'] = 'Vozilo ima več kot maksimalno vrednost 210 KW. Vsak nadaljnji KW bo dodatno zaračunan. Možnost sklenitve le do 320 KW, za več informacij se lahko obrnete na vašega skrbnika.';  
        }

        // Check if automatic transmission is selected but add-on is not enabled
        if ($request->menjalnik === 'A' && $request->input('dodatek_avt_menj', 0) == 0) {
           
            // Store automatic transmission modal data in session for the view to access
            session(['avt_menj_modal_data' => [
                'message' => 'Vaše vozilo ima avtomatski menjalnik, vendar niste vključili dodatka avtomatski menjalnik. Ga želite vključiti?',
                'menjalnik' => $request->menjalnik,
                'tip_jamstva' => $tipJamstva ? $tipJamstva->naziv : 'N/A'
            ]]);
        }

        return $errors;
    }

    public function store(Request $request)
    {
        // Check if this is a request to clear the km modal
        if ($request->has('clear_km_modal')) {
            $request->session()->forget('km_modal_data');
            return redirect()->back()->withInput();
        }
        
        // Check if this is a request to clear the automatic transmission modal
        if ($request->has('clear_avt_menj_modal')) {
            $request->session()->forget('avt_menj_modal_data');
            return redirect()->back()->withInput();
        }
        
        // Check if override is requested
        if ($request->has('override') && $request->override === 'true') {
            return $this->storeWithOverride($request);
        }

        // shranjevanje po dodajanju nove aktivacije
       

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
            return redirect($request->path())
                        ->withErrors($validator)
                        ->withInput();
        }
      
        $userId = Auth::user()->id; 
        if ($userId == 1 || $userId == 5 || $userId == 18 ) {
            $errors = $this->validateWarrantyConditions($request);
            if (count($errors) > 0) {
                return redirect($request->path())
                        ->withErrors($errors)
                        ->withInput();
            }
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
       // $k['komercialno_vozilo'] = 0;
        $k['kraj_rojstva'] = '';
        $k['datum_rojstva'] = AktivacijaJamstvaController::convert_date('01.01.1900');;
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

        try {
            $kartica = KarticaVozila::create($k);    
        }
        catch (\Illuminate\Database\QueryException $e) {
            $error = 'Napaka pri shranjevanju v bazo!';
            if (Auth::user()->isAdmin()){
                $error = $e->getMessage();
            }

            return redirect($request->path())
                        ->withErrors($error)
                        ->withInput();
        }
                  

        // zasedi števec
        if (substr($request->oznaka_jamstva, 0,3) == 'WEB')
        {
            $user = PogodbaStevec::create(array('stevec' => substr($request->oznaka_jamstva, 4,10), 
                                                'uporabnik' => $request->userId)
            );             
        }    
        
        return redirect('/aktivacija-jamstva');        
    }

    public function save(Request $request)
    {
        // Check if this is a request to clear the km modal
        if ($request->has('clear_km_modal')) {
            $request->session()->forget('km_modal_data');
            return redirect()->back()->withInput();
        }
        
        // Check if this is a request to clear the automatic transmission modal
        if ($request->has('clear_avt_menj_modal')) {
            $request->session()->forget('avt_menj_modal_data');
            return redirect()->back()->withInput();
        }
        
        // Check if override is requested
        if ($request->has('override') && $request->override === 'true') {
            return $this->saveWithOverride($request);
        }

        // shranjevanje po urejanju
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
            'st_sasije' => 'required|size:17',
            'ccm' => 'required',           
            'km' => 'required'                      
            
        ]);

        if ($validator->fails()) {
            return redirect($request->path())
                        ->withErrors($validator)
                        ->withInput();
        }

        $userId = Auth::user()->id; 
        if ($userId == 1 || $userId == 5 || $userId == 18 ) {

            $errors = $this->validateWarrantyConditions($request);

            if (count($errors) > 0) {
                return redirect($request->path())
                ->withErrors($errors)
                ->withInput();
            }
        }

        $k['datum_prve_reg'] = AktivacijaJamstvaController::convert_date($request->datum_prve_reg);
        $k['datum_rojstva'] = AktivacijaJamstvaController::convert_date($request->datum_rojstva);
        $k['datum_podpisa'] = AktivacijaJamstvaController::convert_date($request->datum_podpisa);
        $k['datum_predaje'] = AktivacijaJamstvaController::convert_date($request->datum_predaje);
        $k['datum_jamstvo_od'] = AktivacijaJamstvaController::convert_date($request->datum_jamstvo_od);
       
        // defaulti ker umaknjena polja
        $k['pogon'] = '';
        //$k['komercialno_vozilo'] = 0;
        $k['kraj_rojstva'] = '';
        $k['datum_rojstva'] = AktivacijaJamstvaController::convert_date('01.01.1900');;
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
         
        
        $element = 'flash_ok';
        $msg = 'Oddaja uspešna!';

        // osveži status
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
        
 

        if ($zavrnitev)
        {         
            $element = 'flash_error';          
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

    /**
     * Show confirmation page for overriding validation errors
     */
    public function confirmOverride(Request $request)
    {
        $errors = $request->session()->get('validation_errors', []);
        $requestData = $request->session()->get('request_data', []);
        
        // Debug logging
        \Log::info('confirmOverride called', [
            'errors_count' => count($errors),
            'request_data_count' => count($requestData),
            'session_id' => $request->session()->getId()
        ]);
        
        if (empty($errors) || empty($requestData)) {
            // If no data in session, redirect back to create form
            return redirect()->route('aktivacija.create')
                ->withErrors(['general' => 'Ni podatkov za potrditev. Prosimo, poskusite ponovno.']);
        }
        
        return view('aktivacija-confirm-override', [
            'errors' => $errors,
            'requestData' => $requestData
        ]);
    }

    /**
     * Save warranty after user confirms override of validation errors
     */
    public function overrideSave(Request $request)
    {
        // Validate the override confirmation
        $validator = Validator::make($request->all(), [
            'override_reason' => 'required|min:10',
            'confirm_override' => 'required|accepted'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get the original request data from session
        $requestData = $request->session()->get('request_data', []);
        if (empty($requestData)) {
            return redirect()->route('aktivacija.create')
                ->withErrors(['general' => 'Ni podatkov za shranjevanje. Prosimo, poskusite ponovno.']);
        }

        // Create a new request with the original data
        $originalRequest = new Request($requestData);
        
        // Add override information
        $originalRequest->merge([
            'override_reason' => $request->override_reason,
            'override_user_id' => Auth::user()->id,
            'override_timestamp' => now()
        ]);

        // Call the appropriate save method based on whether it's a new record or edit
        if (isset($requestData['id'])) {
            // Editing existing record
            $result = $this->saveWithOverride($originalRequest);
        } else {
            // Creating new record
            $result = $this->storeWithOverride($originalRequest);
        }

        // Clear the session data after successful save
        $request->session()->forget(['validation_errors', 'request_data']);
        
        return $result;
    }

    /**
     * Store new warranty with override information
     */
    public function storeWithOverride(Request $request)
    {
        $k = $request->all();

        $k['datum_prve_reg'] = AktivacijaJamstvaController::convert_date($request->datum_prve_reg);
        $k['datum_rojstva'] = AktivacijaJamstvaController::convert_date($request->datum_rojstva);
        $k['datum_podpisa'] = AktivacijaJamstvaController::convert_date($request->datum_podpisa);
        $k['datum_predaje'] = AktivacijaJamstvaController::convert_date($request->datum_predaje);
        $k['datum_jamstvo_od'] = AktivacijaJamstvaController::convert_date($request->datum_jamstvo_od);
        $k['status'] = 0; // status odprt!

        // defaulti ker umaknjena polja
        $k['pogon'] = '';
        $k['kraj_rojstva'] = '';
        $k['datum_rojstva'] = AktivacijaJamstvaController::convert_date('01.01.1900');
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

        try {
            $kartica = KarticaVozila::create($k);    
        }
        catch (\Illuminate\Database\QueryException $e) {
            $error = 'Napaka pri shranjevanju v bazo!';
            if (Auth::user()->isAdmin()){
                $error = $e->getMessage();
            }

            return redirect()->route('aktivacija.create')
                        ->withErrors($error)
                        ->withInput();
        }
                  
        // zasedi števec
        if (substr($request->oznaka_jamstva, 0,3) == 'WEB')
        {
            $user = PogodbaStevec::create(array('stevec' => substr($request->oznaka_jamstva, 4,10), 
                                                'uporabnik' => $request->userId)
            );             
        }    
        
        $request->session()->flash('flash_ok', 'Jamstvo shranjeno kljub neustreznim pogojem. Razlog: ' . $request->opomba);
        return redirect('/aktivacija-jamstva');        
    }

    /**
     * Save existing warranty with override information
     */
    public function saveWithOverride(Request $request)
    {
        $k = $request->all();

        $k['datum_prve_reg'] = AktivacijaJamstvaController::convert_date($request->datum_prve_reg);
        $k['datum_rojstva'] = AktivacijaJamstvaController::convert_date($request->datum_rojstva);
        $k['datum_podpisa'] = AktivacijaJamstvaController::convert_date($request->datum_podpisa);
        $k['datum_predaje'] = AktivacijaJamstvaController::convert_date($request->datum_predaje);
        $k['datum_jamstvo_od'] = AktivacijaJamstvaController::convert_date($request->datum_jamstvo_od);
       
        $k['pogon'] = '';
        $k['kraj_rojstva'] = '';
        $k['datum_rojstva'] = AktivacijaJamstvaController::convert_date('01.01.1900');
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
        
        $request->session()->flash('flash_ok', 'Jamstvo posodobljeno kljub neustreznim pogojem. Razlog: ' . $request->opomba);
        return redirect('/aktivacija-jamstva');        
    }
}
