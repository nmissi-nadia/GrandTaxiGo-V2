<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Les URI auxquelles la vérification CSRF ne doit pas s'appliquer.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}