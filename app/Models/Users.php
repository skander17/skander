<?php


namespace App\Models;

class Users extends Model
{
    protected  $table = "usuarios";
    protected  $columns = ["id", "nombre","email", "password","status"];
}