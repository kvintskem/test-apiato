<?php


namespace App\Containers\Authentication\Middlewares;


use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;


class ApiAuthenticationMiddleware extends BaseMiddleware
{

  public function handle($request, Closure $next)
  {

    try {

      JWTAuth::parseToken()->authenticate();

      auth()->userOrFail();

    } catch (\Exception $e) {
      var_dump($e->getLine(),$e->getMessage(),$e->getFile());
    }

    return $next($request);

  }

}
