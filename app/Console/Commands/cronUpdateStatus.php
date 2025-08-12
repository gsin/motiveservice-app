<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception;
use App\KarticaVozila;

class cronUpdateStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:status';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Posodobitev statusov iz MOVE';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handleOld()
    {
        $client = new Client();
            
        // osvežuj vse razen osnutkov
        $aktivacije = KarticaVozila::where('status', '!=', 0)->get();
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
                }            
            }            
        }
    }

    public function handle()
    {
        $client = new Client();
            
        // osvežuj kar vse
        $aktivacije = KarticaVozila::get();
        foreach ($aktivacije as $a) {                
            try {                   
                   $response = $client->get('http://192.168.111.11/api/JamstvoStatus/'.$a->id);
            }
            catch (RequestException $e) {
                    $response = $e->getResponse();
            }
                            
            if ($response->getStatusCode() == 200) {


                $statusNew = json_decode($response->getBody()->getContents());                    
                if ($a->status != $statusNew->id && $statusNew->id != -100)
                {
                    $a->status = $statusNew->id;
                    $a->status_msg = $statusNew->opis;                
                    $a->save();    
                }            
            }            
        }
    }
}
