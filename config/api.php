<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains configuration for external API endpoints
    |
    */

    'move' => [
        'base_url' => env('MOVE_API_BASE_URL', 'http://192.168.111.11/api'),
        'timeout' => env('MOVE_API_TIMEOUT', 30),
        'retry_attempts' => env('MOVE_API_RETRY_ATTEMPTS', 3),
    ],

    'endpoints' => [
        'jamstvo_status' => '/JamstvoStatus',
        'kartice_vozil' => '/KarticeVozil',
        'pogodbe_zakupljene' => '/PogodbeZakupljene',
        'oznaka_kartice' => '/OznakaKarticeJamstva',
        'paketi_vozilo' => '/PaketiVozilo',
    ],
];
