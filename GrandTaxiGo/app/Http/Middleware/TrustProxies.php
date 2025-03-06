<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * Les en-têtes HTTP proxy à confier.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}