<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\KarticaVozila;

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
        if (Auth::user()->isAdmin())  
        {
            
            $aktivacije = KarticaVozila::limit(10)->get();    
        }
        else
        {
            $aktivacije = KarticaVozila::limit(10)->where('sifra_avtohise', Auth::user()->sifra_avtohise)->get();
        }

        //return view('aktivacija', [ "aktivacije" => $aktivacije ]);

        return view('home', [ "aktivacije" => $aktivacije ]);
    }
}
