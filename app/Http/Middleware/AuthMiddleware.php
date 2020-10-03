<?php


namespace App\Http\Middleware;


use App\Http\Controllers\AuthController;
use Closure;
use Core\Interfaces\MiddlewareInterface;
use Core\Request;

class AuthMiddleware implements MiddlewareInterface
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handler(Request $request, Closure $next)
    {
            $auth = (new AuthController());
            if ($auth->auth($request)){
                return $next($request);
            }else{
             return $auth->redirect('/unauthorized');
            }
    }
}