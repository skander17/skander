<?php

use Core\Router;

require __DIR__ . '/../vendor/autoload.php';
    define('ROOT_PATH', dirname(__DIR__) . '/');
    define('ASSETS_PATH', realpath(dirname(__FILE__)));
    define('RESOURCE_PATH', dirname(__DIR__) . '/resources');


    $app = new Core\App();
    try {
        $app->useNamespace('App\Http\Controllers', function (Router $router){

            $router->get("/","AuthController@home");
            $router->post("/login","AuthController@login");
            $router->get("/login","AuthController@login");
            $router->get("/logout","AuthController@logout");
            $router->get("/unauthorized","AuthController@unauthorized");


            //TODO AQUI DECLARO EL MIDDLEWAREEEEEEEEEEEEE, pendiente por alias e inyección
            $router->middleware("AuthMiddleware",function () use ($router){

                $router->group('/admin',function () use ($router){
                    $router->get('/dashboard','DashboardController@index');

                    $router->crud('/usuarios','UserController');
                });

            });
        });
        $app->run();
    }catch (Exception $exception){
        $app->handler($exception);
    }

