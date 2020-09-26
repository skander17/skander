<?php
namespace Core\Interfaces;

use Closure;
use Core\Request;

/**
 *
 */
interface MiddlewareInterface
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handler(Request $request, Closure $next);

}