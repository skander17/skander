<?php


namespace App\Models;

class Users extends Model
{
    protected  $table = "usuarios";
    protected  $columns = ["id", "nombre","email", "password","status","rol"];
    protected $hidden = ["password"];
    protected  $alias = ["id"=>"id", "nombre"=>"Nombre","email"=>"Email","status_name"=>"Estado","rol_nombre"=>"Rol"];

    public function getAll(){
        return $this->rawQuery("
        SELECT usuarios.*,roles.nombre as rol_nombre,CASE status WHEN 1 THEN 'Activo' ELSE 'Bloqueado' END as status_name
         FROM usuarios LEFT JOIN roles ON usuarios.rol = roles.id
        ");
    }

    public function getAllRoles(){
        return $this->rawQuery("
             SELECT * FROM roles
        ");
    }
}