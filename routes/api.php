<?php


use Core\Router\Router;

$router->group('/api',function (Router $router){

    $router->middleware("AuthMiddleware",function (Router $router) {

        $router->get('/users','UserController@list');

    });

});