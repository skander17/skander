<?php

namespace Core;

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
    /**
     * @return object
     */
    public function  config(){
        $file_path = ROOT_PATH .  'config/config.json';
        $file = fopen($file_path, 'r');
        $file_json = fread($file,1000);
        return json_decode($file_json, true);
    }

    public function handler(Exception $exception)
    {
        if (!$this->config()['debug']){
            header("content-type: application/json", null, 500);
            $error = json_encode(["Message"=>"internal error","status"=> 500]);
        }else{
            $error = $exception->getMessage() . "\n" . $exception->getTraceAsString();
        }
        echo $error;
    }
}

