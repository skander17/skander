<?php
if (!function_exists('assets')){
    function assets(string $filename): string {
        return '/assets' . $filename;
    }
}
if (!function_exists('import')){
    function import(string $filename){
        $resource =  RESOURCE_PATH . "/views/" .$filename . ".php";
        if (file_exists($resource)){
           include_once $resource;
        }
    }
}
