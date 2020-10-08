<?php


namespace App\Models;


class Inventory extends Model
{
    protected $table = "inventario";
    protected $primaryKey = "id";
    protected $columns = ["id","code","id_producto","cantidad"];


    public function list(){
        return $this->rawQuery("
            SELECT * from inventario 
            LEFT JOIN productos ON inventario.id_producto=productos.id
            LEFT JOIN categorias ON categorias.id = productos.id_cate
        ");
    }
}