<?php

namespace Core;


use Closure;
use Core\Interfaces\MiddlewareInterface;
use Exception;

class Router extends Request
{
    private  $routes = [];

    public  $request;

    function __construct( )
    {
        parent::__construct();
        $this->request = parent::getInstance();
    }

    public function request()
    {
        return $this->request;
    }

    public function getUri()
    {
        return (isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : "/";
    }

    public function getParams()
    {

        $path_parsed = explode("@", str_replace("/", "", $this->getUri()));
        $params = [];
        if (count($path_parsed)>0) {
            foreach ($path_parsed as $key => $value) {
                if ($key>0) {
                    $params[$key] = $value;
                }
            }
        }

        return json_encode($params);

    }

    /**
     * @return bool
     */
    public function existUri(): bool
    {
        $path = $this->getUri();
        foreach ($this->routes as $key => $value) {
            if ($value[0] == $this->request->method AND $value[1]==$path){
                return true;
            }
        }
        return false;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function render(): string
    {

            foreach ($this->routes as $key => $value) {
                if ($value[0] == $this->request->method AND $value[1]==$this->getUri()){
                    if (isset($value[3]) AND $value[3] instanceof MiddlewareInterface){
                        if (!is_callable($value[2])){
                            $filtered = $value[3]->handler($this->request,function () use ($value){
                                return $this->callFunction($value[2]);
                            });
                            if (! $filtered instanceof Closure){
                                return $filtered;
                            }
                            return $filtered;
                        }
                    }else{
                        return is_callable($value[2]) ? call_user_func($value[2],$this->request) : $this->callFunction($value[2]);
                    }
                }
            }
            return $this->notFound();


    }

    public function methodNotAllowed()
    {
        header("content-type: application/json", null, 405);
        return json_encode(["Message"=>"Method Not Allowed","status"=> 405]);
    }

    public function notFound()
    {
        header("content-type: application/json", null, 404);
        return json_encode(["Message"=>"Not found","status"=> 404]);
    }


    /**
     * @param $method
     * @param $path
     * @param $action
     */
    public function route($method, $path, $action)
    {
        $this->routes[] = [$method,$path,$action];
    }

    /**
     * @param $path
     * @param $action
     */
    public function get($path, $action)
    {
        $this->routes[] = ["GET",$path,$action];
    }

    /**
     * @param $path
     * @param $action
     */
    public function post($path, $action)
    {
        $this->routes[] = ["POST",$path,$action];
    }

    /**
     * @param $path
     * @param $controller
     */
    public function crud($path, $controller)
    {
        $this->routes[] = ["GET",$path,$controller."@"."index"];
        $this->routes[] = ["POST",$path,$controller."@"."store"];
        $this->routes[] = ["PUT",$path,$controller."@"."update"];
        $this->routes[] = ["DELETE",$path,$controller."@"."destroy"];
    }

    /**
     * @param $path
     * @param $action
     */
    public function put($path, $action)
    {
        $this->routes[] = ["PUT",$path,$action];
    }

    /**
     * @param $path
     * @param $action
     */
    public function delete($path, $action)
    {
        $this->routes[] = ["DELETE",$path,$action];
    }


    /**
     * @param $url
     * @return string
     * @throws Exception
     */
    public function callFunction($url)
    {
        $action = explode("@", $url);

        if (count($action)<=1) {
            header("content-type: application/json", null, 500);
            return json_encode($url);
        }

        $controller = $action[0];
        $method = $action[1];
        if(!method_exists($controller,$method))
        {
            throw new Exception("Method Not Allowed", 1);
        }

        $controllerClass = new $controller;

        $response = call_user_func_array([$controllerClass, $method], [$this->request]);
        if ((is_array($response) or is_object($response))) {
            return json_encode($response);
        }
        return $response;
    }

    /**
     * @param $namespace
     * @param callable $routes
     */
    public function useNamespace($namespace, callable $routes)
    {
        call_user_func($routes, $this);
        foreach ($this->routes as $key => $value) {
            if (is_string($value[2])) {
                $this->routes[$key][2] = $namespace . "\\" . $value[2];
            }
        }
    }
    /**
     * @param $prefix
     * @param callable $routes
     */
    public function group($prefix, callable $routes)
    {
        $old_routes = $this->routes;
        $this->routes = [];
        call_user_func($routes, $this);
        foreach ($this->routes as $key => $value) {
            if (is_string($value[1])) {
                $this->routes[$key][1] = $prefix . $value[1];
            }
        }
        $this->routes = array_merge($old_routes, $this->routes);
    }

    /**
     * @param $middleware
     * @param callable $routes
     * @throws Exception
     */
    public function middleware($middleware, callable $routes)
    {
        if (is_string($middleware)){
            $middleware = "App\Http\Middleware\\$middleware"; 
            if (!class_exists($middleware)){
                throw new Exception('The middleware $middleware not exist');
            }
            $middleware  = new $middleware();
        }
        if (!$middleware instanceof MiddlewareInterface){
             throw new Exception('The middleware must be an MiddlewareInterface instance');
        }
        $old_routes = $this->routes;
        $this->routes = [];
        call_user_func($routes, $this);
        foreach ($this->routes as $key => $value) {
            $this->routes[$key][3] = $middleware;
        }
        $this->routes = array_merge($old_routes, $this->routes);
    }

    public function listRoutes(): string
    {
        return var_dump($this->routes);
    }

}
