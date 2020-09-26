<?php


namespace App\Models;

class Users extends Model
{
    protected  $table = "usuarios";
    protected  $columns = ["id", "nombres", "apellidos","email", "password", "created_at","updated_at"];
}