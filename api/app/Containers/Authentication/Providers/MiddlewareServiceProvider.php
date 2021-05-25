<?php

namespace App\Containers\Authentication\Providers;

use App\Containers\Authentication\Middlewares\ApiAuthenticationMiddleware;
use App\Containers\Logger\Middlewares\ActivityAuthenticationMiddleware;
use App\Ship\Parents\Providers\MiddlewareProvider;

/**
 * Class MiddlewareServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MiddlewareServiceProvider extends MiddlewareProvider
{

    /**
     * Register Middleware's
     *
     * @var  array
     */
    protected $middlewares = [
    ];

    /**
     * Register Container Middleware Groups
     *
     * @var  array
     */
    protected $middlewareGroups = [
        'web' => [
            // ..
        ],
        'api' => [
            // ..
        ],
    ];

    protected $routeMiddleware = [
        'jwt' => ApiAuthenticationMiddleware::class,
    ];

}
