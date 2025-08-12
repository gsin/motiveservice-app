<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception;
use App\KarticaVozila;

class cronUploadAktivacije extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upload:aktivacije';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prenos aktivacij v MOVE';

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
    public function handle()
    {
        //$client = new GuzzleHttp\Client();
        // zakomentirano ker se prenašajo na klik
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
        */
    }
}
     