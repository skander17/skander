<?php

namespace Core;

use Core\Config\Config;
use Core\Router\Router;
use Exception;

class App extends Router
{
    public function run()
    {
        try {
            echo $this->render();
        }catch (Exception $e){
            $this->handler($e);
        }
    }

    public function handler(Exception $exception)
    {
        if (!Config::get('debug')){
            if (Config::get('error') == 'json'){
                header("content-type: application/json", null, 500);
                $error = json_encode(["Message"=>"internal error","status"=> 500]);
            }else{
                header("content-type: text/html", null, 500);
                $error =  '<h1 style="text-align: center">Internal Error</h1>';
            }

        }else{
            header("content-type: text/html", null, 500);
            $error = $exception->getMessage() . "\n" . $exception->getTraceAsString();
        }
        echo $error;
    }
}

