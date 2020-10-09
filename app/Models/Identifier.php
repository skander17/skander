<?php


namespace App\Models;


class Identifier extends Model
{
    protected  $table = "identificacion";
    protected  $columns = ["id", "nombre","apellido","telefono","direccion","correo","dni"];

}