<?php

namespace App\Ship\Kernels;

use App\Ship\Middlewares\Http\Authenticate;
use App\Ship\Middlewares\Http\PermissionsAnd;
use App\Ship\Middlewares\Http\ProcessETagHeadersMiddleware;
use App\Ship\Middlewares\Http\ProfilerMiddleware;
use App\Ship\Middlewares\Http\ValidateJsonContent;
use Illuminate\Foundation\Http\Kernel as LaravelHttpKernel;

/**
 * Class HttpKernel
 *
 * A.K.A (app/Http/Kernel.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class HttpKernel extends LaravelHttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // Laravel middleware's
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,

        // CORS package middleware
        \Barryvdh\Cors\HandleCors::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'bindings',
            // The throttle Middleware is registered by the RoutesLoaderTrait in the Core
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'can'      => \Illuminate\Auth\Middleware\Authorize::class,
        'auth'     => Authenticate::class,
        'signed'   => \Illuminate\Routing\Middleware\ValidateSignature::class,
        // 'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        // 'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
      'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
      'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
      'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
      'permission_and' => PermissionsAnd::class,
    ];

}
