<?php


use Core\Router\Router;

$router->get("/","AuthController@home");
$router->post("/login","AuthController@login");
$router->get("/login","AuthController@login");
$router->get("/logout","AuthController@logout");
$router->get("/unauthorized","AuthController@unauthorized");

$router->middleware("AuthMiddleware",function (Router $router) {

    $router->group('/admin',function (Router $router){
        $router->get('/dashboard','DashboardController@index');

        $router->crud('/usuarios','UserController');
    });

});