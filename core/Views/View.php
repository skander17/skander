<?php


namespace Core\Views;


class View
{
    private static  $view;
    private static $arguments = [];
    /**
     * @param $name
     * @param $arguments
     */
    private static function importView($name, $arguments){
        $arguments = array_merge($arguments,self::$arguments);
        ob_start();
        extract($arguments);
        include_once ROOT_PATH . "helpers.php";
        $resource = RESOURCE_PATH . "/views/{$name}.php";
        include_once $resource;
        $result = ob_get_contents();
        ob_end_clean();
        self::$view = $result;
    }

    /**
     * @param $name
     * @return bool
     */
    public static function viewExist($name){
        $resource = RESOURCE_PATH . "/views/{$name}.php";
        return file_exists($resource);
    }


    /**
     * @param $arguments
     */
    public static function setArguments($arguments){
        self::$arguments = array_merge(self::$arguments, $arguments);
    }

    /**
     * @param $name
     * @param $arguments
     * @return string
     */
    public static function render($name, $arguments=[]){
        self::importView($name, $arguments);
        return self::$view;
    }
}