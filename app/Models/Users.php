<?php


namespace App\Models;

class Users extends Model
{
    protected  $table = "usuarios";
    protected  $columns = ["id", "nombre","email", "password","status"];

    public function list(){
        return $this->rawQuery("
        SELECT usuarios.*,roles.nombre as rol_nombre FROM usuarios LEFT JOIN roles ON usuarios.rol = roles.id
        ");
    }
}