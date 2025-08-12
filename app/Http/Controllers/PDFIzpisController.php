<?php

namespace App\Http\Controllers;

use Storage;
use App\KarticaVozila;

use mikehaertl\pdftk\Pdf;
use Illuminate\Http\Request;
use Redirect;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception;
use Response;

class PDFIzpisController extends Controller
{
    //
 	public function __construct()
    {
        $this->middleware('auth');
    }

	//public function index($id)	{    
    public function index(Request $request, $id){

		 
		$k = KarticaVozila::find($id);    
		  
		$filename = $k->oznaka_jamstva."_".$id.".pdf";

        

            $pdf = PDFIzpisController::getPogodbaPDF($id);
            if ($pdf == null)   {

             $element = "flash_error";          
             $msg = "Napaka pri izpisu PDF";
             $request->session()->flash($element, $msg);
              return redirect('/aktivacija-jamstva');  
                
            }

			return Response::make($pdf , 200, [

			    'Content-Type'=> 'application/pdf',  
				'Content-Disposition' => 'inline; filename="'.$filename.'"'

			]);
          
                

	}

	public function getPogodbaPDF($id)
    {
        $client = new Client();
            

       
            try {
                   $response = $client->get("http://192.168.111.11/api/PDFObrazci/".$id);
            }
            catch (\RequestException $e) {
                                
                $response = $e->getResponse();
                    //$responseBodyAsString = $response->getBody()->getContents();
            
            } catch (\Exception $e) {
            
                $response = $e->getResponse();
            

            }                
            if ($response->getStatusCode() == 200) {
                
               return  $response->getBody()->getContents();
		 		
            }   
            
            return null;
    }

}
