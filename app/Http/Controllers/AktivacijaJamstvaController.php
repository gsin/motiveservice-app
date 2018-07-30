<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\KarticaVozila;
use App\ZnamkaVozila;
use App\JamstvoTip;
use App\Prodajalec;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


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
    public function index()
    {
        if (Auth::user()->isAdmin())  
        {
            $aktivacije = KarticaVozila::all()->sortByDesc("id");    
        }
        else
        {
            $aktivacije = KarticaVozila::where('sifra_avtohise', Auth::user()->sifra_avtohise)->get();
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
        $znamkeVozil = ZnamkaVozila::orderBy('opis', 'ASC')->get();
        $prodajalec = Prodajalec::where('koda', Auth::user()->sifra_avtohise)->first();
        $prodajalci = Prodajalec::orderBy('naziv', 'ASC')->get();
        $tipiJamstev = JamstvoTip::orderBy('naziv', 'ASC')->get();        
        return view('aktivacija-dodaj', ['prodajalec' => $prodajalec, 'zv' => $znamkeVozil, 'prodajalci' => $prodajalci, 
                                            'tipiJamstev'=>$tipiJamstev, 'jeAdmin' => Auth::user()->isAdmin()]);
        
        
    }

    public function createPaket($paket)
    {         
        

        $znamkeVozil = ZnamkaVozila::orderBy('opis', 'ASC')->get();
        $prodajalec = Prodajalec::where('koda', Auth::user()->sifra_avtohise)->first();
        $prodajalci = Prodajalec::orderBy('naziv', 'ASC')->get();
        $tipiJamstev = JamstvoTip::where('naziv', 'like', $paket.'%')->orderBy('naziv', 'ASC')->get();        
        return view('aktivacija-dodaj', ['prodajalec' => $prodajalec, 'zv' => $znamkeVozil, 'prodajalci' => $prodajalci, 
                                            'tipiJamstev'=>$tipiJamstev, 'jeAdmin' => Auth::user()->isAdmin()]);
        
        
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'sifra' => 'required',
            'tip_jamstva' => 'required',
            'tip_jamstva' => 'required',            
            'id_znamke' => 'required',
            'model' => 'required',

            'sifra_avtohise' => 'required',
            'ime_priimek' => 'required',
            'naslov' => 'required',
            'postna_st' => 'required',

            'registrska_st' => 'required',
            'st_sasije' => 'required',            
            
        ]);

        if ($validator->fails()) {
            return redirect('/aktivacija-nova')
                        ->withErrors($validator)
                        ->withInput();
        }

        $kartica = KarticaVozila::create($request->all());       
        return redirect('/aktivacija-jamstva  ');        
    }
}
