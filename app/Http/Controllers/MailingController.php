<?php

namespace App\Http\Controllers;

use Storage;
use App\KarticaVozila;

use mikehaertl\pdftk\Pdf;
use Illuminate\Http\Request;
use Redirect;

class MailingController extends Controller
{
    //
 	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index($id)	{
		$name = "Simon Rusjan";
	    $email = "info@motiveservice.eu";
	    $title = "test";
	    $content = "test";

	    $k = KarticaVozila::find($id);

	    $template = '';
		$subject = '';

		

		if ($k->status == 3)
	    {
			$template = 'email-odobritev-aktivacije';
			$subject = 'Odobritev aktivacije S.U.J. '. $k->oznaka_jamstva;
	    }

	    if ($k->status == 18)
	    {
			$template = 'email-zavrnitev-aktivacije';
			$subject = 'Zavrnitev aktivacije S.U.J. '. $k->oznaka_jamstva;

	    }

		if ($k->status == 40)
	    {
			$template = 'email-cakanje-aktivacije';
			$subject = 'Aktivacija S.U.J. '. $k->oznaka_jamstva .' je v čakanju';

	    }
	    
	    //$mail_to = 'simon.rusjan@gmail.com';
		$mail_to = 'uros@studiofx.si';
		
	    if (strlen($template) > 0){
    		\Mail::send($template , ['email' => $email, 'title' => $title, 'k' => $k], function ($message)  use ($subject, $mail_to) {
	            $message->to($mail_to)->subject($subject);
	        });
	    }				        	
		
		$request = request();
		$request->session()->flash('flash_ok', 'Mail poslan na '.$mail_to);

	    return redirect('/aktivacija-jamstva');   
	}

	public static function sendMail($id) {
	    $name = "Simon Rusjan";
	    $email = "info@motiveservice.eu";
	    $title = "test";
	    $content = "test";

	    $k = KarticaVozila::find($id);

	    $template = '';
		$subject = '';

		if ($k->status == 3)
	    {
			$template = 'email-odobritev-aktivacije';
			$subject = 'Odobritev aktivacije S.U.J. '. $k->oznaka_jamstva;
	    }

	    if ($k->status == 18)
	    {
			$template = 'email-zavrnitev-aktivacije';
			$subject = 'Zavrnitev aktivacije S.U.J. '. $k->oznaka_jamstva;

	    }

		if ($k->status == 40)
	    {
			$template = 'email-cakanje-aktivacije';
			$subject = 'Aktivacija S.U.J. '. $k->oznaka_jamstva .' je v čakanju';

	    }
	    
		/*
        \Mail::send($template , ['email' => $email, 'title' => $title, 'k' => $k], function ($message)  use ($subject) {

            $message->to('simon.rusjan@gmail.com')->subject($subject);
        });
		*/
		\Mail::send($template , ['email' => $email, 'title' => $title, 'k' => $k], function ($message)  use ($subject) {

            $message->to('uros@studiofx.si')->subject($subject);
        });

		     
	}

}
