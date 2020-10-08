<?php


namespace App\Models;


class Product extends Model
{
    protected  $table = "productos";
    protected  $columns = ["id", "nombre_prod","id_cate", "precio_v","precio_c","disponible"];

    public function getAll()
    {
        return $this->rawQuery("
            SELECT productos.*, categorias.nombre_cate,code_cate,descripcion_cate
             FROM productos LEFT JOIN categorias ON categorias.id = productos.id_cate
        ");
    }
    public static function get($id){
        return (new self())->find($id);
    }
}