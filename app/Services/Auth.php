<?php


namespace App\Services;


use App\Models\Users;

class Auth
{
    public static function currentUser(){
        return (new Users())->find($_SESSION['usuario']);
    }
}