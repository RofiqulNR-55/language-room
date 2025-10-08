<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    // UBAH BAGIAN INI
    protected $proxies = '*'; // Dari null atau [] menjadi '*'

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    // DAN UBAH BAGIAN INI
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO | // Pastikan baris ini ada
        Request::HEADER_X_FORWARDED_AWS_ELB;
}