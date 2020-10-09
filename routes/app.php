<?php


use Core\Router\Router;

$router->get("/","AuthController@home");
$router->post("/login","AuthController@login");
$router->get("/login","AuthController@login");
$router->get("/logout","AuthController@logout");
$router->get("/unauthorized","AuthController@unauthorized");

$router->middleware("AuthMiddleware",function (Router $router) {

    $router->group('/admin',function (Router $router){
        $router->get('/estadisticas','DashboardController@index');

        $router->crud('/usuarios','UserController');
        $router->crud('/clientes','ClientController');
        $router->crud('/proveedores','ProviderController');
        $router->crud('/productos','ProductController');
        $router->crud('/monedas','CoinController');
        $router->crud('/compras','PurchaseController');
        $router->crud('/categorias','CategoryController');

        //sólo tiene la función index para que no se puedan realizar el CRUD.
        // El crud de ésta tabla se hace por medio de compras, ventas y productos
        $router->get('/inventario','InventoryController@index');

        //Solo definí éstas porque un movimiento no debería borrarse, se aplican otras tecnicas contables para "cancelarse"
        $router->get('/movimientos','MovementController@index');
        $router->post('/movimientos','MovementController@store');
        $router->put('/movimientos','MovementController@update');

        $router->group('/reportes',function (Router $router) {
            $router->get('/usuarios','UserController@report');
            $router->get('/clientes','ClientController@report');
            $router->get('/proveedores','ProviderController@report');
            $router->get('/productos','ProductController@report');
            $router->get('/monedas','CoinController@report');
            $router->get('/compras','PurchaseController@report');
            $router->get('/categorias','CategoryController@report');
            $router->get('/inventario','InventoryController@report');
            $router->get('/movimientos','MovementController@report');
        });

        });

});