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

     //to make sure the api doesn't get errors during post request otherwise there'll be errors due to csrf protection.

    protected $except = [
        'api/*'
    ];
}
