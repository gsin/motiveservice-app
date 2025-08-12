<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/v1/vrni-jamstva',
        'api/v1/oddaj-jamstvo',
        'api/v1/oddaj-jamstvo-aktiviraj',
        'api/v1/jamstvo-pdf',
    ];
}
