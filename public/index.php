<?php

use Core\Router\Router;

require __DIR__ . '/../vendor/autoload.php';
    define('ROOT_PATH', dirname(__DIR__) . '/');
    define('ASSETS_PATH', realpath(dirname(__FILE__)));
    define('RESOURCE_PATH', dirname(__DIR__) . '/resources');


    $app = new Core\App();
    try {
        $app->useNamespace('App\Http\Controllers', function (Router $router){
            require __DIR__ . '/../routes/app.php';
            require __DIR__ . '/../routes/api.php';
        });
        $app->run();
    }catch (Exception $exception){
        $app->handler($exception);
    }

