<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '997592298:*'
    ];

//    public function __construct(Application $app, Encrypter $encrypter)
//    {
//        $this->app = $app;
//        $this->encrypter = $encrypter;
//        $this->except[] = /Telegram::getAccessToken();
//    }
}
