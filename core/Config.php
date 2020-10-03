<?php


namespace Core;


class Config
{
    private static $config = [];

    /**
     * @param string $key
     * @return array|null
     */
    public static function get($key = "*"){
        self::parseConfig();

        if ($key == '*'){
            return self::$config;
        }
        if (isset(self::$config[$key])){
            return self::$config[$key];
        }
        return null;
    }

    /**
     * @return void
     */
    private static function parseConfig(){
        $file_path = ROOT_PATH .  'config/config.json';
        $file = fopen($file_path, 'r');
        $file_json = fread($file,1000);
        self::$config = json_decode($file_json, true);
    }
}