<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception;
use GuzzleHttp\Exception\RequestException;
use App\Prodajalec;

use Illuminate\Support\Facades\Auth;


class AmzsIzvozController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

 	public function index()
    {        
     
        $datum_od = '2024-01-01';
        $datum_do = '2024-01-31';
        
        return view('amzs-izvoz', ["datum_od" => $datum_od, "datum_do" => $datum_do, "error" => null]);
    }

 	public function search(Request $request)
    {

        $datum_od = $request->input('datum_od');
        $datum_do = $request->input('datum_do');

        $datum_od_ws = $datum_od."T00:00:00";    
        $datum_do_ws = $datum_do."T23:59:59";

        $stat = AmzsIzvozController::getAmzsIzvozWS($datum_od_ws, $datum_do_ws);    
        if (!is_array($stat)){                        
            $error = "Napaka pri pripravi poročila!";            
            return view('amzs-izvoz', ["datum_od" => $datum_od, "datum_do" => $datum_do, "error" => $error]);
        }
       

       switch ($request->input('action')) {
        case 'search':
            return view('amzs-izvoz', ["stat" => $stat, "datum_od" => $datum_od, "datum_do" => $datum_do]);
            break;

        case 'export':
            AmzsIzvozController::array_to_csv_download(json_decode(json_encode($stat), true));
            break;

         
    }
        
        
        
       
        
        
        
    }


    //
 	public function getAmzsIzvozWS($datum_od, $datum_do)
    {
        $client = new Client();
                
        try {
               $response = $client->get('http://192.168.111.11/api/AmzsIzvoz?datumOd='.$datum_od.'&datumDo='.$datum_do);
        }
        catch (RequestException $e) {
                $response = $e->getResponse();                
        }
        catch (RequestException $e) {
                $response = $e->getResponse();                
        }               
        catch (Exception $e) {
                $response = $e->getResponse();                
        }               

        if ($response->getStatusCode() == 200) {
            $pogodbe = $response->getBody()->getContents();
            return json_decode($pogodbe);
        }            
        
    }

    public function array_to_csv_download($array,  $delimiter=",") {
        $filename = "amzs_izvoz_" . date("Y-m-d") . ".csv";
        // open raw memory as file so no temp files needed, you might run out of memory though
        $f = fopen('php://memory', 'w'); 
        // loop over the input array
        foreach ($array as $line) { 
            // generate csv lines from the inner arrays
            fputcsv($f, $line, $delimiter); 
        }
        // reset the file pointer to the start of the file
        fseek($f, 0);
        // tell the browser it's going to be a csv file
        header('Content-Type: application/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        // make php send the generated csv lines to the browser
        fpassthru($f);
    }

    /*
    public function exportCSV(array $array) {

               
        try {
               AmzsIzvozController::download_send_headers("amzs_izvoz_" . date("Y-m-d") . ".csv");
               AmzsIzvozController::array2csv($array);
        }
        catch (Exception $e) {
               dd($e->getResponse());
        }
       

       

        //echo AmzsIzvozController::array2csv($array);
      // die();
    }

    public function array2csv(array &$array)
    {
          dd("3");
       // dd(count($array);
       if (count($array) == 0) {
         return null;
       }
       ob_start();
       $df = fopen("php://output", 'w');
       fputcsv($df, array_keys(reset($array)));
       foreach ($array as $row) {
          fputcsv($df, $row);
       }
       fclose($df);
       return ob_get_clean();
    }

    public function download_send_headers($filename) {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download  
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }
*/        
}
